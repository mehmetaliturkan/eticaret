<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +9 0542 847 07 89</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@maturkan.com</a></li>
                        </ul>
                    </div>
                </div> 
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="logo pull-left">
                        <a href="{{ URL::to('/') }}"><img src="{{asset('images/home/logo.png')}}" alt="E-Ticaret" /></a>
                    </div>
                </div><div class="col-sm-5">
                    <div class="search_box pull-right ">
                        <form action="{{URL::to('arama')}}" method="get">
                            <div class="form-group">
                                <input type="text" name="ara" placeholder="Ürün arama">
                               
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            @if(Sentry::check())
                            <li><a href="{{ URL::to('uye/hesabim')}}"><i class="fa fa-user"></i> Hesabınız</a></li>
                            @endif

                            <li><a href="{{ URL::to('uye/sepetim')}}"><i class="fa fa-shopping-cart"></i> Sepet {{Cart::count()}} ürün var.</a></li>

                            @if(!Sentry::check())

                            <li><a href="{{ URL::to('uye/giris') }}"><i class="fa fa-inbox"></i> Giriş</a></li>
                            <li><a href="{{ URL::to('uye/uyeol') }}"><i class="fa fa-user"></i> Kayıt ol</a></li>

                            @endif
                            @if(Sentry::check())
                            <li><a href="{{ URL::to('uye/cikis') }}"><i class="fa fa-unlock"></i> Çıkış yap</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
</header><!--/header-->
