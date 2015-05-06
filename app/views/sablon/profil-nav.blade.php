
    <header>
        <h4>Hoş geldin <small>{{Sentry::getUser()->first_name}} {{Sentry::getUser()->last_name }}</small></h4> 
    </header>
    <div class="shop-menu ">
        <ul class="nav nav-pills bg bg-yellow ">

            <li role="presentation" ><a href="{{ URL::to('/#alisveris') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;Alış verişe dön</a></li> <div class="clear clearfix"></div><br />
            <li role="presentation" ><a href="{{ URL::to('uye/bilgilerim') }}"><span class="glyphicon glyphicon-edit"></span>&nbsp;Üye Bilgilerim</a></li> <div class="clear clearfix"></div><br />
            <li role="presentation"><a href="{{ URL::to('uye/sepetim') }}"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Alışveriş Sepetim</a></li><div class="clear clearfix"></div><br />
            <li role="presentation"><a href="{{ URL::to('uye/siparisler') }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Siparişlerim</a></li><div class="clear clearfix"></div><br />
            <li role="presentation"><a href="{{ URL::to('uye/adres-defterim') }}"><span class="glyphicon glyphicon-book"></span>&nbsp;Adres Defteri</a></li><div class="clear clearfix"></div><br />

            <li role="presentation"><a href="{{ URL::to('uye/cikis') }}"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Güvenli Çıkış</a></li>

        </ul>
    </div>
