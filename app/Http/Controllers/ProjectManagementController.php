<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;

class ProjectManagementController extends Controller
{
    private $cloudinary;
    private $imageManager;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ],
            'upload' => [
                'timeout' => 30,
                'chunk_size' => 1024 * 1024,
                'use_filename' => true,
                'unique_filename' => true,
                'resource_type' => 'auto'
            ]
        ]);

        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(): View
    {
        $projects = Project::with(['images' => function($query) {
            $query->orderBy('order');
        }])->latest()->get();

        return view('project-management.index', compact('projects'));
    }

    public function create(): View
    {
        return view('project-management.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'technologies' => 'required|string',
                'type' => 'required|in:design,programming',
                'github_link' => 'nullable|url|max:255',
                'live_link' => 'nullable|url|max:255',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            DB::beginTransaction();

            $project = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'technologies' => $request->technologies,
                'type' => $request->type,
                'github_link' => $request->github_link,
                'live_link' => $request->live_link
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    try {
                        $result = $this->uploadImageToCloudinary($image);
                        
                        $projectImage = ProjectImage::create([
                            'project_id' => $project->id,
                            'image_url' => $result['secure_url'],
                            'public_id' => $result['public_id'],
                            'order' => $index
                        ]);

                        Log::info('Image uploaded successfully', [
                            'project_id' => $project->id,
                            'image_id' => $projectImage->id,
                            'public_id' => $result['public_id'],
                            'order' => $index
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Failed to upload image', [
                            'project_id' => $project->id,
                            'error' => $e->getMessage()
                        ]);
                        throw $e;
                    }
                }
            }

            DB::commit();

            return redirect()->route('project-management.index')
                ->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create project', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to create project: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit(Project $project): View
    {
        $project->load('images');
        return view('project-management.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'type' => 'required|in:design,programming',
            'github_link' => 'nullable|url|max:255',
            'live_link' => 'nullable|url|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:project_images,id'
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'technologies' => $request->technologies,
            'type' => $request->type,
            'github_link' => $request->github_link,
            'live_link' => $request->live_link
        ]);

        // Handle image deletion
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProjectImage::find($imageId);
                if ($image && $image->project_id === $project->id) {
                    try {
                        if ($image->public_id) {
                            $this->cloudinary->uploadApi()->destroy($image->public_id);
                        }
                        $image->delete();
                    } catch (\Exception $e) {
                        Log::error('Failed to delete image: ' . $e->getMessage());
                    }
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentMaxOrder = $project->images()->max('order') ?? -1;
            foreach ($request->file('images') as $image) {
                $result = $this->uploadImageToCloudinary($image);
                
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_url' => $result['secure_url'],
                    'public_id' => $result['public_id'],
                    'order' => ++$currentMaxOrder
                ]);
            }
        }

        // Update order of remaining images
        $remainingImages = $project->images()->orderBy('order')->get();
        foreach ($remainingImages as $index => $image) {
            $image->update(['order' => $index]);
        }

        return redirect()->route('project-management.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete all project images from Cloudinary
        foreach ($project->images as $image) {
            if ($image->public_id) {
                try {
                    $this->cloudinary->uploadApi()->destroy($image->public_id);
                } catch (\Exception $e) {
                    Log::error('Failed to delete image from Cloudinary: ' . $e->getMessage());
                }
            }
        }

        $project->delete();
        return redirect()->route('project-management.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function deleteImage(ProjectImage $image)
    {
        try {
            // Verify that the image belongs to the project
            if (!$image->project_id) {
                Log::error('Image deletion failed: Image not found or not associated with any project', [
                    'image_id' => $image->id
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found or not associated with any project'
                ], 404);
            }

            // Delete from Cloudinary if public_id exists
            if ($image->public_id) {
                try {
                    $result = $this->cloudinary->uploadApi()->destroy($image->public_id);
                    Log::info('Image deleted from Cloudinary', [
                        'public_id' => $image->public_id,
                        'result' => $result
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to delete image from Cloudinary', [
                        'public_id' => $image->public_id,
                        'error' => $e->getMessage()
                    ]);
                    // Continue with local deletion even if Cloudinary deletion fails
                }
            }

            // Delete from database
            $image->delete();
            
            Log::info('Image deleted successfully', [
                'image_id' => $image->id,
                'project_id' => $image->project_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to delete image', [
                'image_id' => $image->id,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    private function uploadImageToCloudinary($uploadedFile)
    {
        try {
            // Optimize image before upload
            $image = $this->imageManager->read($uploadedFile->getRealPath());
            
            // Get original dimensions
            $originalWidth = $image->width();
            $originalHeight = $image->height();
            
            // Calculate new dimensions while maintaining aspect ratio
            $maxWidth = 1200;
            $maxHeight = 1200;
            
            // Calculate aspect ratio
            $aspectRatio = $originalWidth / $originalHeight;
            
            // Calculate new dimensions while maintaining aspect ratio
            if ($originalWidth > $maxWidth || $originalHeight > $maxHeight) {
                if ($aspectRatio > 1) {
                    // Landscape image
                    $newWidth = $maxWidth;
                    $newHeight = $maxWidth / $aspectRatio;
                } else {
                    // Portrait image
                    $newHeight = $maxHeight;
                    $newWidth = $maxHeight * $aspectRatio;
                }
                
                $image->resize($newWidth, $newHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Prevent upscaling
                });
            }

            // Optimize quality (90% quality is usually a good balance)
            $image->toJpeg(90);
            
            // Save to temporary file
            $tempPath = tempnam(sys_get_temp_dir(), 'cloudinary_');
            $image->save($tempPath);

            // Upload to Cloudinary with basic optimization
            $result = $this->cloudinary->uploadApi()->upload(
                $tempPath,
                [
                    'folder' => 'portfolio/projects',
                    'public_id' => 'project_' . uniqid(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto:good',
                    'fetch_format' => 'auto',
                    'transformation' => [
                        [
                            'width' => $maxWidth,
                            'height' => $maxHeight,
                            'crop' => 'pad',
                            'background' => 'white',
                            'quality' => 'auto:good'
                        ]
                    ]
                ]
            );

            // Clean up temporary file
            unlink($tempPath);

            return $result;
        } catch (\Exception $e) {
            // Clean up temporary file in case of error
            if (isset($tempPath) && file_exists($tempPath)) {
                unlink($tempPath);
            }
            throw $e;
        }
    }

    public function reorderImages(Request $request)
    {
        try {
            $request->validate([
                'imageIds' => 'required|array',
                'imageIds.*' => 'exists:project_images,id'
            ]);

            foreach ($request->imageIds as $index => $id) {
                ProjectImage::where('id', $id)->update(['order' => $index]);
            }

            Log::info('Images reordered successfully', [
                'imageIds' => $request->imageIds
            ]);

            return response()->json(['message' => 'Images reordered successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to reorder images', [
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Failed to reorder images'], 500);
        }
    }

    public function clientIndex()
    {
        return view('projects');
    }

    public function clientProjectsByType($type)
    {
        $projects = Project::with(['images' => function($query) {
            $query->orderBy('order');
        }])
        ->where('type', $type)
        ->latest()
        ->get();

        return view('projects-by-type', compact('projects', 'type'));
    }

    public function clientShow(Project $project)
    {
        $project->load(['images' => function($query) {
            $query->orderBy('order');
        }]);
        
        return view('project-show', compact('project'));
    }
} 