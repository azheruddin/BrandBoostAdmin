<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrandBoost India</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Base Styles */
        .brand-title {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .category-card {
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background-color: #ffffff;
        }
        .category-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .category-header {
            background-color: #f8f9fa;
            border-radius: 8px 8px 0 0;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .category-body {
            padding: 15px;
        }
        .highlight {
            color: #e74c3c;
            font-weight: 600;
        }
        .toggle-btn {
            background-color: #3498db;
            border: none;
            padding: 5px 15px;
            font-size: 0.9rem;
            color: #ffffff;
        }
        .toggle-btn:hover {
            background-color: #2980b9;
        }
        .more-details {
            background-color: #f8fbfd;
            border-left: 3px solid #3498db;
            padding: 15px;
            margin-top: 10px;
            display: none;
            color: #2c3e50;
        }
        .language-badge {
            background-color: #eaf2f8;
            color: #2980b9;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            margin-right: 5px;
        }
        .carousel-item img {
            object-fit: cover;
            height: 500px;
        }
        .carousel-caption {
            bottom: 20%;
        }
        .carousel-control-prev, .carousel-control-next {
            width: 5%;
        }
        .feature-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feature-hover:hover {
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 8px 32px rgba(52,152,219,0.15), 0 1.5px 8px rgba(231,76,60,0.08);
            z-index: 2;
        }
        .feature-icon {
            transition: background 0.3s, transform 0.3s;
        }
        .feature-hover:hover .feature-icon {
            background: linear-gradient(135deg, #3498db22 0%, #e74c3c22 100%);
            transform: scale(1.1) rotate(-6deg);
        }
        .btn-gradient {
            background: linear-gradient(90deg, #3498db, #e74c3c);
            color: #fff;
            border: none;
            transition: background 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 16px rgba(52,152,219,0.12);
        }
        .btn-gradient:hover {
            background: linear-gradient(90deg, #e74c3c, #3498db);
            color: #fff;
            box-shadow: 0 8px 32px rgba(231,76,60,0.15);
        }
        .feature-zoom {
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .feature-zoom:hover {
            transform: scale(1.04) translateY(-4px);
            box-shadow: 0 8px 32px rgba(52,152,219,0.12);
            z-index: 2;
        }
        .text-gradient {
            background: linear-gradient(90deg, #3498db, #e74c3c);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        .dark-mode .navbar {
            background-color: #1f1f1f;
            border-bottom: 1px solid #333;
        }
        .dark-mode .navbar-brand span {
            color: #e0e0e0 !important;
        }
        .dark-mode .nav-link {
            color: #e0e0e0 !important;
        }
        .dark-mode .nav-link:hover {
            color: #3498db !important;
        }
        .dark-mode .card, .dark-mode .category-card {
            background-color: #1f1f1f;
            color: #e0e0e0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5);
        }
        .dark-mode .alert {
            background-color: #23272b;
            color: #e0e0e0;
            border-color: #444;
        }
        .dark-mode .highlight {
            color: #f39c12;
        }
        .dark-mode .list-unstyled li {
            color: #e0e0e0;
        }
        .dark-mode .brand-title {
            color: #f1c40f;
            border-bottom-color: #3498db;
        }
        .dark-mode .category-header {
            background-color: #23272b;
            border-bottom: 1px solid #444;
        }
        .dark-mode .more-details {
            background-color: #23272b;
            color: #e0e0e0;
            border-left: 3px solid #3498db;
        }
        .dark-mode .language-badge {
            background-color: #34495e;
            color: #e0e0e0;
        }
        .dark-mode .text-secondary {
            color: #b0b0b0 !important;
        }
        .dark-mode .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }
        .dark-mode .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .dark-mode .btn-outline-primary {
            border-color: #3498db;
            color: #3498db;
        }
        .dark-mode .btn-outline-primary:hover {
            background-color: #3498db;
            color: #ffffff;
        }
        .dark-mode .btn-outline-dark {
            border-color: #e0e0e0;
            color: #e0e0e0;
        }
        .dark-mode .btn-outline-dark:hover {
            background-color: #e0e0e0;
            color: #121212;
        }
        .dark-mode .badge {
            color: #ffffff !important;
        }
        .dark-mode .carousel-caption {
            background: rgba(44,62,80,0.7);
            color: #e0e0e0;
        }
        .dark-mode .carousel-caption h5 {
            color: #f1c40f;
        }
        .dark-mode .carousel-caption p {
            color: #e0e0e0;
        }
        .dark-mode .feature-zoom {
            background: linear-gradient(135deg, #23272b 0%, #2c3035 100%) !important;
        }
        .dark-mode footer {
            background-color: #1f1f1f;
        }
        .dark-mode footer a {
            color: #3498db;
        }
        .dark-mode footer a:hover {
            color: #f39c12;
        }
        .dark-mode .animated-footer-bg::before {
            background: linear-gradient(270deg, #23272b, #2c3035, #23272b, #2c3035);
        }

        /* Dark Mode Styles for #feature Section */
        .dark-mode #feature {
            background-color: #121212 !important;
            color: #e0e0e0 !important;
        }

        .dark-mode #feature .card {
            background-color: #1f1f1f;
            color: #e0e0e0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.5);
        }

        .dark-mode #feature .feature-icon {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dark-mode #feature .badge {
            background-color: #444;
            color: #ffffff;
        }

        .dark-mode #feature .btn-gradient {
            background: linear-gradient(90deg, #3498db, #e74c3c);
            color: #ffffff;
            box-shadow: 0 4px 16px rgba(52, 152, 219, 0.12);
        }

        .dark-mode #feature .btn-gradient:hover {
            background: linear-gradient(90deg, #e74c3c, #3498db);
            box-shadow: 0 8px 32px rgba(231, 76, 60, 0.15);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center me-auto" href="#">
                <img src="{{ asset('assets/img/BrandBoost.jpg') }}" height="48" alt="BrandBoost Logo" class="me-2" style="object-fit: contain;">
                <span class="fw-bold text-danger fs-4 d-none d-md-inline">Brand <span class="text-dark">Boost</span></span>
            </a>
            <div class="d-none d-lg-flex mx-auto">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#appdetails">App Screen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#feature">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#appdetails">App Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#contact">About</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-block ms-auto">
                <a href="#getapp" class="btn btn-primary rounded-pill px-4 fw-semibold">Get the App</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button id="darkModeToggle" class="btn btn-outline-dark ms-auto">
                <i class="bi bi-moon-fill"></i> Dark Mode
            </button>
        </div>
    </nav>
<br>
<br>
<br>
    <div id="brandBoostCarousel" class="carousel slide mb-4 shadow rounded-4 overflow-hidden" data-bs-ride="carousel" style="max-width: 1100px; margin: 0 auto;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#brandBoostCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#brandBoostCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#brandBoostCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="max-height: 600px;">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/n.png') }}" class="d-block w-100" alt="BrandBoost Feature 1" style="object-fit: cover; height: 600px;">
                <div class="carousel-caption d-none d-md-block bg-gradient p-3 rounded-3" style="background: rgba(44,62,80,0.7);">
                    <h5 class="fw-bold text-warning">Inspirational Quotes</h5>
                    <p class="mb-0 text-light">Discover thousands of motivational quotes for every situation.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/v.png') }}" class="d-block w-100" alt="BrandBoost Feature 2" style="object-fit: cover; height: 600px;">
                <div class="carousel-caption d-none d-md-block bg-gradient p-3 rounded-3" style="background: rgba(52,152,219,0.7);">
                    <h5 class="fw-bold text-warning">Beautiful Shayari</h5>
                    <p class="mb-0 text-light">Express your emotions with our poetic collections.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/r.png') }}" class="d-block w-100" alt="BrandBoost Feature 3" style="object-fit: cover; height: 600px;">
                <div class="carousel-caption d-none d-md-block bg-gradient p-3 rounded-3" style="background: rgba(231,76,60,0.7);">
                    <h5 class="fw-bold text-warning">Festival Wishes</h5>
                    <p class="mb-0 text-light">Celebrate every occasion with perfect greetings.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#brandBoostCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" style="filter: drop-shadow(0 0 2px #000);"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#brandBoostCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" style="filter: drop-shadow(0 0 2px #000);"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="py-5 bg-light position-relative"  id="feature">
        <div class="container">
            <h2 class="text-center fw-bold mb-4" style="font-size:2.3rem; letter-spacing:1px;">
                <span class="text-gradient">Why Choose BrandBoost?</span>
            </h2>
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-lg feature-hover position-relative overflow-hidden">
                        <div class="card-body text-center py-5">
                            <div class="feature-icon mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-25" style="width:70px;height:70px;">
                                <i class="bi bi-quote text-warning fs-1"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Inspirational Quotes</h5>
                            <p class="text-secondary mb-0">Thousands of motivational and positive quotes for every mood and moment.</p>
                        </div>
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 shadow">Hot</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-lg feature-hover position-relative overflow-hidden">
                        <div class="card-body text-center py-5">
                            <div class="feature-icon mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-25" style="width:70px;height:70px;">
                                <i class="bi bi-heart-fill text-danger fs-1"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Beautiful Shayari</h5>
                            <p class="text-secondary mb-0">Express your feelings with poetic shayari in multiple languages.</p>
                        </div>
                        <span class="badge bg-danger text-white position-absolute top-0 end-0 m-2 shadow">New</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-lg feature-hover position-relative overflow-hidden">
                        <div class="card-body text-center py-5">
                            <div class="feature-icon mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-25" style="width:70px;height:70px;">
                                <i class="bi bi-stars text-success fs-1"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Festival Wishes</h5>
                            <p class="text-secondary mb-0">Celebrate every occasion with unique festival greetings and images.</p>
                        </div>
                        <span class="badge bg-success text-white position-absolute top-0 end-0 m-2 shadow">Trending</span>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-lg feature-hover position-relative overflow-hidden">
                        <div class="card-body text-center py-5">
                            <div class="feature-icon mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-25" style="width:70px;height:70px;">
                                <i class="bi bi-person-badge-fill text-info fs-1"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Personalized Messages</h5>
                            <p class="text-secondary mb-0">Create and share custom messages and images with your name or wishes.</p>
                        </div>
                        <span class="badge bg-info text-white position-absolute top-0 end-0 m-2 shadow">Try Now</span>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#getapp" class="btn btn-gradient px-5 py-3 fs-5 fw-bold rounded-pill shadow">
                    <i class="bi bi-download me-2"></i>Get BrandBoost App Now
                </a>
            </div>
        </div>
    </section>

    <section class="container mb-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card h-100 text-center shadow border-0 position-relative overflow-hidden feature-zoom" style="background: linear-gradient(135deg, #e3f0ff 0%, #fafcff 100%);">
                    <img src="{{ asset('assets/img/m.jpg') }}" class="card-img-top" alt="Quotes" style="height:120px;object-fit:cover; border-radius: 0 0 30px 30px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary">
                            <i class="bi bi-chat-quote-fill me-1 text-warning"></i> Quotes
                        </h5>
                        <p class="card-text text-secondary">Inspirational and motivational quotes for every mood.</p>
                    </div>
                    <span class="position-absolute top-0 end-0 badge rounded-pill bg-warning text-dark m-2 shadow">Hot</span>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center shadow border-0 position-relative overflow-hidden feature-zoom" style="background: linear-gradient(135deg, #fff0f6 0%, #f9f6ff 100%);">
                    <img src="{{ asset('assets/img/u.png') }}" class="card-img-top" alt="Shayari" style="height:120px;object-fit:cover; border-radius: 0 0 30px 30px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-danger">
                            <i class="bi bi-heart-fill me-1 text-pink"></i> Shayari
                        </h5>
                        <p class="card-text text-secondary">Express your emotions with beautiful shayari collections.</p>
                    </div>
                    <span class="position-absolute top-0 end-0 badge rounded-pill bg-danger text-white m-2 shadow">New</span>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center shadow border-0 position-relative overflow-hidden feature-zoom" style="background: linear-gradient(135deg, #fffbe7 0%, #fffdf6 100%);">
                    <img src="{{ asset('assets/img/v.png') }}" class="card-img-top" alt="Festivals" style="height:120px;object-fit:cover; border-radius: 0 0 30px 30px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-success">
                            <i class="bi bi-stars me-1 text-warning"></i> Festivals
                        </h5>
                        <p class="card-text text-secondary">Celebrate every occasion with unique festival wishes.</p>
                    </div>
                    <span class="position-absolute top-0 end-0 badge rounded-pill bg-success text-white m-2 shadow">Trending</span>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center shadow border-0 position-relative overflow-hidden feature-zoom" style="background: linear-gradient(135deg, #e6fff7 0%, #f6fffa 100%);">
                    <img src="{{ asset('assets/img/n.png') }}" class="card-img-top" alt="Personalized" style="height:120px;object-fit:cover; border-radius: 0 0 30px 30px;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-info">
                            <i class="bi bi-person-badge-fill me-1 text-info"></i> Personalized
                        </h5>
                        <p class="card-text text-secondary">Create and share personalized messages and images.</p>
                    </div>
                    <span class="position-absolute top-0 end-0 badge rounded-pill bg-info text-white m-2 shadow">Try Now</span>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card h-100 shadow border-0" style="background: linear-gradient(135deg, #eaf6ff 0%, #f8fbff 100%);">
                    <div class="card-body">
                        <h1 id="appdetails" class="brand-title text-center text-primary mb-4" style="font-size:2.2rem;">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>BrandBoost - Details
                        </h1>
                        <h2 class="h4 text-primary mb-3"><i class="bi bi-app-indicator me-2 text-info"></i>App Overview</h2>
                        <p>
                            <span class="highlight">BrandBoost</span> – <span class="fw-semibold text-success">Download, Share & Post Unique Quotes, Messages, Shayari, Images & Videos</span>
                        </p>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Daily inspiration & emotional expression</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Motivate, celebrate, or express love & devotion</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Beautifully designed quotes, messages, shayari, and images</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Share instantly on WhatsApp, Instagram, Facebook, and more</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Personalize images with your name</li>
                        </ul>
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <i class="bi bi-gift-fill me-2 fs-4"></i>
                            <span>Download the BrandBoost App for <b>fresh, free content</b> every day!</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                @php
                    $imagePaths = [
                        asset('assets/img/m1.jpg'),
                        asset('assets/img/m2.jpg'),
                        asset('assets/img/m3.jpg'),
                    ];
                @endphp
                <div class="position-relative d-inline-block shadow rounded-4 overflow-hidden" style="background: #fff; border: 4px solid #eaf2f8; max-width: 320px;">
                    <img id="brandImage" src="{{ $imagePaths[0] }}" alt="BrandBoost App Screen" class="img-fluid rounded-4" style="max-height: 380px; transition: box-shadow 0.3s;">
                    <span class="position-absolute top-0 start-50 translate-middle-x badge bg-primary text-white px-3 py-2 shadow" style="font-size:1rem; border-radius: 0 0 1rem 1rem;">
                        <i class="bi bi-phone-fill me-1"></i>App Preview
                    </span>
                </div>
                <div class="mt-4 d-flex justify-content-center gap-3">
                    <button class="btn btn-outline-primary rounded-pill px-4" onclick="prevImage()">
                        <i class="bi bi-arrow-left-circle me-1"></i>Previous
                    </button>
                    <button class="btn btn-primary rounded-pill px-4" onclick="nextImage()">
                        Next<i class="bi bi-arrow-right-circle ms-1"></i>
                    </button>
                </div>
                <div class="mt-3">
                    <span class="badge bg-info text-white me-1">Quotes</span>
                    <span class="badge bg-warning text-dark me-1">Shayari</span>
                    <span class="badge bg-success">Festivals</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-gradient">Trending Categories</h2>
            <p class="lead text-secondary">At <span class="fw-bold text-primary">BrandBoost</span>, explore curated categories that match your emotions and every special occasion.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex align-items-center bg-primary bg-opacity-10">
                        <i class="bi bi-flower1 fs-2 text-warning me-2"></i>
                        <h3 class="h5 mb-0">Devotional Content</h3>
                    </div>
                    <div class="category-body">
                        <p>Peaceful darshan images, bhakti suvichar, and mantras for spiritual positivity.</p>
                        <ul>
                            <li>Images of <span class="fw-semibold text-primary">Shiv Jee</span>, <span class="fw-semibold text-danger">Hanuman Jee</span>, <span class="fw-semibold text-success">Khatu Shyam</span></li>
                            <li>Spiritual quotes, bhajans, and morning blessings</li>
                            <li>Festival-specific devotional greetings</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex justify-content-between align-items-center bg-warning bg-opacity-10">
                        <div>
                            <i class="bi bi-lightbulb-fill fs-2 text-warning me-2"></i>
                            <h3 class="h5 mb-0 d-inline">Motivational & Inspirational Quotes</h3>
                        </div>
                        <button class="toggle-btn btn btn-sm" onclick="toggleDetails('motivational-details')">More Details</button>
                    </div>
                    <div class="category-body">
                        <p>Empower yourself and others with motivational good morning quotes and suvichar.</p>
                        <div id="motivational-details" class="more-details">
                            <p>Share daily doses of inspiration with:</p>
                            <ul>
                                <li>Productivity-boosting morning messages</li>
                                <li>Quotes about success, hustle, and strength</li>
                                <li>Visual wisdom that speaks directly to the soul</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-6">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex justify-content-between align-items-center bg-info bg-opacity-10">
                        <div>
                            <i class="bi bi-sunrise-fill fs-2 text-info me-2"></i>
                            <h3 class="h5 mb-0 d-inline">Good Morning & Good Night Messages</h3>
                        </div>
                        <button class="toggle-btn btn btn-sm" onclick="toggleDetails('greetings-details')">More Details</button>
                    </div>
                    <div class="category-body">
                        <p>Start and end your day with warmth and care through crafted messages.</p>
                        <div id="greetings-details" class="more-details">
                            <ul>
                                <li>Heartfelt morning greetings for friends and family</li>
                                <li>Soothing night quotes that send love and calm</li>
                                <li>Stunning images with sunrise and moonlight visuals</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shayari and Festive Wishes Section -->
            <div class="col-md-6">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex justify-content-between align-items-center bg-danger bg-opacity-10">
                        <div>
                            <i class="bi bi-heart-fill fs-2 text-danger me-2"></i>
                            <h3 class="h5 mb-0 d-inline">Shayari for Every Mood</h3>
                        </div>
                        <button class="toggle-btn btn btn-sm" onclick="toggleDetails('shayari-details')">More Details</button>
                    </div>
                    <div class="category-body">
                        <p>Let your emotions speak through poetry.</p>
                        <div id="shayari-details" class="more-details">
                            <p>Choose from our diverse collection of:</p>
                            <ul>
                                <li>Romantic shayari for love expressions</li>
                                <li>Sad shayari for emotional release</li>
                                <li>Friendship and motivational shayari to celebrate bonds and inspire</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex justify-content-between align-items-center bg-success bg-opacity-10">
                        <div>
                            <i class="bi bi-stars fs-2 text-success me-2"></i>
                            <h3 class="h5 mb-0 d-inline">Festive & Special Wishes</h3>
                        </div>
                        <button class="toggle-btn btn btn-sm" onclick="toggleDetails('festive-details')">More Details</button>
                    </div>
                    <div class="category-body">
                        <p>Celebrate every occasion with elegance.</p>
                        <div id="festive-details" class="more-details">
                            <p>Explore messages and images crafted for:</p>
                            <ul>
                                <li>Diwali, Holi, Eid, Christmas, and more</li>
                                <li>Birthdays, anniversaries, and milestones</li>
                                <li>High-quality visuals paired with meaningful text</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex justify-content-between align-items-center bg-secondary bg-opacity-10">
                        <div>
                            <i class="bi bi-person-badge-fill fs-2 text-secondary me-2"></i>
                            <h3 class="h5 mb-0 d-inline">BrandBoost Personalised Wishes</h3>
                        </div>
                        <button class="toggle-btn btn btn-sm" onclick="toggleDetails('personalised-details')">More Details</button>
                    </div>
                    <div class="category-body">
                                                <p>Discover BrandBoost Personal wishes.</p>

                        <div id="personalised-details" class="more-details">
                            <div class="mb-3">
                                <h4 class="h6 text-primary">Birthdays & Anniversaries</h4>
                                <ul>
                                    <li>Funny, emotional, and cute birthday quotes</li>
                                    <li>Romantic anniversary messages for partners and friends</li>
                                    <li>Birthday shayari with poetic elegance</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6 text-danger">Romantic & Love Quotes</h4>
                                <ul>
                                    <li>Touching love messages and soulful shayari</li>
                                    <li>Flirty quotes, proposal ideas, and couple captions</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <h4 class="h6 text-success">Friendship & Family Moments</h4>
                                <ul>
                                    <li>Quotes for best friends and cherished family</li>
                                    <li>Messages for parents, siblings, and gratitude notes</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="h6 text-warning">Festivals & National Days</h4>
                                <ul>
                                    <li>Patriotic greetings for Independence and Republic Days</li>
                                    <li>Colourful, festive messages for Diwali, Eid, Raksha Bandhan, and more</li>
                                    <li>Stylish festival wishes, ready to post</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="category-card card border-0 shadow h-100">
                    <div class="category-header d-flex justify-content-between align-items-center bg-dark bg-opacity-10">
                        <div>
                            <i class="bi bi-translate fs-2 text-dark me-2"></i>
                            <h3 class="h5 mb-0 d-inline">Quotes & Messages in Multiple Languages</h3>
                        </div>
                        <button class="toggle-btn btn btn-sm" onclick="toggleDetails('language-details')">More Details</button>
                    </div>
                    <div class="category-body">
                        <p>India is beautifully diverse, and so is BrandBoost.</p>
                        <div id="language-details" class="more-details">
                            <p>Share your feelings in your language of choice:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="language-badge">Hindi</span> Heart-touching shayari, suvichar, and wishes</li>
                                <li class="mb-2"><span class="language-badge">English</span> Universal messages for every emotion</li>
                                <li class="mb-2"><span class="language-badge">Marathi & Gujarati</span> Spiritual, motivational, and festive content</li>
                                <li class="mb-2"><span class="language-badge">Tamil, Telugu, Kannada, Malayalam</span> Deeply cultural and emotional quotes in your native script</li>
                            </ul>
                            <p class="mt-3">Enjoy a seamless app experience, quick content access, and powerful emotional connection—only with <span class="fw-bold text-primary">BrandBoost</span>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="contact" class="bg-gradient border-top mt-5 animated-footer-bg" style="position:relative;overflow:hidden;">
        <div class="container text-center py-5 position-relative" style="z-index:2;">
            <div class="mb-3">
                <a href="mailto:info@brandboostindia.com" class="text-decoration-none fw-semibold text-primary fs-5 me-3">
                    <i class="bi bi-envelope-fill me-2 text-danger"></i> info@brandboostindia.com
                </a>
            </div>
            <div class="mb-4 d-flex justify-content-center align-items-center gap-3">
                <a href="#" target="_blank" class="btn btn-outline-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-instagram fs-4"></i>
                </a>
                <a href="#" target="_blank" class="btn btn-outline-primary rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-facebook fs-4"></i>
                </a>
                <a href="#" target="_blank" class="btn btn-success rounded-pill shadow-sm px-4 py-2 d-flex align-items-center gap-2" style="font-size:1.1rem;">
                    <i class="bi bi-google-play fs-5"></i> <span>Google Play</span>
                </a>
            </div>
            <p class="mb-1 text-secondary small">
                © <span id="currentYear"></span> <span class="fw-bold text-primary">BrandBoost India</span>. All rights reserved.
            </p>
            <p class="mb-0 text-secondary small">
                Crafted with <i class="bi bi-heart-fill text-danger"></i> by 
                <a href="#" class="fw-bold text-gradient">QaswaTechnologies</a>
            </p>
        </div>
        <style>
            .animated-footer-bg::before {
                content: "";
                position: absolute;
                left: 0; top: 0; width: 100%; height: 100%;
                background: linear-gradient(270deg, #eaf6ff, #f8fbff, #eaf6ff, #f8fbff);
                background-size: 0% 400%;
                animation: footerGradientMove 10s ease-in-out infinite;
                z-index: 1;
                opacity: 1;
            }
            @keyframes footerGradientMove {
                0% {background-position:0% 50%;}
                50% {background-position:100% 50%;}
                100% {background-position:0% 50%;}
            }
        </style>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle More Details
        function toggleDetails(id) {
            const element = document.getElementById(id);
            const button = event.target;
            if (element.style.display === "block") {
                element.style.display = "none";
                button.textContent = "More Details";
                button.classList.remove('btn-secondary');
                button.classList.add('btn-primary');
            } else {
                element.style.display = "block";
                button.textContent = "Hide Details";
                button.classList.remove('btn-primary');
                button.classList.add('btn-secondary');
            }
        }

        // Mobile Mockup Carousel
        const images = @json($imagePaths ?? ['assets/img/m1.jpg', 'assets/img/m2.jpg', 'assets/img/m3.jpg']);
        let currentIndex = 0;
        let imgElement = null;
        document.addEventListener('DOMContentLoaded', function() {
            imgElement = document.getElementById('brandImage');
            if (imgElement && images.length > 0) {
                showImage(currentIndex);
            }
            window.nextImage = function() {
                if (images.length > 0) {
                    currentIndex = (currentIndex + 1) % images.length;
                    showImage(currentIndex);
                }
            };
            window.prevImage = function() {
                if (images.length > 0) {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    showImage(currentIndex);
                }
            };
            function showImage(index) {
                if (imgElement && images[index]) {
                    imgElement.src = images[index];
                }
            }
        });

        // Dark Mode Toggle
        document.addEventListener('DOMContentLoaded', function () {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const navbar = document.querySelector('.navbar');
            const cards = document.querySelectorAll('.card, .category-card');
            const alerts = document.querySelectorAll('.alert');
            const highlights = document.querySelectorAll('.highlight');
            const listItems = document.querySelectorAll('.list-unstyled li');
            const brandTitles = document.querySelectorAll('.brand-title');
            const textGradients = document.querySelectorAll('.text-gradient');
            const badges = document.querySelectorAll('.badge');
            const buttons = document.querySelectorAll('.btn');
            const carouselCaptions = document.querySelectorAll('.carousel-caption');
            const featureIcons = document.querySelectorAll('.feature-icon');

            // Check localStorage for dark mode preference
            if (localStorage.getItem('darkMode') === 'enabled') {
                enableDarkMode();
            }

            // Toggle dark mode
            darkModeToggle.addEventListener('click', function () {
                if (body.classList.contains('dark-mode')) {
                    disableDarkMode();
                } else {
                    enableDarkMode();
                }
            });

            function enableDarkMode() {
                body.classList.add('dark-mode');
                navbar.classList.add('dark-mode');
                cards.forEach(card => card.classList.add('dark-mode'));
                alerts.forEach(alert => alert.classList.add('dark-mode'));
                highlights.forEach(highlight => highlight.classList.add('dark-mode'));
                listItems.forEach(item => item.classList.add('dark-mode'));
                brandTitles.forEach(title => title.classList.add('dark-mode'));
                textGradients.forEach(gradient => gradient.style.color = '#f39c12');
                badges.forEach(badge => badge.classList.add('dark-mode'));
                buttons.forEach(button => button.classList.add('dark-mode'));
                carouselCaptions.forEach(caption => caption.classList.add('dark-mode'));
                featureIcons.forEach(icon => icon.classList.add('dark-mode'));
                localStorage.setItem('darkMode', 'enabled');
                darkModeToggle.innerHTML = '<i class="bi bi-sun-fill"></i> Light Mode';
            }

            function disableDarkMode() {
                body.classList.remove('dark-mode');
                navbar.classList.remove('dark-mode');
                cards.forEach(card => card.classList.remove('dark-mode'));
                alerts.forEach(alert => alert.classList.remove('dark-mode'));
                highlights.forEach(highlight => highlight.classList.remove('dark-mode'));
                listItems.forEach(item => item.classList.remove('dark-mode'));
                brandTitles.forEach(title => title.classList.remove('dark-mode'));
                textGradients.forEach(gradient => gradient.style.color = '');
                badges.forEach(badge => badge.classList.remove('dark-mode'));
                buttons.forEach(button => button.classList.remove('dark-mode'));
                carouselCaptions.forEach(caption => caption.classList.remove('dark-mode'));
                featureIcons.forEach(icon => icon.classList.remove('dark-mode'));
                localStorage.setItem('darkMode', 'disabled');
                darkModeToggle.innerHTML = '<i class="bi bi-moon-fill"></i> Dark Mode';
            }
        });

        // Update Footer Year
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
</body>
</html>