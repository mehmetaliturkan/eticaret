
@extends('sablon.sablon')

@section('container')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="step-one "> 

                <h2 class="heading ">
                    <span class="text text-success"><span class="glyphicon glyphicon-ok"></span>Sepetim &nbsp;</span>
                    <span class="text text-warning"><span class="glyphicon glyphicon-remove"></span>Adresim&nbsp;</span>
                    <span class="text text-warning"><span class="glyphicon glyphicon-remove"></span>Ödeme İşlemi&nbsp;</span>
                    <span class="text text-warning"><span class="glyphicon glyphicon-remove"></span>Onaylanma </span>
                </h2>
            </div>

        </div>
        <div class=" col-sm-3 hidden-xs">
            @include('sablon.profil-nav')
        </div>
        <div class="col-sm-9">
            <h2>Sipariş adres bilgilerini sec</h2>

            <hr />
            <form class="form-horizontal" action="{{URL::to('uye/siparis-odeme')}}" method="post">

                <div class="col-md-6">

                    <select class="form-control "name="siparisAdres" id="" class="form-control">
                        <option value="" >Adresi Seç</option>
                        @foreach($adresler as $adres )

                        <option value="{{$adres->id}}" >{{$adres->adi}}</option>
                        @endforeach
                    </select>

                    <span class="text-warning"> {{$errors->first('siparisAdres')}}</span>
                </div>

                <div class="col-md-6">
                    <a  href="{{URL::to('uye/siparis-adresim-ekle')}}" class="btn-lg btn-primary  ">Yeni adres girmek için tıklayın</a>
                </div>
                <br />
                <br />
                <br />
                <br />
                <div class="col-md-7">
                    <input type="submit" class="btn-lg btn-danger" value="Ödeme yapmak için tıkla"/>
                </div>         
            </form>
        </div>
    </div>
</div>
@stop
@section('title')
<title>Burası sipariş adres guncelleme</title>
@stop


