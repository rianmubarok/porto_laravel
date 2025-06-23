@extends('layouts.app')

@section('title', 'Project Management')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">Project Management</h1>
        <a href="{{ route('project-management.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Project
        </a>
    </div>
    <div class="masonry-grid">
        @foreach($projects as $project)
        <div class="masonry-item mb-3">
            <div class="card border-0 position-relative" style="border-radius: 16px; background: #fff;">
                <div class="masonry-img-wrapper mb-2">
                    @if($project->images->isNotEmpty())
                    <img src="{{ $project->images->first()->image_url }}" alt="{{ $project->title }}" class="masonry-img" style="background: #f3f3f3;">
                    @endif
                </div>
                <div class="mb-2 d-flex flex-wrap gap-1">
                    @foreach(explode(',', $project->technologies) as $tech)
                        <span class="badge-tag">#{{ trim($tech) }}</span>
                    @endforeach
                </div>
                <div class="fw-bold" style="font-size: 0.98rem; color: #222; line-height: 1.2;">{{ $project->title }}</div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <a href="{{ route('project-management.edit', $project) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="{{ route('project-management.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.masonry-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
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
.badge-tag {
    background: #f3f3f3;
    color: #444;
    border-radius: 999px;
    font-size: 0.75rem;
    padding: 0.18em 0.7em;
    font-weight: 500;
    display: inline-block;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete project confirmation
    const deleteForms = document.querySelectorAll('.delete-project-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Delete Project?',
                text: 'Are you sure you want to delete this project? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'No, cancel',
                customClass: {
                    popup: 'animated fadeInDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.2rem;
}

.btn i {
    transition: transform 0.3s ease;
}

.btn:hover i {
    transform: scale(1.1);
}
</style>
@endpush
@endsection 