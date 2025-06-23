@extends('layouts.app')

@section('title', ucfirst($type) . ' Projects - My Portfolio')

@section('content')
    <div class="container">
        <!-- Row 1: Projects Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -2px; color: #1a1a1a;">
                                    {{ ucfirst($type) }} Projects
                                </h1>
                                <p class="lead mb-0" style="color: #4a4a4a;">
                                    {{ $type === 'design' ? 'Creating visually appealing designs for various digital platforms.' : 'Building responsive and modern web applications.' }}
                                </p>
                            </div>
                            <a href="{{ route('client.projects') }}" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-left"></i> Back to Projects
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: Projects Masonry Grid -->
        <div class="masonry-grid">
            @foreach($projects as $project)
            <div class="masonry-item mb-3">
                <a href="{{ route('client.project.show', $project) }}" class="text-decoration-none">
                    <div class="card border-0" style="border-radius: 16px; background: #fff;">
                        <div class="masonry-img-wrapper mb-2">
                            <img src="{{ $project->images->first()->image_url }}"
                                 alt="{{ $project->title }}"
                                 class="masonry-img"
                                 style="background: #f3f3f3;">
                        </div>
                        <div class="mb-2 d-flex flex-wrap gap-1">
                            @foreach(explode(',', $project->technologies) as $tech)
                                <span class="badge-tag">#{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size: 0.98rem; color: #222; line-height: 1.2;">{{ $project->title }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <style>
        .arrow-circle {
            position: absolute;
            top: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .arrow-circle i {
            color: white;
            font-size: 1.5rem;
        }

        .card:hover .arrow-circle {
            background: rgba(255, 255, 255, 0.3);
            transform: translate(5px, -5px);
        }

        .project-image {
            position: relative;
            transition: all 0.3s ease;
        }

        .project-image img {
            transition: all 0.3s ease;
            transform-origin: bottom right;
        }

        .card:hover .project-image img {
            transform: scale(1.05) translate(-10px, -10px);
        }

        .badge-tag {
            background: #f3f3f3;
            color: #444;
            border-radius: 999px;
            font-size: 0.75rem;
            padding: 0.18em 0.7em;
            font-weight: 500;
            display: inline-block;
        }

        .masonry-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            transition: all 0.5s ease-in-out;
        }
        @media (max-width: 1400px) {
            .masonry-grid { 
                grid-template-columns: repeat(4, 1fr);
            }
        }
        @media (max-width: 1200px) {
            .masonry-grid { 
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .masonry-grid { 
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 576px) {
            .masonry-grid { 
                grid-template-columns: repeat(1, 1fr);
            }
        }
        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1rem;
            transition: all 0.5s ease-in-out;
        }

        .masonry-img-wrapper {
            border-radius: 12px;
            overflow: hidden;
            background: #f3f3f3;
        }
        .masonry-img {
            transition: transform 0.3s;
            width: 100%;
            height: auto;
            display: block;
        }
        .card:hover .masonry-img {
            transform: scale(1.08);
        }
    </style>
@endsection 