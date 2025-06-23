<!-- Header -->
<header class="py-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="d-flex align-items-center">
                <div class="rounded-circle me-2 d-flex align-items-center justify-content-center" 
                     style="width: 10px; height: 10px; background-color: #B1F040;">
                </div>
                <a class="navbar-brand" href="{{ url('/') }}" style="color: #1a1a1a; font-size: 1.5rem; letter-spacing: -0.5px; font-weight: 500;">
                    <span class="name">Rian Mubarok</span>
                    <span class="available">( available )</span>
                </a>
            </div>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}" style="color: #4a4a4a; transition: color 0.3s ease;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}" style="color: #4a4a4a; transition: color 0.3s ease;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ request()->is('projects') ? 'active' : '' }}" href="{{ url('/projects') }}" style="color: #4a4a4a; transition: color 0.3s ease;">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}" style="color: #4a4a4a; transition: color 0.3s ease;">Contact</a>
                    </li>

                    <!-- Authentication Links -->
                    @auth
                        @if(Auth::user()->hasLevel('Admin'))
                            <li class="nav-item">
                                <a class="nav-link fw-medium {{ request()->routeIs('project-management.*') ? 'active' : '' }}" href="{{ route('project-management.index') }}" style="color: #4a4a4a; transition: color 0.3s ease;">Manage Projects</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium" href="#" role="button" data-bs-toggle="dropdown" style="color: #4a4a4a;">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>

<style>
    .navbar-brand {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .available {
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
        margin-left: 8px;
        font-size: 1rem;
        color: #4a4a4a;
        position: absolute;
        left: 100%;
        bottom: 25%;
    }

    .navbar-brand:hover .available {
        opacity: 1;
        transform: translateY(0);
    }

    .nav-link {
        position: relative;
        padding: 0.5rem 1rem;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: #1a1a1a;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 80%;
    }
    
    .nav-link:hover,
    .nav-link.active {
        color: #1a1a1a !important;
    }

    .nav-link.dropdown-toggle::after {
        display: none;
    }
</style> 