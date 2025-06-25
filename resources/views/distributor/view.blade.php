<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Distributor</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include('../components.navbar')

  <!-- Main Sidebar Container -->
  @include('../components.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">View Distributor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- User details card -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Distributor Details</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="id">ID No:</label>
                  <input value="{{ $dist->id }}" type="text" class="form-control" id="id" readonly>
                </div>

                <div class="form-group">
                  <label for="name">Name:</label>
                  <input value="{{ $dist->name }}" type="text" class="form-control" id="name" readonly>
                </div>

               

                <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input value="{{ $dist->phone }}" type="text" class="form-control" id="phone" readonly>
                </div>

                <div class="form-group">
                  <label for="email">Password:</label>
                  <input value="{{ $dist->password }}" type="email" class="form-control" id="email" readonly>
                </div>

                <div class="form-group">
                  <label for="subscription_id">Subscription :</label>
                  <input value="{{ $dist->subscription_id }}" type="text" class="form-control" id="subscription_id" readonly>
                </div>

                <div class="form-group">
                  <label for="user_type">User Type:</label>
                  <input value="{{ $dist->user_type }}" type="text" class="form-control" id="user_type" readonly>
                </div>
                <div class="form-group">
                  <label for="user_type">Active:</label>
                  <input value="{{ $dist->active }}" type="text" class="form-control" id="user_type" readonly>
                </div>
               

                <a href="{{route('show-dist')}}" class="btn btn-primary">Back </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
