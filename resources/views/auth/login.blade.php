<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Required CSS Links -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Global styles */
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Purple to Blue gradient */
            font-family: 'Raleway', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            text-align: center;
        }

        #card-title {
            font-size: 26px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .underline-title {
            width: 60px;
            height: 3px;
            background-color: #24c64f;
            margin: 0 auto 25px;
        }

        .form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-content {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-content:focus {
            outline: none;
            border-color: #24c64f;
            box-shadow: 0 0 10px rgba(36, 198, 79, 0.3);
        }

        #submit-btn {
            background: linear-gradient(135deg, #24c64f, #2dbd6e);
            border: none;
            border-radius: 30px;
            color: white;
            padding: 12px 0;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #submit-btn:hover {
            background: linear-gradient(135deg, #2dbd6e, #24c64f);
            box-shadow: 0 5px 15px rgba(36, 198, 79, 0.3);
        }

        /* Links and footers */
        #forgot-pass, #signup {
            margin-top: 15px;
        }

        #forgot-pass a, #signup a {
            color: #0072ff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        #forgot-pass a:hover, #signup a:hover {
            color: #24c64f;
            text-decoration: underline;
        }

        /* Responsive design */
        @media (max-width: 500px) {
            #card {
                padding: 25px;
                width: 90%;
            }

            #card-title {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-8">
                <div id="card">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Card Header -->
                    <div id="card-title">
                        <h4 class="mb-0">{{ __('Login') }}</h4>
                        <div class="underline-title"></div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group mb-4">
                                <label for="email" class="fw-bold">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-content @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Enter your email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-4">
                                <label for="password" class="fw-bold">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-content @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <!-- <div class="form-group mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> -->

                            <!-- Submit Button -->
                            <div class="form-group mb-0">
                                <button type="submit" id="submit-btn" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>

                          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Scripts -->
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
