<!DOCTYPE html>
<html>
<head>
    <title>Backend Exam - Create Product</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/products.js', 'resources/css/dashboard.css', 'resources/js/dashboard.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- include libraries(jQuery, bootstrap) -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head> 

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

      @include('templates.navbar')

      @include('templates.sidebar')        

      <div class="content-wrapper">

          <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-12 text-center">
                          <h1 class="m-0">{{ $page }}</h1>
                      </div>
                      <div class="col-sm-11">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                              <li class="breadcrumb-item active">{{ $page }}</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>


          <div class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-6 my-0  mx-auto">
                          <div class="card">                               
                            <div class="card-header">
                              <h5 class="m-0 "></h5>
                            </div>
                              <div class="card-body px-5 py-5">
                                <div id="app">
                                  <div class="create-product-forms">
                                    <product-form></product-form>             
                                  </div>
                                </div>
                              </div>
                          </div>

                      </div>

                  </div>

              </div>
          </div>

      </div>


      <aside class="control-sidebar control-sidebar-dark">

          <div class="p-3">
              <h5>Title</h5>
              <p>Sidebar content</p>
          </div>
      </aside>


      <footer class="main-footer">

          

      </footer>
  </div>

 


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

<script>
  $(document).ready(function() {
  $('#summernote').summernote({
    height: 200
  });
});
</script>

</html>
