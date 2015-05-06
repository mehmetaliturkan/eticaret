
@extends('yonetim.sablon.sablon')
@section('title')
<title>Ürün ekleme </title>
@stop
@section('container')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ürün ekle
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Ürün ekle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='col-lg-10'>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Yeni ürün ekleme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="urun-ekle" method="post"enctype="multipart/form-data">
                    <div class="box-body">

                        <div class="form-group">

                            <label for="">Ürün adi</label>
                            <input type="text" name='adi' class="form-control" id=""value="{{Input::old('adi') ? Input::old('adi'):"";}}" placeholder="Ürün adi"/>
                            <span class="text-warning"> {{$errors->first('adi')}}</span>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Kategori sec</label>
                            <select name="kategori_id" class="form-control">                                
                                @foreach($kategoriler as $kategori)
                                <option value='{{$kategori->id}}' >{{$kategori->adi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Firsat ürünü</label>
                            <select name="firsat" class="form-control">
                                <option value='1'>Firsat ürünü</option>

                                <option value='0' selected >Firsat ürünü değil</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mağaza görünüm resmi</label>
                            <input type="file" name="file" />
                        </div>
                        <div class="form-group">

                            <label for="">Ürün detayı</label>
                            <textarea name='detay' class="form-control" id=""placeholder="Ürün Detayını girin">{{Input::old('detay') ? Input::old('detay'):"";}}</textarea>
                            <span class="text-warning"> {{$errors->first('detay')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Ürün adeti</label>
                            <input type="text"name='adet' class="form-control"value="{{Input::old('adet') ? Input::old('adet'):"";}}" id="" placeholder="Ürün adeti "/>
                            <span class="text-warning"> {{$errors->first('adet')}}</span>
                        </div>
                        <input type="hidden" name="satilan" value="0" />
                        <input type="hidden" name="gosterim" value="0" />
                        <div class="form-group">
                            <label>Ürün Spot durumu</label>
                            <select name="spot" class="form-control">
                                <option value='1'>Spot ürünü</option>

                                <option value='0' selected >Spot değil</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ürün mazada gösterimi için onay durumu</label>
                            <select name="durum" class="form-control">
                                <option value='1' selected >Ürün onaylanır</option>
                                <option value='0'  >Ürün onaylı değil</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ürün fiyatı</label>
                            <input type="text"name='fiyat' class="form-control"value="{{Input::old('fiyat') ? Input::old('fiyat'):"";}}" id="" placeholder="Ürün fiyatı "/>
                            <span class="text-warning"> {{$errors->first('fiyat')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Ürün indirim oranı (Yüzdelik)</label>
                            <select name="indirim" class="form-control">
                                <option value='5'>%5 indirim</option>
                                <option value='10'>%10 indirim</option>
                                <option value='15'>%15 indirim</option>
                                <option value='55'>%55 indirim</option>
                                <option value='75'>%75 indirim</option>

                                <option value='0' selected >İndirim olmasın</option>

                            </select>
                        </div>
                        
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Ürün ekleme yap</button>
                    </div>
                </form>
            </div>
        </div><!-- /.box -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop