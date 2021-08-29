<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/fav.png')}}" type="image/png">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @yield('css')
</head>

@php
    $user = Auth::user();
@endphp
<style>
    .online{
        text-align: right;
    }
    @media(max-width:750px){
        .online{
            text-align: center;
        }
    }
</style>
<body>
    <!-- Page Wrapper -->
    <div class="page-wrapper">

    <!-- header-section start  -->
    <header class="header {{Request::is('/') ? '' : 'menu-fixed'}}">
        <div class="header__top">
            <div class="container">
                <marquee>{{$headline->text}}</marquee>
            </div>
        </div>
        <div class="header__bottom">
        <div class="container">
        <nav class="navbar navbar-expand-xl p-0 align-items-center">
            <a class="site-logo site-title" href="/"><img src="{{asset('img/logo-min.png')}}" alt="site-logo"><span class="logo-icon"><i class="flaticon-fire"></i></span></a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu ml-auto">
                @guest
                    <li><a href="{{route('login')}}">প্রবেশ করুন</a></li>
                    <li><a href="{{route('register')}}">নিবন্ধন করুন</a></li>
                    @else
                    <li><a href="/">হোম</a></li>
                    <li><a href="{{route('profile')}}">প্রোফাইল</a></li>
                    <li><a href="{{route('job')}}">প্রতিদিনের কাজ</a></li>
                    <li><a href="{{route('balance')}}">ব্যালেন্স {{$user->balance > 0 ? '('.$user->balance.'৳)' : ''}}</a></li>
                    <li><a href="{{route('notification')}}"><i class="fa fa-bell"></i><span class="badge bg-danger">{{$user->unreadNotifications->count() > 0 ? $user->unreadNotifications->count() : ''}}</span></a></li>
                @endguest
            </ul>
            </div>
        </nav>
        </div>
    </div>
    </header>
    <!-- header-section end  -->

    @if (Request::is('/'))
        @yield('content')
    @else
    <section class="pt-120 pb-120">
        <div class="container">
            @yield('content')
        </div>
    </section>
    @endif


    <!-- footer section start -->
    <footer class="footer-section">
        <div class="footer-bottom">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <p>কপিরাইট © 2021 {{env('APP_NAME')}}। সমস্ত অধিকার সংরক্ষিত.</p>
                </div>
                @guest
                @else
                <div class="col-md-4">
                    <p class="online"><span class="badge badge-primary">Online User: {{$online}}</span></p>
                </div>
                @endguest
            </div>
        </div>
        </div>
    </footer>
    <!-- footer section end -->
    </div>
    <!-- End Page Wrapper -->

  <!-- jQuery library -->
  <script src="{{asset('js/jquery3.5.1.min.js')}}"></script>
  <!-- bootstrap js -->
  <script src="{{asset('js/bootstrap.js')}}"></script>
  @yield('js')
</body>
</html>