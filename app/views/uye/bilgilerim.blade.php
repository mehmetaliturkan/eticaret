@extends('sablon/sablon')


@section('title')

<title>Üye Profil Bilgileri</title>

@stop

@section('container')
<section>
    <div class="container">
        <div class="row">
            <div class=" col-sm-3 hidden-xs ">
                @include('sablon.profil-nav')
            </div>
            <div class="col-sm-9">

                <div class="signup-form"><!--sign up form-->
                    <h2>Kişisel bilgilerini güncelle!</h2>
                    <form action="{{ URL::to('uye/bilgilerim') }}" method="post">

                        <span class="text-warning">E - Mail Adresin</span>
                        <input  class="form-control" id="disabledInput" type="email" name="" id=""value="{{Sentry::getUser()->email}}" disabled />

                        <span class="text-warning">Eski adınız</span>
                        <span class="text-warning"> {{$errors->first('first_name')}}</span>
                        <input type="text" name="first_name" value="{{Sentry::getUser()->first_name}}{{Input::old('first_name') ? Input::old('first_name'):"";}}"placeholder="Adınız"/>
                        <span class="text-warning">Eski soyadınız</span>
                        <input type="text" name="last_name" placeholder="Soyadınız" value="{{Sentry::getUser()->last_name}}{{Input::old('last_name') ? Input::old('last_name'):"";}}"/>


                        <span class="text-danger">Şifre değişmemesi için boş bırak</span>
                        <span class="text-warning">{{$errors->first('password1')}} </span>
                        <input type="password" name="password1" placeholder="Yeni şifreniz"value="{{Input::old('password1') ? Input::old('password1'):"";}}"/>
                        <span class="text-warning"> {{$errors->first('password2')}}</span>
                        <input type="password" name="password2" placeholder="Şifrenizi tekrar girin" value="{{Input::old('password2') ? Input::old('password2'):"";}}"/>
                        <button type="submit" class="btn btn-default">Güncelleme yap</button>
                    </form>
                    @if(isset($sonuc))
                    <span class="text-success"><h4>{{$sonuc}} </h4></span>
                    @endif

                </div><!--/sign up form-->
            </div>
            <div class="clearfix"></div>
            <br />
            <br />
            <br />

        </div>
    </div>
</section>


@stop
