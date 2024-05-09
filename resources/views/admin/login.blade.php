<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/app.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('admin-assets/img/favicon.ico') }}">
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.authenticate') }}" class="needs-validation"
                                    novalidate="">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" value="{{ old('email') }}" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email" autocomplete="new-email">
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" autocomplete="new-password">
                                        @error('password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <div class="float-right">
                                            <a href="{{ route('admin.forgot_password') }}" class="text-small">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="auth-register.html">Create One</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('admin-assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('admin-assets//js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('admin-assets//js/custom.js') }}"></script>
</body>

</html>
