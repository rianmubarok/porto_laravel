<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestUploadController extends Controller
{
    private $cloudinary;
    private $imageManager;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'djp8xcc65'),
                'api_key' => env('CLOUDINARY_API_KEY', '267458531667766'),
                'api_secret' => env('CLOUDINARY_API_SECRET', 'yMHlOw9R4W3TaVvq_htQ8iY-rYU'),
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

    public function index()
    {
        try {
            // Get list of uploaded images from Cloudinary
            $result = $this->cloudinary->searchApi()
                ->expression('folder:test_uploads')
                ->sortBy('created_at', 'desc')
                ->maxResults(50)
                ->execute();

            $images = $result['resources'] ?? [];
            
            return view('test-upload.index', compact('images'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch images: ' . $e->getMessage());
            return view('test-upload.index', ['images' => []]);
        }
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('image');
            
            // Log the file details
            Log::info('File details:', [
                'name' => $uploadedFile->getClientOriginalName(),
                'size' => $uploadedFile->getSize(),
                'mime' => $uploadedFile->getMimeType()
            ]);

            // Optimize image before upload
            $image = $this->imageManager->read($uploadedFile->getRealPath());
            
            // Resize if image is too large
            if ($image->width() > 1200) {
                $image->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            // Optimize quality and convert to JPEG
            $image->toJpeg(80);
            
            // Save to temporary file
            $tempPath = tempnam(sys_get_temp_dir(), 'cloudinary_');
            $image->save($tempPath);

            // Upload to Cloudinary with optimization options
            $result = $this->cloudinary->uploadApi()->upload(
                $tempPath,
                [
                    'folder' => 'test_uploads',
                    'public_id' => 'test_' . time(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                    'width' => 1200,
                    'crop' => 'limit',
                    'timeout' => 30
                ]
            );

            // Clean up temporary file
            unlink($tempPath);

            // Log the Cloudinary response
            Log::info('Cloudinary response:', [
                'secure_url' => $result['secure_url'],
                'public_id' => $result['public_id'],
                'format' => $result['format']
            ]);

            return back()->with('success', 'Image uploaded successfully!');

        } catch (\Exception $e) {
            Log::error('Upload failed: ' . $e->getMessage());
            return back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $publicId = $request->input('public_id');
            
            if (!$publicId) {
                return back()->with('error', 'Public ID is required');
            }

            // Delete from Cloudinary
            $result = $this->cloudinary->uploadApi()->destroy($publicId);

            Log::info('Image deleted:', [
                'public_id' => $publicId,
                'result' => $result
            ]);

            return back()->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Delete failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete image: ' . $e->getMessage());
        }
    }
} 