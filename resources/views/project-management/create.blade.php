<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Sortable.js -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    @stack('styles')
</head>
<body>
<!-- Loading Screen -->
<div id="loadingScreen" class="position-fixed top-0 start-0 w-100 h-100 d-none" style="background: rgba(0,0,0,0.7); z-index: 9999;">
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
        <div class="spinner-border text-light mb-3" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h4 class="mb-3">Uploading Images...</h4>
        <div class="progress mb-2" style="width: 300px;">
            <div id="uploadProgress" class="progress-bar progress-bar-striped progress-bar-animated" 
                 role="progressbar" style="width: 0%"></div>
        </div>
        <p id="uploadStatus" class="mb-0">Preparing upload...</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-plus-circle-fill text-primary me-2" style="font-size: 1.5rem;"></i>
                    <h4 class="mb-0">Create New Project</h4>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('project-management.store') }}" method="POST" enctype="multipart/form-data" id="createProjectForm">
                        @csrf

                        <div class="row g-4">
                            <!-- Title -->
                            <div class="col-md-12">
                                <div class="form-floating">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" placeholder="Project Title" required>
                                    <label for="title">Project Title</label>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                </div>
                        </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" style="height: 120px" 
                                              placeholder="Project Description" required>{{ old('description') }}</textarea>
                                    <label for="description">Description</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                </div>
                        </div>

                            <!-- Technologies -->
                            <div class="col-md-12">
                                <div class="form-floating">
                            <textarea class="form-control @error('technologies') is-invalid @enderror" 
                                              id="technologies" name="technologies" style="height: 100px" 
                                              placeholder="Technologies Used" required>{{ old('technologies') }}</textarea>
                                    <label for="technologies">Technologies Used</label>
                            <div class="form-text">Enter the technologies used in this project (e.g., Laravel, React, MySQL)</div>
                            @error('technologies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                </div>
                        </div>

                            <!-- Project Type -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="design" {{ old('type') == 'design' ? 'selected' : '' }}>Design</option>
                                        <option value="programming" {{ old('type') == 'programming' ? 'selected' : '' }}>Programming</option>
                                    </select>
                                    <label for="type">Project Type</label>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- GitHub Link -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="url" class="form-control @error('github_link') is-invalid @enderror" 
                                           id="github_link" name="github_link" value="{{ old('github_link') }}" 
                                           placeholder="GitHub Repository URL">
                                    <label for="github_link">GitHub Repository URL</label>
                                    <div class="form-text">Enter the URL of your GitHub repository (optional)</div>
                                    @error('github_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Live Demo Link -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="url" class="form-control @error('live_link') is-invalid @enderror" 
                                           id="live_link" name="live_link" value="{{ old('live_link') }}" 
                                           placeholder="Live Demo URL">
                                    <label for="live_link">Live Demo URL</label>
                                    <div class="form-text">Enter the URL of your live demo (optional)</div>
                                    @error('live_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Project Images -->
                            <div class="col-12">
                                <label class="form-label">Project Images</label>
                                <div class="row g-3" id="imagePreviewContainer">
                                    <!-- Preview slots will be added here dynamically -->
                                </div>
                                <div class="mt-3">
                                    <div class="btn btn-outline-primary" id="uploadBtn">
                                        <i class="bi bi-cloud-upload me-1"></i>Choose Images
                                        <input type="file" class="d-none" id="imageInput" name="images[]" 
                                               accept="image/*" multiple />
                                    </div>
                                    <div class="form-text mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        You can select multiple images. Each image should be less than 2MB.
                                    </div>
                                </div>
                            @error('images.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                            <!-- Form Actions -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('project-management.index') }}" class="btn btn-light" id="cancelBtn">
                                        <i class="bi bi-x-circle me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                        <i class="bi bi-plus-circle me-1"></i>Create Project
                            </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Add Toast library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});

function displaySelectedImages(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('imagePreviewContainer');
    
    if (files.length > 0) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            // Validate file size
            if (file.size > 2 * 1024 * 1024) {
                Toast.fire({
                    icon: 'error',
                    title: 'File too large',
                    text: `${file.name} is larger than 2MB`
                });
                continue;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid file type',
                    text: `${file.name} is not a valid image file`
                });
                continue;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-4';
                
                const card = document.createElement('div');
                card.className = 'card h-100 border-0 shadow-sm';
                card.setAttribute('draggable', 'true');
                
                const cardBody = document.createElement('div');
                cardBody.className = 'position-relative';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'card-img-top';
                img.style.width = '100%';
                img.style.height = 'auto';
                img.style.objectFit = 'contain';
                
                const badge = document.createElement('div');
                badge.className = 'position-absolute top-0 end-0 p-2';
                badge.innerHTML = `<span class="badge bg-primary">${previewContainer.children.length + 1}</span>`;
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 start-0 m-2';
                removeBtn.innerHTML = '<i class="bi bi-x"></i>';
                removeBtn.onclick = function() {
                    col.remove();
                    updateImageNumbers();
                };
                
                cardBody.appendChild(img);
                cardBody.appendChild(badge);
                cardBody.appendChild(removeBtn);
                card.appendChild(cardBody);
                col.appendChild(card);
                previewContainer.appendChild(col);

                // Add animation class
                setTimeout(() => {
                    card.classList.add('image-loaded');
                }, 100);
            };
            reader.readAsDataURL(file);
        }

        // Show success toast
        Toast.fire({
            icon: 'success',
            title: 'Images selected successfully'
        });
    }
}

