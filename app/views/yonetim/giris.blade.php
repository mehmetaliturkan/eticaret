@extends('yonetim.sablon.sablon')
@section('title')
<title>Yönetim paneline giriş</title>
@stop


@section('container')

<div class="form-box" id="login-box">

    @if(isset($sonuc))
    <span class="text-success"><h4>{{$sonuc}} </h4></span>
    @endif
    <div class="header">Yönetici girişi</div>
    <div class="body bg-gray">
       
        <form action="{{URL::to('yonetim/giris')}}" method="post">
            <div class="form-group">
                <input type="text" class="form-control"placeholder="Yonetim kullanıcı adınız" name="user_id" value="{{ Input::old('user_id') }}"/>

                {{ $errors->first('user_id', '<span class="help-block">:message</span>') }}
            </div>

            <div class="form-group">
                <input name="password"class="form-control" type="password" placeholder="Şifreniz"  value="{{ Input::old('password') }}"/>
                {{ $errors->first('password', '<span class="help-block ">:message</span>') }}
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember_me"/> Beni hatırla
            </div>

            <div class="footer">                                                               
                <button type="submit" class="btn bg-olive btn-block">Giriş yap</button>  
            </div>       
        </form>

        <div class="margin text-center">
            <span>Giriş yapın yada bizi sosyal ağlardan takip edin!</span>
            <br/>
            <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
            <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
            <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

        </div>
    </div>
</div>
@stop
