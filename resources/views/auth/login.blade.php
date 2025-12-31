<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Company Management</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light py-3">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card bg-primary text-white shadow-lg">
                    <div class="card-body p-4 p-md-5">

                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="bi bi-building-fill text-white bg-primary rounded-circle p-3" style="font-size:2.5rem;"></i>
                            </div>
                            <h2 class="fw-bold">Company Management</h2>
                            <p class="text-white-50">Sign in to manage your companies</p>
                        </div>

                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="alert alert-light alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <!-- Error Message -->
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <!-- Validation Errors -->
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login.submit') }}" novalidate>
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold text-white">
                                    <i class="bi bi-envelope"></i> Email Address
                                </label>
                                <input type="email" 
                                        class="form-control form-control-lg bg-white text-dark @error('email') is-invalid @enderror" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        placeholder="Enter your email"
                                        required 
                                        autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold text-white">
                                    <i class="bi bi-lock"></i> Password
                                </label>
                                <input type="password" 
                                        class="form-control form-control-lg bg-white text-dark @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Enter your password"
                                        required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me Checkbox -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label text-white" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-light btn-lg fw-semibold">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </button>
                            </div>
                        </form>

                        <!-- Demo Credentials -->
                        <div class="mt-4">
                            <div class="bg-white text-dark rounded p-3">
                                <p class="mb-2 fw-semibold text-center mb-0">
                                    <i class="bi bi-info-circle"></i> Demo Credentials
                                </p>
                                <div class="text-center">
                                    <small class="text-muted d-block">
                                        <strong>Email:</strong> admin@admin.com
                                    </small>
                                    <small class="text-muted d-block">
                                        <strong>Password:</strong> password
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-3">
                    <p class="text-white small mb-0">&copy; {{ date('Y') }} Company Management System</p>
                </div>
            </div>
        </div>
    </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>