@extends('layouts.app')

@section('title', 'Test Cloudinary Upload')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="mb-0">Test Cloudinary Upload</h2>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <h4>Error Details:</h4>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            <h4>Success!</h4>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Upload Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Upload New Image</h5>
                            <form action="{{ route('test-upload.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="image" class="form-label">Select Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Max file size: 2MB<br>
                                        Allowed types: JPEG, PNG, JPG, GIF
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Upload Image</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Uploaded Images Grid -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Uploaded Images</h5>
                            @if(empty($images))
                                <div class="alert alert-info">
                                    No images uploaded yet.
                                </div>
                            @else
                                <div class="row">
                                    @foreach($images as $image)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <img src="{{ $image['secure_url'] }}" 
                                                     class="card-img-top" 
                                                     alt="Uploaded image"
                                                     style="height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <p class="card-text small text-muted mb-2">
                                                        Uploaded: {{ \Carbon\Carbon::parse($image['created_at'])->diffForHumans() }}
                                                    </p>
                                                    <form action="{{ route('test-upload.delete') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="public_id" value="{{ $image['public_id'] }}">
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('Are you sure you want to delete this image?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 