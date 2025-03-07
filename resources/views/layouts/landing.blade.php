<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('Logo-Semesta-Buku.webp') }}">
    <!-- Bootstrap CSS -->
    <x-landing.style></x-landing.style>

    <title>{{ $title }}</title>
</head>

<body data-scroll-animation="true">
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="round_spinner">
                <div class="spinner"></div>
                <div class="text">
                    <img src="{{ asset('Logo-Semesta-Buku.webp') }}" alt="Image" width="200px">
                    {{-- <h4><span></span></h4> --}}
                </div>
            </div>
            <h2 class="head">Did You Know?</h2>
            <p></p>
        </div>
    </div>

    <div class="body_wrapper">
        <div class="toast-container position-fixed p-3">
            <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Cart Update</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Item added to the cart!
                </div>
            </div>
        </div>

        <x-landing.header></x-landing.header>
        {{ $slot }}

        <!-- footer area css  -->
        <footer class="bj_footer_area_two" data-bg-color="#f5f5f5">
            <div class="round_shap one"></div>
            <div class="round_shap two"></div>
            <div class="round_shap three"></div>
            <div class="round_shap four"></div>
            <div class="container">
            <div class="footer_top">
                <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="f_widget f_widget_dark link_widget wow fadeInUp" data-wow-delay="0.2s">
                    <a href="#" class="f_logo">
                        <x-application-logo width="200px"></x-application-logo>
                    </a>
                    <h2 class="f_widget_title">
                        Contacs Us
                    </h2>
                    <ul class="list-unstyled list">
                        <li><a href="tel:610383766284">+62</a></li>
                        <li><a href="mailto:noreply@bookjar.com">PT. Semesta Infomedia Indonesia</a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="f_widget f_widget_dark link_widget wow fadeInUp" data-wow-delay="0.3s">
                    <h2 class="f_widget_title dark">Company</h2>
                    <ul class="list-unstyled list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('produk') }}">Buku</a></li>
                        <li><a href="{{ route('subscribe.index') }}">Subscribe</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="/">Kontak</a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="f_widget f_widget_dark link_widget wow fadeInUp" data-wow-delay="0.4s">
                    <h2 class="f_widget_title dark">Kategori</h2>
                    <ul class="list-unstyled list">
                        @foreach (App\Models\SubCategory::get() as $item)
                        <li><a href="{{ route('produk') }}?s={{ $item->sub_name }}">{{ $item->sub_name }}</a></li>
                        @endforeach
                    </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="f_widget f_widget_dark link_widget wow fadeInUp" data-wow-delay="0.5s">
                    <h2 class="f_widget_title dark">Pages</h2>
                    <ul class="list-unstyled list">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="footer_bottom_dark d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="0.5s">
                <p>© 2024 by <a href="https://turbo-main.com" target="_blank">Turbo Main.</a> All Rights Reserved</p>
                <ul class="list-unstyled payment_process">
                <li><a href="#"><img src="{{ asset('landing/img/home-two/discover.jpg') }}" alt=""></a></li>
                <li><a href="#"><img src="{{ asset('landing/img/home-two/visa.jpg') }}" alt=""></a></li>
                <li><a href="#"><img src="{{ asset('landing/img/home-two/maestro.jpg') }}" alt=""></a></li>
                </ul>
            </div>
            </div>
        </footer>
    </div>
    <!-- Back to top button -->
    <a id="back-to-top" title="Back to Top"></a>
    <x-landing.script></x-landing.script>

</body>

</html>
