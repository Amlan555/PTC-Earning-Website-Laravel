<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Youtube Earn - Admin Panel</title>
    <link rel="shortcut icon" href="{{asset('img/fav.png')}}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
		
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}">
    
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap4.min.css')}}">

    <!-- Toastr Css -->
    <link rel="stylesheet" href="{{asset('backend/css/toastr.css')}}">

    <!-- Sweetaret Css -->
    <link rel="stylesheet" href="{{asset('backend/css/sweetalert2.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    @yield('css')
</head>
<style>
    .active{
        color: #fff !important;
    }
    /* @media(min-width: 991px){
        .mini-sidebar .header-left .logo img{
            max-height: 18px !important;
        }
    } */
</style>
<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
    
        <!-- Header & Sidebar -->
        @include('layouts.backend.header & sidebar')
        <!-- End Header & Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="content container-fluid">
                @yield('content')
            </div>
            <!-- End Page Content -->
        </div>
        <!-- End Page Wrapper -->

    </div>
    <!-- End Main Wrapper -->


    <!-- jQuery -->
    <script src="{{asset('backend/js/jquery-3.5.1.min.js')}}"></script>
		
    <!-- Bootstrap Core JS -->
    <script src="{{asset('backend/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    
    <!-- Slimscroll JS -->
    <script src="{{asset('backend/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('backend/js/app.js')}}"></script>
    
    <!-- Sweetalert Js -->
    <script src="{{asset('backend/js/sweetalert2.min.js')}}"></script>
    
    <!-- Toastr Js -->
    <script src="{{asset('backend/js/toastr.min.js')}}"></script>
    {!! Toastr::message() !!}
    @yield('js')
    <!-- logout custom js -->
    <script>
        function logout(){
            document.getElementById('logout-form').submit();
        }
    </script>
</body>
</html>