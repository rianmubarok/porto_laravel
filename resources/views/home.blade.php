@extends('layouts.app')

@section('title', 'Home - My Portfolio')

@section('content')
    <div class="container">
        <!-- Row 1: Introduction -->
        <div class="row mb-5">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="card h-100 border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body d-flex align-items-center" style="padding: 4rem;">
                        <div>
                            <h1 class="display-4 mb-4" style="letter-spacing: -2px; color: #1a1a1a; font-weight: 500;">
                                Hey, I'm Rian, a graphic designer and junior developer
                            </h1>
                            <p class="lead mb-0" style="color: #4a4a4a;">
                                Passionate about creating visually appealing icons and illustrations while exploring the world of development to build functional digital solutions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100 border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-0">
                        <img src="{{ asset('images/pp1.jpg') }}" alt="Profile" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: Projects -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4 mb-md-0">
                <a href="{{ route('client.projects.by.type', 'design') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 position-relative" style="border-radius: 20px; background: rgb(107,92,229); overflow: hidden; min-height: 500px;">
                        <div class="card-body" style="padding: 4rem; color: white;">
                            <h3 class="h4 mb-4">Design Projects</h3>
                            <p class="mb-4">
                                Creating visually appealing designs for various digital platforms.
                            </p>
                            <div class="project-image">
                                <img src="{{ asset('images/icon.jpg') }}" alt="Design Project" class="img-fluid" style="width: auto; height: 350px; object-fit: cover; object-position: top left; position: absolute; top: 30px; right: -80px; border-radius: 20px 0 0 0;">
                            </div>
                            <div class="arrow-circle">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('client.projects.by.type', 'programming') }}" class="text-decoration-none">
                    <div class="card h-100 border-0 position-relative" style="border-radius: 20px; background: #303443; overflow: hidden; min-height: 500px;">
                        <div class="card-body" style="padding: 4rem; color: white;">
                            <h3 class="h4 mb-4">Development Projects</h3>
                            <p class="mb-4">
                                Building responsive and modern web applications.
                            </p>
                            <div class="project-image">
                                <img src="{{ asset('images/pdev1.png') }}" alt="Development Project" class="img-fluid" style="width: auto; height: 350px; object-fit: cover; object-position: top left; position: absolute; top: 30px; right: -80px; border-radius: 20px 0 0 0;">
                            </div>
                            <div class="arrow-circle">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
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
        </style>

        <div class="row mb-5">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-0" style="border-radius: 20px; background: #e3f2fd;">
                    <div class="card-body" style="padding: 4rem;">
                        <h3 class="h4 mb-4" style="color: #1a1a1a;">Design Skills</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">UI/UX Design</li>
                            <li class="mb-2">Graphic Design</li>
                            <li>Brand Identity</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-0" style="border-radius: 20px; background: #ede7f6;">
                    <div class="card-body" style="padding: 4rem;">
                        <h3 class="h4 mb-4" style="color: #1a1a1a;">Development Skills</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">HTML/CSS</li>
                            <li class="mb-2">JavaScript</li>
                            <li>PHP/Laravel</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0" style="border-radius: 20px; background: #fffde7;">
                    <div class="card-body" style="padding: 4rem;">
                        <h3 class="h4 mb-4" style="color: #1a1a1a;">Tools</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">Figma</li>
                            <li class="mb-2">VS Code</li>
                            <li>Git</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-1" style="border-radius: 20px;">
                    <div class="card-body text-center" style="padding: 4rem;">
                        <h2 class="h3 mb-4" style="color: #1a1a1a;">Let's Work Together</h2>
                        <p class="lead mb-0">
                            Have a project in mind? Let's create something amazing together.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 