function updateImageNumbers() {
    const previewContainer = document.getElementById('imagePreviewContainer');
    const badges = previewContainer.querySelectorAll('.badge');
    badges.forEach((badge, index) => {
        badge.textContent = index + 1;
    });
}

function showLoadingScreen() {
    const loadingScreen = document.getElementById('loadingScreen');
    loadingScreen.classList.remove('d-none');
    document.body.style.overflow = 'hidden';
}

function hideLoadingScreen() {
    const loadingScreen = document.getElementById('loadingScreen');
    loadingScreen.classList.add('d-none');
    document.body.style.overflow = '';
}

function updateProgress(current, total) {
    const progressBar = document.getElementById('uploadProgress');
    const statusText = document.getElementById('uploadStatus');
    const percentage = (current / total) * 100;
    
    progressBar.style.width = `${percentage}%`;
    statusText.textContent = `Uploading image ${current} of ${total}...`;
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createProjectForm');
    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const uploadBtn = document.getElementById('uploadBtn');
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const initialFormData = new FormData(form);

    // Initialize Sortable
    new Sortable(previewContainer, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            updateImageNumbers();
        }
    });

    // Handle image upload button click
    uploadBtn.addEventListener('click', function() {
        imageInput.click();
    });

    // Handle image selection
    imageInput.addEventListener('change', displaySelectedImages);

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Check if at least one image is selected
        const previews = document.querySelectorAll('#imagePreviewContainer .card');
        if (previews.length === 0) {
            Toast.fire({
                icon: 'error',
                title: 'No images selected',
                text: 'Please select at least one image for the project'
            });
            return;
        }

        // Check if form has changes
        const currentFormData = new FormData(form);
        let hasChanges = false;

        // Check text inputs
        for (let [key, value] of currentFormData.entries()) {
            if (key !== 'images[]' && value !== initialFormData.get(key)) {
                hasChanges = true;
                break;
            }
        }

        // Check if any new images are selected
        if (!hasChanges && previews.length > 0) {
            hasChanges = true;
        }

        if (hasChanges) {
            Swal.fire({
                title: 'Create Project?',
                text: 'Are you sure you want to create this project?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, create it',
                cancelButtonText: 'No, cancel',
                customClass: {
                    popup: 'animated fadeInDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoadingScreen();
                    updateProgress(0, previews.length);
                    
                    // Simulate upload progress
                    let currentUpload = 0;
                    const uploadInterval = setInterval(() => {
                        currentUpload++;
                        updateProgress(currentUpload, previews.length);
                        
                        if (currentUpload >= previews.length) {
                            clearInterval(uploadInterval);
                            form.submit();
                        }
                    }, 1000);
                }
            });
        } else {
            form.submit();
        }
    });

    // Handle cancel button
    cancelBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Check if form has changes
        const currentFormData = new FormData(form);
        let hasChanges = false;

        // Check text inputs
        for (let [key, value] of currentFormData.entries()) {
            if (key !== 'images[]' && value !== initialFormData.get(key)) {
                hasChanges = true;
                break;
            }
        }

        // Check if any new images are selected
        if (!hasChanges) {
            const previews = document.querySelectorAll('#imagePreviewContainer .card');
            if (previews.length > 0) {
                hasChanges = true;
            }
        }

        if (hasChanges) {
            Swal.fire({
                title: 'Cancel Creation?',
                text: 'Are you sure you want to cancel? Any unsaved changes will be lost.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel',
                cancelButtonText: 'No, continue editing',
                customClass: {
                    popup: 'animated fadeInDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href;
                }
            });
        } else {
            window.location.href = this.href;
        }
    });
});
</script>

@push('styles')
<style>
.sortable-ghost {
    opacity: 0.4;
    background: #f8f9fa;
}

.card {
    cursor: move;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    transition: all 0.3s ease;
    pointer-events: none;
}

.card:hover .card-img-top {
    opacity: 0.9;
}

.image-loaded {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.btn-outline-primary {
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.badge {
    transition: all 0.3s ease;
}

.card:hover .badge {
    transform: scale(1.1);
}

.btn-danger {
    opacity: 0;
    transition: all 0.3s ease;
}

.card:hover .btn-danger {
    opacity: 1;
}

.btn-danger:hover {
    transform: scale(1.1);
}

#loadingScreen {
    backdrop-filter: blur(5px);
}

.progress {
    height: 20px;
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.2);
}

.progress-bar {
    background-color: #0d6efd;
    border-radius: 10px;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}
</style>
@endpush

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>