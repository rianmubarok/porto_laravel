@extends('layouts.app')

@section('title', 'About - My Portfolio')

@section('content')
    <div class="container">
        <!-- Row 1: About Me -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card h-100 border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-5">
                        <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -2px; color: #1a1a1a;">
                            About Me
                        </h1>
                        <p class="lead mb-4" style="color: #4a4a4a;">
                            I'm a passionate graphic designer and junior developer based in Indonesia. With a keen eye for design and a love for coding, I create beautiful and functional digital experiences.
                        </p>
                        <p class="mb-0" style="color: #4a4a4a;">
                            My journey in design and development started with a curiosity about how things work on the internet. This curiosity led me to explore both the creative and technical aspects of web development.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100 border-0" style="border-radius: 20px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4" style="color: #1a1a1a;">Experience</h2>
                        <div class="mb-4">
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Icon Designer</h3>
                            <p class="mb-1" style="color: #4a4a4a;">Mangun Creative</p>
                            <p class="small text-muted mb-0">2023 - Present</p>
                        </div>
                        <div class="mb-4">
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Freelance Designer</h3>
                            <p class="mb-1" style="color: #4a4a4a;">Self-employed</p>
                            <p class="small text-muted mb-0">2020 - Present</p>
                        </div>
                        <div>
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Junior Developer</h3>
                            <p class="mb-1" style="color: #4a4a4a;">Independent Projects</p>
                            <p class="small text-muted mb-0">2023 - Present</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Row 2: Education & Certifications -->
       <div class="row mb-5">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card h-100 border-0" style="border-radius: 20px; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4" style="color: #1a1a1a;">Education</h2>
                        <div>
                            <h3 class="h5 mb-2" style="color: #1a1a1a;">Informatics Engineering</h3>
                            <p class="mb-1" style="color: #4a4a4a;">UNISNU Jepara</p>
                            <p class="small text-muted mb-0">2023 - Present</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0" style="border-radius: 20px; background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4" style="color: #1a1a1a;">Certifications</h2>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2" style="color: #4a4a4a;">KelasFullstack.id – Web Dev Bootcamp</li>
                            <li class="mb-2" style="color: #4a4a4a;">Dicoding – Dasar Pemrograman Web</li>
                            <li style="color: #4a4a4a;">(Coming Soon)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 3: Interests -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4" style="color: #1a1a1a;">Interests</h2>
                        <div class="row">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h3 class="h5 mb-3" style="color: #1a1a1a;">Design</h3>
                                <p class="mb-0" style="color: #4a4a4a;">Creating beautiful and intuitive user interfaces that enhance user experience.</p>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h3 class="h5 mb-3" style="color: #1a1a1a;">Development</h3>
                                <p class="mb-0" style="color: #4a4a4a;">Building responsive and efficient web applications using modern technologies.</p>
                            </div>
                            <div class="col-md-4">
                                <h3 class="h5 mb-3" style="color: #1a1a1a;">Learning</h3>
                                <p class="mb-0" style="color: #4a4a4a;">Continuously exploring new technologies and design trends to stay updated.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secret Login Link -->
        @guest
        <div class="text-center mt-5">
            <small class="text-muted">
                Are you Rian? 
                <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login here</a>.
            </small>
        </div>
        @endguest
        
    </div>
@endsection 