<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom Style (Optional) -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 30px;
        }
        .card {
            border-radius: 10px;
        }
        .card-header {
            font-size: 1.5rem;
            font-weight: 500;
        }
        .btn-primary {
            font-size: 1rem;
            font-weight: bold;
        }
        .form-control {
            height: calc(2.75rem + 2px);
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-user-plus"></i> {{ __('Register') }}</h4>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="name" class="font-weight-bold">{{ __('Name') }}</label>
                                <input id="name" type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" 
                                       required autocomplete="name" autofocus
                                       placeholder="Enter your full name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="font-weight-bold">{{ __('Email Address') }}</label>
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" 
                                       required autocomplete="email"
                                       placeholder="Enter your email address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="font-weight-bold">{{ __('Password') }}</label>
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required autocomplete="new-password"
                                       placeholder="Enter a secure password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password-confirm" class="font-weight-bold">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" 
                                       class="form-control" 
                                       name="password_confirmation" 
                                       required autocomplete="new-password"
                                       placeholder="Re-enter your password">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-primary text-white">
                        <small>Already have an account? <a href="{{ route('login') }}" class="text-white font-weight-bold">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (Includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
