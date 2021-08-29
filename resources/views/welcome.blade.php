@extends('layouts.app')

@section('title')
{{env('APP_NAME')}}
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<!-- hero-section start -->
<section class="hero">
    <div class="hero__slider">
        <div class="single__slide bg_img">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="hero__content text-center">
                            <h2 class="hero__title">ঘরে বসে টাকা উপার্জন করার সেরা মাধ্যম অনলাইনে টাকা ইনকাম করুন </h2>
                            <p data-animation="fadeInUp">প্রতিদিন কাজ কমপ্লিট করে,  অথবা  আপনার বন্ধুদের রেফার করে  ঘরে বসেই উপার্জন করুন. কাজ শেষে  টাকা তোলা ও সহজ. বিকাশ অথবা নগদে নিতে পারবেন আপনার উপার্জিত টাকা.</p>
                            <div class="refer-box my-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p>আপনার রেফার লিঙ্ক</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input id="refer-link" class="form-control refer-input" value="{{env('APP_URL').'refer/'.Auth::user()->slug}}" readonly>
                                            <div class="input-group-prepend" id="copy-refer-link">
                                                <div class="input-group-text"><i class="fa fa-copy"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a href="{{route('profile')}}" class="cmn-btn">প্রোফাইল</a>
                                <a href="{{route('job')}}" class="cmn-btn">প্রতিদিনের কাজ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- single__slide end -->
    </div><!-- hero__slider end -->
</section>
<!-- hero-section end -->

<!-- feature section start -->
<section class="pt-120 pb-120 section--bg has--img">
    <div class="section--img bg_img"></div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
        <div class="section-header text-center">
            <h2 class="section-title">আমাদের রেফার  সিস্টেম</h2>
            <p>আপনার বন্ধুদের   রেফার করুন এবং প্রতি রেফারে  পাবেন কমিশন, যত বেশি রেফার করবেন আপনার লেভেল তত বাড়বে এবং কমিশনও বাড়বে.</p>
        </div>
        </div>
    </div><!-- row end -->
    <div class="row mb-none-30">
        <div class="col-lg-3 col-md-6 mb-30 text-md-left text-center" data-wow-duration="0.3s" data-wow-delay="0.3s">
            <div class="feature-card">
                <div class="feature-card__icon"><i class="fa fa-check"></i></div>
                <div class="feature-card__content">
                <h4 class="title">নো লেভেল</h4>
                <p>প্রথম অবস্থায় কোন লেভেল থাকবে না, লেভেল না থাকা অবস্থায় প্রতি রেফারে আপনি {{$level[0]->commision}} টাকা কমিশন পাবেন</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-30 text-md-left text-center" data-wow-duration="0.3s" data-wow-delay="0.3s">
            <div class="feature-card">
                <div class="feature-card__icon"><i class="fas fa-level-up-alt"></i></div>
                <div class="feature-card__content">
                <h4 class="title">লেভেল-১</h4>
                <p>লেভেল-১ এ যেতে হলে কমপক্ষে ১০ জনকে রেফার করতে হবে, এই লেভেলে প্রতি রেফারে আপনি {{$level[1]->commision}} টাকা কমিশন পাবেন</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-30 text-md-left text-center" data-wow-duration="0.3s" data-wow-delay="0.3s">
            <div class="feature-card">
                <div class="feature-card__icon"><i class="fa fa-certificate"></i></div>
                <div class="feature-card__content">
                <h4 class="title">লেভেল-২</h4>
                <p>লেভেল-২ এ যেতে হলে কমপক্ষে ২০ জনকে রেফার করতে হবে, এই লেভেলে প্রতি রেফারে আপনি {{$level[2]->commision}} টাকা কমিশন পাবেন</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-30 text-md-left text-center" data-wow-duration="0.3s" data-wow-delay="0.3s">
            <div class="feature-card">
                <div class="feature-card__icon"><i class="fas fa-award"></i></div>
                <div class="feature-card__content">
                <h4 class="title">লেভেল-৩</h4>
                <p>৩০ জনকে রেফার করলে সর্বোচ্চ লেভেল এ যেতে পারবেন, এই লেভেলে প্রতি রেফারে আপনি {{$level[3]->commision}} টাকা কমিশন পাবেন</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- feature section end -->  

@endsection

@section('js')
<script src="{{asset('js/homepage.js')}}"></script>
@endsection