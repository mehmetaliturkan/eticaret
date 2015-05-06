
@extends('sablon.sablon')

@section('container')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="step-one "> 

                <h2 class="heading ">
                    <span class="text text-success"><span class="glyphicon glyphicon-ok"></span>Sepetim &nbsp;</span>
                    <span class="text text-success"><span class="glyphicon glyphicon-ok"></span>Adresim&nbsp;</span>
                    <span class="text text-success"> <span class="glyphicon glyphicon-ok"></span>Ödeme İşlemi&nbsp;</span>
                    <span class="text text-success">  <span class="glyphicon glyphicon-ok"></span>Onaylanma </span>
                </h2>
            </div>
            <div class=" col-sm-2 hidden-xs">
                @include('sablon.profil-nav')
            </div>
            <div class="col-sm-10">
                <div class="row">

                    <div class="col-lg-7">
                        <h2>Sipariş başarı bir sekilde verildi</h2>
                        <a href="{{URL::to('uye/siparisler')}}">Siparişlere gitmek için tıkla!</a>

                    </div>

                </div>
            </div>


        </div>
    </div><!--col-md-12-->
</div><!--row-->
</div><!--container-->
@stop


@section('title')
<title>Burası sipariş odeme sayfası</title>
@stop


