@extends('sablon/sablon')


@section('title')

<title>Üye Profil</title>

@stop

@section('container')
<section>
    <div class="container">
        <div class="row">
            <div class=" col-sm-3 hidden-xs">
                @include('sablon.profil-nav')
            </div>
            <div class="col-sm-9 ">
                <h3 class="box-title">Adres defterimden kayıt guncelle</h3> 
                <form role="form" action="{{URL::to('uye/adres-defterim-guncelle-bitir')}}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Adres adi</label>
                            <input type="text" name='adi' class="form-control" id=""value="{{$adres_detay->adi}}{{Input::old('adi') ? Input::old('adi'):"";}}" placeholder="Adres adi"/>
                            <span class="text-warning"> {{$errors->first('adi')}}</span>
                        </div>
                        <div class="form-group">

                            <label for="">Ad Soyad</label>
                            <input type="text" name='adsoyad' class="form-control" id=""value="{{$adres_detay->adsoyad}}{{Input::old('adsoyad') ? Input::old('adsoyad'):"";}}" placeholder="Adı soyadı "/>
                            <span class="text-warning"> {{$errors->first('adsoyad')}}</span>
                        </div>
                        <input type="hidden" name="id" value="{{Input::get('id')}}" />
                        <div class="form-group">
                            <label for="">Adres detayı</label>
                            <textarea name='adres' class="form-control" id=""placeholder="Ürün adres girin">{{$adres_detay->adres}}{{Input::old('adres') ? Input::old('adres'):"";}}</textarea>
                            <span class="text-warning"> {{$errors->first('adres')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Ülke</label>
                            <select name="ulke" class="form-control">
                                <option value='Türkiye' selected >Türkiye</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Şehir</label>
                            <select name="sehir" class="form-control">
                                <option value='Adana' selected >Adana</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">İlçe</label>
                            <input type="text"name='ilce' class="form-control"value="{{$adres_detay->ilce}}{{Input::old('ilce') ? Input::old('ilce'):"";}}" id="" placeholder="ilce  "/>
                            <span class="text-warning"> {{$errors->first('ilce')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Telefon</label>
                            <input type="text"name='telefon' class="form-control"value="{{$adres_detay->telefon}}{{Input::old('telefon') ? Input::old('telefon'):"";}}" id="" placeholder="Telefon"/>
                            <span class="text-warning"> {{$errors->first('telefon')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Cep telefon</label>
                            <input type="text"name='cepno' class="form-control"value="{{$adres_detay->cepno}}{{Input::old('cepno') ? Input::old('cepno'):"";}}" id="" placeholder="Cep no"/>
                            <span class="text-warning"> {{$errors->first('cepno')}}</span>
                        </div>

                        <div class="form-group">
                            <label>Adres tipi</label>
                            <select name="tipi" class="form-control">
                                <option value='1'  <?php echo $adres_detay->tipi == 1 ? "selected" : ""; ?>  >Teslimat</option>
                                <option value='0'  <?php echo $adres_detay->tipi == 0 ? "selected" : ""; ?>  >Fatura</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tc no</label>
                            <input type="text"name='tcno' class="form-control"value="{{$adres_detay->tcno}}{{Input::old('tcno') ? Input::old('tcno'):"";}}" id="" placeholder="TC no"/>
                            <span class="text-warning"> {{$errors->first('tcno')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Vergi no</label>
                            <input type="text"name='vergino' class="form-control"value="{{$adres_detay->vergino}}{{Input::old('vergino') ? Input::old('vergino'):"";}}" id="" placeholder="Vergi no"/>
                            <span class="text-warning"> {{$errors->first('vergino')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Vergi dairesi</label>
                            <input type="text"name='vergidaire' class="form-control"value="{{$adres_detay->vergidairesi}}{{Input::old('vergidaire') ? Input::old('vergidaire'):"";}}" id="" placeholder="Vergi daire"/>
                            <span class="text-warning"> {{$errors->first('vergidairesi')}}</span>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Adres ekleme yap</button>
                        <br />
                        <br />
                        <br />
                    </div>
                </form>

            </div>
        </div>
</section>


@stop
