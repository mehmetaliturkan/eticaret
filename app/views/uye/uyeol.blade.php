
@extends('sablon/sablon')


@section('container')

<!--form-->
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">

            @if(isset($sonuc))
            <span class="text-success"><h4>{{$sonuc}} </h4></span>
            @endif
            <div class="signup-form"><!--sign up form-->
                <h2>Yeni kullanıcı kaydi yap!</h2>
                <form action="{{ URL::to('uye/uyeol') }}" method="post">
                    <span class="text-warning"> {{$errors->first('first_name')}}</span>
                    <input type="text" name="first_name" value="{{Input::old('first_name') ? Input::old('first_name'):"";}}"placeholder="Adınız"/>
                    <input type="text" name="last_name" placeholder="Soyadınız" value="{{Input::old('last_name') ? Input::old('last_name'):"";}}"/>

                    <span class="text-warning">{{$errors->first('email')}} </span>
                    <input type="email" name="email" placeholder="Email adresiniz"value="{{Input::old('email') ? Input::old('email'):"";}}"/>
                    <span class="text-warning"> {{$errors->first('password')}}</span>
                    <input type="password" name="password" placeholder="Şifreniz" value="{{Input::old('password') ? Input::old('password'):"";}}"/>
                    <button type="submit" class="btn btn-default">Kayıt yap</button>
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
</div><!--/form-->

<br />
<br />
@stop
