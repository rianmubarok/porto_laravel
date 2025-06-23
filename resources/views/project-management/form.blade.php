@extends('layouts.app')

@section('title', isset($project) ? 'Edit Project' : 'Create Project')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $title ?? (isset($project) ? 'Edit Project' : 'Create New Project') }}</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($method))
                            @method($method)
                        @endif

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $project->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="web" {{ (isset($project) && $project->type === 'web') || old('type') === 'web' ? 'selected' : '' }}>Web Development</option>
                                <option value="mobile" {{ (isset($project) && $project->type === 'mobile') || old('type') === 'mobile' ? 'selected' : '' }}>Mobile Development</option>
                                <option value="design" {{ (isset($project) && $project->type === 'design') || old('type') === 'design' ? 'selected' : '' }}>Design</option>
                                <option value="other" {{ (isset($project) && $project->type === 'other') || old('type') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="technologies" class="form-label">Technologies</label>
                            <input type="text" class="form-control @error('technologies') is-invalid @enderror" 
                                   id="technologies" name="technologies" 
                                   value="{{ old('technologies', $project->technologies ?? '') }}" 
                                   required
                                   placeholder="e.g. Laravel, Vue.js, MySQL">
                            <div class="form-text">Separate technologies with commas</div>
                            @error('technologies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $project->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Project Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*" {{ !isset($project) ? 'required' : '' }} onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if(isset($project) && $project->image_url)
                                <div class="mt-2">
                                    <img src="{{ $project->image_url }}" alt="Current project image" 
                                         class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img src="" alt="Image preview" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">Project URL</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                   id="url" name="url" value="{{ old('url', $project->url ?? '') }}">
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="github_url" class="form-label">GitHub URL</label>
                            <input type="url" class="form-control @error('github_url') is-invalid @enderror" 
                                   id="github_url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}">
                            @error('github_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('project-management.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($project) ? 'Update Project' : 'Create Project' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endsection 