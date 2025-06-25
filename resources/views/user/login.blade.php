<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Raleway -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">

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

    <div id="card">
        <h3 id="card-title">Login</h3>
        <div class="underline-title"></div>

        <!-- Success and Error messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Login Form -->
        <form class="form" action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control form-content" id="phone" name="phone" value="{{ session('phone') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control form-content" id="password" name="password" required>
            </div>
            <button type="submit" id="submit-btn">Login</button>
        </form>

        <div id="forgot-pass">
            <a href="#">Forgot Password?</a>
        </div>

        <div id="signup">
            <a href="#">Sign Up</a>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
