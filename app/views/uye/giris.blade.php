
@extends('sablon/sablon')


@section('container')

<!--form-->
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-1">

            @if (!Sentry::check())

            @if(isset($sonuc))
            <span class="text-success"><h4>{{$sonuc}} </h4></span>
            @endif

            <div class="login-form"><!--login form-->
                <h2>Hesap bilgilerinizle giriş yap!</h2>
                <form action="{{URL::to('uye/giris')}}" method="post">
                    <input type="email" placeholder="Email adresiniz" name="email" value="{{ Input::old('email') }}"/>
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                    <input name="password" type="password" placeholder="Şifreniz"  value="{{ Input::old('password') }}"/>
                    {{ $errors->first('password', '<span class="help-block ">:message</span>') }}
                    <span>
                        <input type="checkbox"  name="remember-me"class="checkbox "/> 
                        Beni hatırla!
                    </span>
                    <button type="submit" class="btn btn-default">Giriş</button>
                </form>
            </div><!--/login form-->
             @if(isset($email))
            {{ $email  }}
            @endif
            
            @else
            <div class="login-form"><!--login form-->
                <h2>Hesap bilgilerinizle giriş önceden yapmışsınız!</h2>
                <br /><br /><br /><br /><br /><br /><br />           
            </div>
            @endif
        </div>
    </div>

</div><!--/form-->

<br />
<br />
@stop
