<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Company Management</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-primary">
    
  <div class="container px-4 py-4 mt-5">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow-lg px-2 py-2 mt-5">
                <div class="card-header border-0 text-center">
                    <div class="row">
                        <h5 class="mt-3">Company Management</h5>
                    </div>
                    <div class="row">
                        <h6 class="text-muted">Sign in to manage your companies</h6>
                    </div>
                    @if(session('error'))
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="card-body">

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

                            <form method="POST" action="{{ route('login.submit') }}" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="email" class="form-control form-control-lg {{ ($errors->has('email')) ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Email" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="password" name="password" id="pwd" class="form-control form-control-lg {{ ($errors->has('password')) ? 'is-invalid' : '' }}" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex align-items-center">
                                    <input class="form-check-input me-2" type="checkbox" id="showpw" onclick="showPw()">
                                    <label class="form-check-label" for="showpw">Show Password</label>
                                </div>

                                <div class="row mt-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-block mb-3" id="btn"><i class="bi bi-box-arrow-in-right me-1"></i> Log in</button>
                                    </div>
                                </div>
                            </form>
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

                <!-- Footer (optional small footer) -->
                <div class="text-center mt-3">
                    <p class="small text-white mb-0">&copy; {{ date('Y') }} Company Management System</p>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script>
    function showPw(){
        const pwd = document.getElementById('pwd');
        if(pwd.type === 'password'){
            pwd.type = 'text';
        } else {
            pwd.type = 'password';
        }
    }
  </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>