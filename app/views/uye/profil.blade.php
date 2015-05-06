@extends('sablon/sablon')
@section('title')
<title>Üye Profil</title>
@stop
@section('container') 
<section>
    <div class="container">
        <div class="row">
            <div class=" col-sm-3 hidden-xs  ">
                <div class="clearfix"></div>
                <br />
                <br />
                @include('sablon.profil-nav')
            </div>
            <div class=" col-sm-9  ">
                <div class="row">
                    <div class="clearfix"></div>
                    <br />
                    <br />
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4 img-thumbnail center-block">
                        <h4 class="text-success text block">Kişisel bilgiler Düzenleme</h4>
                        <small class="text-warning">Bilgilerini güncelle </small>
                        <a href="{{URL::to('uye/bilgilerim')}}" class=" center-block btn btn-lg btn-primary glyphicon glyphicon-user"> HESABIM</a>

                        <br />
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4 img-thumbnail center-block">
                        <h3 class="text-success text block">Adres Defterim</h3>
                        <h5 class="text-warning">Adres bilgilerini güncelle </h5>
                        <a href="{{URL::to('uye/adres-defterim')}}" class=" center-block btn btn-lg btn-primary glyphicon glyphicon-adjust"> ADRES DEFTERİM</a>

                        <br />
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4 img-thumbnail center-block">
                        <h3 class="text-success text block">Siparişlerim</h3>
                        <h5 class="text-warning">Daha önceden verilmiş siparişler</h5>
                        <a href="{{URL::to('uye/siparisler')}}" class=" center-block btn btn-lg btn-primary glyphicon glyphicon-list-alt"> SİPARİŞLERİM</a>

                        <br />
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4 img-thumbnail center-block">
                        <h3 class="text-success text block">Sepetim</h3>
                        <h5 class="text-warning">Sepetteki ürünleri göster</h5>
                        <a href="{{URL::to('uye/sepetim')}}" class=" center-block btn btn-lg btn-primary glyphicon glyphicon-shopping-cart"> SEPETİM</a>

                        <br />
                    </div>
                    <div class="clearfix"></div> 
                    <br />
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4 img-thumbnail center-block">
                        <h3 class="text-success text block">Güvenli çıkıs</h3>
                        <h5 class="text-warning">Oturum kapat </h5>
                        <a href="{{URL::to('uye/cikis')}}" class=" center-block btn btn-lg btn-primary glyphicon glyphicon-log-out"> ÇIKIŞ YAP</a>

                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop