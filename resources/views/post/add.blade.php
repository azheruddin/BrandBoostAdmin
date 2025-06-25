

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Post</title>


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



  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
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




 


<!-- Form to Insert Category -->

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
              <!-- <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active"></li> -->
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

           
          @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif


            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Insert Post </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<!------------------------------------------------->
<form action="{{ route('insert-post') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
    <label for="type">Type:</label>
    <select class="form-control" id="type" name="type" required onchange="toggleFileInput()">
        <option value="">Select</option>
        <option value="Image">Image</option>
        <option value="Video">Video</option>
      
       
    </select>
</div>

<div class="form-group" id="imageInput" style="display: none;">
    <label for="image">Image:</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
    <img id="imagePreview" src="" alt="Image Preview" style="display: none; margin-top: 10px; width: 20%; height: 200px;">
</div>

<div class="form-group" id="videoInput" style="display: none;">
    <label for="video">Video:</label>
    <input type="file" class="form-control" id="video" name="video" accept="video/*">
</div>
<div class="form-group">
    <label for="category">Select Category:</label>
    <select class="form-control" id="category" name="category_id"> 
        <option value="">Select a Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
        <label for="text_size">Text Size:</label>
        <select class="form-control" id="text_size" name="text_size">
            <option value="">Select Text Size</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
  
    <div class="form-group">
    <label for="text_color">Text Color</label>
    <select name="text_color" id="text_color" class="form-control">
        <option value="#FFFFFF" {{ old('text_color', $category->text_color) == '#FFFFFF' ? 'selected' : '' }}>White</option>
        <option value="#0000FF" {{ old('text_color', $category->text_color) == '#0000FF' ? 'selected' : '' }}>Blue</option>
        <option value="#FF0000" {{ old('text_color', $category->text_color) == '#FF0000' ? 'selected' : '' }}>Red</option>
        <option value="#00FF00" {{ old('text_color', $category->text_color) == '#00FF00' ? 'selected' : '' }}>Green</option>
        <option value="#FFFF00" {{ old('text_color', $category->text_color) == '#FFFF00' ? 'selected' : '' }}>Yellow</option>
    </select>
</div>

<div class="form-group">
    <label for="bg_color">Background Color</label>
    <select name="bg_color" id="bg_color" class="form-control">
        <option value="0x00000000" {{ old('bg_color', $category->bg_color) == '0x00000000' ? 'selected' : '' }}>Transparent</option>
        <option value="0xFF000080" {{ old('bg_color', $category->bg_color) == '0xFF000080' ? 'selected' : '' }}>Red (Semi-transparent)</option>
        <option value="0xFFFFFF80" {{ old('bg_color', $category->bg_color) == '0xFFFFFF80' ? 'selected' : '' }}>White (Semi-transparent)</option>
        <option value="0x0000FF80" {{ old('bg_color', $category->bg_color) == '0x0000FF80' ? 'selected' : '' }}>Blue (Semi-transparent)</option>
    </select>
</div>
    
    <div class="form-group">
      <label for="font_style">Font Style:</label>
      <select name="font_style" class="form-control" required>
  <option value="">Select Font</option>
  <option value="Arial" style="font-family: Arial;">Arial</option>
  <option value="Verdana" style="font-family: Verdana;">Verdana</option>
  <option value="Times New Roman" style="font-family: 'Times New Roman';">Times New Roman</option>
  <option value="Georgia" style="font-family: Georgia;">Georgia</option>
  <option value="Courier New" style="font-family: 'Courier New';">Courier New</option>
</select>

    </div>


    <!-- Google Fonts for custom font styles -->
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Lobster|Playfair+Display|Great+Vibes|Dancing+Script&display=swap" rel="stylesheet">


    <div class="form-group">
    <label for="logo_position">Logo Position:</label>
    <select class="form-control" id="logo_position" name="logo_position" onchange="updateOptions()">
        <option value="">Select Position</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
       
    </select>
</div>

<div class="form-group">
    <label for="business_name_position">Business Name Position:</label>
    <select class="form-control" id="business_name_position" name="business_name_position" onchange="updateOptions()">
        <option value="">Select Position</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
    </select>
</div>

<div class="form-group">
    <label for="tagline_position">Tagline Position:</label>
    <select class="form-control" id="tagline_position" name="tagline_position" onchange="updateOptions()">
        <option value="">Select Position</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
    </select>
</div>

<div class="form-group">
    <label for="phone_position">Phone Position:</label>
    <select class="form-control" id="phone_position" name="phone_position" onchange="updateOptions()">
        <option value="">Select Position</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
    </select>
</div>

<div class="form-group">
    <label for="social_media_position">Social Media Position:</label>
    <select class="form-control" id="social_media_position" name="social_media_position" onchange="updateOptions()">
        <option value="">Select Position</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
    </select>
</div>
<div class="form-group">
    <label for="website_position">Website Position:</label>
    <select class="form-control" id="website_position" name="website_position" onchange="updateOptions()">
        <option value="">Select Position</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
    </select>
</div>




    <button type="submit" class="btn btn-primary">Insert Post</button>
</form>


<!--------------------------------------------------->


<!--------------------------------------------------->


        
</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Form to Insert Category End -->




<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>





  <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!---------------------------video----------------------------->
<script>
    function toggleFileInput() {
        var type = document.getElementById('type').value;
        var imageInput = document.getElementById('imageInput');
        var videoInput = document.getElementById('videoInput');

        if (type === 'Video') {
            imageInput.style.display = 'none';
            videoInput.style.display = 'block';
            document.getElementById('image').required = false; // Make image not required
            document.getElementById('video').required = true; // Make video required
        } else {
            imageInput.style.display = 'block';
            videoInput.style.display = 'none';
            document.getElementById('image').required = true; // Make image required
            document.getElementById('video').required = false; // Make video not required
        }
    }
</script>
<!-------------------------------------------------------->
<!-------------------for img preview------------------------------------->
<script>
    function toggleFileInput() {
        const typeSelect = document.getElementById('type');
        const imageInput = document.getElementById('imageInput');
        const videoInput = document.getElementById('videoInput');
        
        if (typeSelect.value === 'Image') {
            imageInput.style.display = 'block';
            videoInput.style.display = 'none'; 
            document.getElementById('imagePreview').style.display = 'none'; 
            document.getElementById('image').value = ''; 
        } else if (typeSelect.value === 'Video') {
            videoInput.style.display = 'block';
            imageInput.style.display = 'none'; // Hide image input
            document.getElementById('imagePreview').style.display = 'none'; 
            document.getElementById('video').value = ''; // Reset video input
        } else {
            imageInput.style.display = 'none'; // Hide image input
            videoInput.style.display = 'none'; // Hide video input
            document.getElementById('imagePreview').style.display = 'none'; // Hide image preview
            document.getElementById('image').value = ''; // Reset file input
            document.getElementById('video').value = ''; // Reset video input
        }
    }

    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the preview
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<!-------------------------------------------------------->
<!-------------------------to handle the dropdown selections----------->
<script>
function updateOptions() {
    const selectElements = document.querySelectorAll('select');
    const selectedValues = Array.from(selectElements).map(select => select.value);

    selectElements.forEach(select => {
        const currentSelectValue = select.value;
        
        // Show all options initially
        Array.from(select.options).forEach(option => {
            option.style.display = 'block'; // Show all options
            if (selectedValues.includes(option.value) && option.value !== currentSelectValue) {
                option.style.display = 'none'; // Hide selected options from other dropdowns
            }
        });
    });
}
</script>


<!-------------------------------------------------------->

</body>
</html>
