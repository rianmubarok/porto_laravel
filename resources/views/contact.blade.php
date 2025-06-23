@extends('layouts.app')

@section('title', 'Contact - My Portfolio')

@section('content')
    <div class="container">
        <!-- Row 1: Contact Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-5">
                        <h1 class="display-4 fw-bold mb-4" style="letter-spacing: -2px; color: #1a1a1a;">
                            Get in Touch
                        </h1>
                        <p class="lead mb-0" style="color: #4a4a4a;">
                            Have a project in mind? Let's discuss how we can work together to bring your ideas to life.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: Contact Form -->
        <div class="row mb-5">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card border-0" style="border-radius: 20px; background: white; border: 1px solid #e0e0e0;">
                    <div class="card-body p-5">
                        <form>
                            <div class="mb-4 form-floating-custom">
                                <input type="text" class="form-control-custom" id="name" placeholder=" " autocomplete="off">
                                <label for="name">Name</label>
                            </div>
                            <div class="mb-4 form-floating-custom">
                                <input type="email" class="form-control-custom" id="email" placeholder=" " autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-4 form-floating-custom">
                                <input type="text" class="form-control-custom" id="subject" placeholder=" " autocomplete="off">
                                <label for="subject">Subject</label>
                            </div>
                            <div class="mb-4 form-floating-custom">
                                <textarea class="form-control-custom" id="message" rows="5" placeholder=" " style="height: 150px;"></textarea>
                                <label for="message">Message</label>
                            </div>
                            <button type="submit" class="btn btn-dark px-4 py-2">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);">
                    <div class="card-body p-5">
                        <h3 class="h4 mb-4" style="color: #1a1a1a;">Contact Information</h3>
                        <div class="mb-4">
                            <h4 class="h5 mb-2" style="color: #1a1a1a;">Email</h4>
                            <p class="mb-0" style="color: #4a4a4a;">rian.mubarok30@gmail.com</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="h5 mb-2" style="color: #1a1a1a;">Location</h4>
                            <p class="mb-0" style="color: #4a4a4a;">Jepara, Indonesia</p>
                        </div>
                        <div>
                            <h4 class="h5 mb-3" style="color: #1a1a1a;">Social Media</h4>
                            <div class="d-flex gap-3">
                                <a href="#" class="text-dark" style="font-size: 1.5rem;"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-dark" style="font-size: 1.5rem;"><i class="bi bi-github"></i></a>
                                <a href="#" class="text-dark" style="font-size: 1.5rem;"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
    .form-floating-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-control-custom {
            display: block;
            width: 100%;
            padding: 1rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-floating-custom > label {
            position: absolute;
            top: 1rem;
            left: 0.75rem;
            height: fit-content;
            pointer-events: none;
            transform-origin: 0 0;
            transition: all 0.2s ease-in-out;
            color: #6c757d;
            background-color: transparent;
            padding: 0 0.25rem;
        }
        
        .form-floating-custom > .form-control-custom:focus,
        .form-floating-custom > .form-control-custom:not(:placeholder-shown) {
            border-color: #1a1a1a;
            outline: 0;
        }
        
        .form-floating-custom > .form-control-custom:focus ~ label,
        .form-floating-custom > .form-control-custom:not(:placeholder-shown) ~ label {
            transform: translateY(-1.75rem) scale(0.85);
            color: #1a1a1a;
            background-color: white; /* Match card background */
        }
        
        textarea.form-control-custom {
            min-height: calc(1.5em + 1rem + 2px);
        }
        
        /* Adjust for the gradient card background */
        .form-floating-custom > .form-control-custom:focus ~ label,
        .form-floating-custom > .form-control-custom:not(:placeholder-shown) ~ label {
            background-color: white; /* Match the card's gradient start color */
        }
    </style>
@endsection 