@extends('layouts.app')

@section('title', $project->title . ' - My Portfolio')

@section('content')
    <div class="container">
        <!-- Project Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -2px; color: #1a1a1a;">
                                    {{ $project->title }}
                                </h1>
                                <div class="d-flex align-items-center mb-4">
                                    <span class="badge bg-light text-dark me-2">{{ $project->type }}</span>
                                    <span class="badge bg-light text-dark">{{ $project->technologies }}</span>
                                </div>
                            </div>
                            @if($project->github_link || $project->live_link)
                            <div class="d-flex gap-3">
                                @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" class="btn btn-outline-dark">
                                    <i class="bi bi-github"></i> GitHub
                                </a>
                                @endif
                                @if($project->live_link)
                                <a href="{{ $project->live_link }}" target="_blank" class="btn btn-outline-dark">
                                    <i class="bi bi-box-arrow-up-right"></i> Live Demo
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Content -->
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <!-- Project Images Gallery -->
                @if($project->images->isNotEmpty())
                <div class="card border-0 mb-4" style="border-radius: 20px; background: white; border: 1px solid #e0e0e0;">
                    <div class="p-0">
                        <div class="project-images">
                            @foreach($project->images as $image)
                            <div style="line-height: 0;">
                                <img src="{{ $image->image_url }}" 
                                     alt="{{ $project->title }} - Image {{ $loop->iteration }}"
                                     style="width: 100%;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Project Description -->
                <div class="card border-0" style="border-radius: 20px; background: white; border: 1px solid #e0e0e0;">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4" style="color: #1a1a1a;">Project Description</h2>
                        <p class="mb-0" style="color: #4a4a4a;">{{ $project->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4" style="color: #1a1a1a;">Project Details</h2>
                        <div class="mb-4">
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Type</h3>
                            <p class="mb-0" style="color: #4a4a4a;">{{ ucfirst($project->type) }}</p>
                        </div>
                        <div class="mb-4">
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Technologies</h3>
                            <p class="mb-0" style="color: #4a4a4a;">{{ $project->technologies }}</p>
                        </div>
                        <div>
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Created At</h3>
                            <p class="mb-0" style="color: #4a4a4a;">{{ $project->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .project-images img {
            transition: transform 0.3s ease;
        }
    </style>
@endsection 