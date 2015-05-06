
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
            {{$urun_detay->adi}} ürününü guncelleme
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Ürün güncelleme</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='col-lg-10'>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"> Ürün güncelleme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="urun-guncelle-bitir" method="post">
                    <div class="box-body">

                        <div class="form-group">

                            <label for="">Ürün adi</label>
                            <input type="text" name='adi' class="form-control" id=""value="{{$urun_detay->adi}}" placeholder="Ürün adi"/>
                            <span class="text-warning"> {{$errors->first('adi')}}</span>
                        </div>

                        <!-- select -->
                        <div class="form-group">
                            <label>Kategori sec</label>
                            <select name="kategori_id" class="form-control">
                                @foreach($kategoriler as $ust_kategori)
                                <option value='{{$ust_kategori->id}}' <?php echo $ust_kategori->id == $urun_detay->kategori_id ? "selected" : ""; ?> >{{$ust_kategori->adi}}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="form-group">
                            <label>Firsat ürünü</label>
                            <select name="firsat" class="form-control">
                                <option value='1' <?php echo $urun_detay->firsat == 1 ? "selected" : ""; ?> >Firsat ürünü</option>

                                <option value='0' <?php echo $urun_detay->firsat == 0 ? "selected" : ""; ?> >Firsat ürünü değil</option>

                            </select>
                        </div>
                        <div class="form-group">

                            <label for="">Ürün detayı</label>
                            <textarea name='detay' class="form-control"rows="6" id=""placeholder="Ürün Detayını girin">{{Input::old('detay') ? Input::old('detay'):"";}}<?php echo $urun_detay->detay; ?></textarea>
                            <span class="text-warning"> {{$errors->first('detay')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">Ürün adeti</label>
                            <input type="text"name='adet' class="form-control"value="{{$urun_detay->adet}}{{Input::old('adet') ? Input::old('adet'):"";}}" id="" placeholder="Ürün adeti "/>
                            <span class="text-warning"> {{$errors->first('adet')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Ürün Spot durumu</label>
                            <select name="spot" class="form-control">
                                <option value='1'<?php echo $urun_detay->spot == 1 ? "selected" : ""; ?>>Spot ürünü</option>

                                <option value='0'<?php echo $urun_detay->spot == 0 ? "selected" : ""; ?> >Spot değil</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ürün mazada gösterimi için onay durumu</label>
                            <select name="durum" class="form-control">
                                <option value='1' <?php echo $urun_detay->durum == 1 ? "selected" : ""; ?> >Ürün onaylanır</option>
                                <option value='0' <?php echo $urun_detay->durum == 0 ? "selected" : ""; ?> >Ürün onaylı değil</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ürün fiyatı</label>
                            <input type="text"name='fiyat' class="form-control"value="{{$urun_detay->fiyat}}{{Input::old('fiyat') ? Input::old('fiyat'):"";}}" id="" placeholder="Ürün fiyatı "/>
                            <span class="text-warning"> {{$errors->first('fiyat')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Ürün indirim oranı (Yüzdelik)</label>
                            <select name="indirim" class="form-control">
                                <option value='5' <?php echo $urun_detay->indirim == 5 ? "selected" : ""; ?>>%5 indirim</option>
                                <option value='10'<?php echo $urun_detay->indirim == 10 ? "selected" : ""; ?>>%10 indirim</option>
                                <option value='15'<?php echo $urun_detay->indirim == 15 ? "selected" : ""; ?>>%15 indirim</option>
                                <option value='55'<?php echo $urun_detay->indirim == 55 ? "selected" : ""; ?>>%55 indirim</option>
                                <option value='75'<?php echo $urun_detay->indirim == 75 ? "selected" : ""; ?>>%75 indirim</option>
                                <option value='0' <?php echo $urun_detay->indirim == 0 ? "selected" : ""; ?> >İndirim olmasın</option>

                            </select>
                        </div>

                        <input type="hidden"value="{{$urun_detay->id}}"name="id" />
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Ürün guncelleme yap</button>
                    </div>
                </form>
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop