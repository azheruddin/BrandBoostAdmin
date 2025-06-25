@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Montserrat:wght@700&display=swap" rel="stylesheet">


<!-- <style>
    /* Content Overlay */
    .content {
        background: rgba(255, 255, 255, 0.8); /* Light overlay with slight transparency */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin: 10px auto;
    }
</style> -->

<style>
    /* Gradient Background with Animation */
    body, .content-wrapper {
        background: linear-gradient(45deg, #ff6b6b, #f7d94e, #82c6e2, #b3ffab);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        overflow: hidden;
    }

    /* Floating Bubbles */
    .bubble {
        position: absolute;
        bottom: -100px;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        animation: bubbleFloat 8s infinite ease-in-out;
    }

    .bubble:nth-child(2) {
        width: 60px;
        height: 60px;
        left: 25%;
        animation-duration: 12s;
        animation-delay: 3s;
    }
    .bubble:nth-child(3) {
        width: 30px;
        height: 30px;
        left: 50%;
        animation-duration: 10s;
        animation-delay: 6s;
    }
    .bubble:nth-child(4) {
        width: 80px;
        height: 80px;
        left: 75%;
        animation-duration: 15s;
        animation-delay: 8s;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes bubbleFloat {
        0% { transform: translateY(0); }
        100% { transform: translateY(-110vh); }
    }
</style>

<!-- HTML Structure -->
<div class="content-wrapper">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="content">








<style>
    /* Header Styling */
    .custom-header {
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        color: #fff;
        background: linear-gradient(45deg, #ff6b6b, #f7d94e);
        padding: 30px 20px;
        border-radius: 10px;
        font-size: 4rem;
        font-weight: 700;
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s, background 0.3s;
    }
    .custom-header:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, #f7d94e, #ff6b6b);
    }
    .sub-header {
        font-family: 'Dancing Script', cursive;
        font-size: 1.8rem;
        color: #333;
        margin-top: 10px;
    }

    /* Card Styling */
    .small-box {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .small-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }
    .small-box .inner {
        padding: 20px;
        font-size: 1.2rem;
        animation: fadeIn 1s ease-in-out both;
    }
    .small-box-footer {
        padding: 10px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 0 0 15px 15px;
        text-align: center;
        color: #fff;
        font-weight: bold;
    }
    .small-box-footer:hover {
        background: rgba(0, 0, 0, 0.2);
    }

    /* Fade In Animation */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div class="sub-header">Welcome to your <span class="text-primary text-bold">Dashboard!</span></div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- First Card: Categories -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $catActiveCount }}</h3>
                            <p>Active Category</p>
                        </div>
                        <div>
                            <h3>{{ $catInactiveCount }}</h3>
                            <p>Inactive Category</p>
                        </div>
                        <div>
                            <h3>{{ $totalCatCount }}</h3>
                            <p>Total Category</p>
                        </div>
                    </div>
                    <a href="{{ route('category.show') }}" class="small-box-footer" title="Click for category info">
                        Category info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Second Card: Users -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-warning">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $userActiveCount }}</h3>
                            <p>Active User</p>
                        </div>
                        <div>
                            <h3>{{ $userInactiveCount }}</h3>
                            <p>Inactive User</p>
                        </div>
                        <div>
                            <h3>{{ $totalUserCount }}</h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <a href="{{ route('show-user') }}" class="small-box-footer" title="Click for user info">
                        User info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Third Card: Posts -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-dark">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $imageCount }}</h3>
                            <a href="{{ route('show-post') }}" class="small-box-footer" title="Click to see image post">
                                Image Post <i class="fas fa-arrow-circle-up"></i>
                            </a>
                        </div>
                        <div>
                            <h3>{{ $videoCount }}</h3>
                            <a href="{{ route('show-video') }}" class="small-box-footer" title="Click to see video post">
                                Video Post <i class="fas fa-arrow-circle-up"></i>
                            </a>
                        </div>
                        <div>
                            <h3>{{ $totalPostCount }}</h3>
                            <p>Total Posts</p>
                        </div>
                    </div>
                    <a href="{{ route('add-post') }}" class="small-box-footer" title="Click to add Post">
                        Post info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Fourth Card: Distributors -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-danger">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $distActiveCount }}</h3>
                            <p>Active Distributor</p>
                        </div>
                        <div>
                            <h3>{{ $distInactiveCount }}</h3>
                            <p>Inactive Distributor</p>
                        </div>
                        <div>
                            <h3>{{ $totalDistCount }}</h3>
                            <p>Total Distributors</p>
                        </div>
                    </div>
                    <a href="{{ route('show-dist') }}" class="small-box-footer" title="Click for Distributor info">
                        Distributor info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- <div class="col-lg-6 col-md-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <div>
                            <h3>{{ $activePlans }}</h3>
                            <p>Active Plans</p>
                        </div>
                        <div>
                            <h3>{{ $inActivePlans }}</h3>  
                            <p>Inactive Plans</p>
                        </div>
                        <div>
                            <h3>{{ $totalPlans }}</h3>
                            <p>Total Plans</p>
                        </div>
                    </div>
                    <a href="{{ route('show_plans') }}" class="small-box-footer" title="Click for Plans info">
                        Plans info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</section>
        </div>
</div>
@endsection
