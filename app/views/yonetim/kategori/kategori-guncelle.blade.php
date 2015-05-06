
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
           {{$kategori_detay->adi}} kategorisini guncelleme
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Kategori güncelleme</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='col-lg-10'>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Yeni kategori güncelleme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="kategori-guncelle-bitir" method="post">
                    <div class="box-body">

                        <div class="form-group">

                            <label for="">Kategori adi</label>
                            <input type="text" name='adi' class="form-control" id=""value="{{$kategori_detay->adi}}" placeholder="Kategori adi"/>
                            <span class="text-warning"> {{$errors->first('adi')}}</span>
                        </div>
                        <div class="form-group">

                            <label for="">Kategori acıklama</label>
                            <input type="text"name='aciklama' class="form-control"value="{{$kategori_detay->aciklama}}" id="" placeholder="Kategori acıklama"/>
                            <span class="text-warning"> {{$errors->first('kategori_aciklama')}}</span>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Üst kategori sec</label>
                            <select name="ust_id" class="form-control">
                                <option value='0'>Üst kategori yok</option>
                                @foreach($kategoriler as $ust_kategori)
                                <option value='{{$ust_kategori->id}}' <?php echo $ust_kategori->id == $kategori_detay->ust_id ? "selected" : "";?> >{{$ust_kategori->adi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori durumu</label>
                            <select name="durum" class="form-control">
                                <option value='1'<?php echo $kategori_detay->durum == 1 ? "selected" : ""; ?>>Durum onaylı</option>

                                <option value='0' <?php echo $kategori_detay->durum == 0 ? "selected" : ""; ?>>Durum onaysız</option>

                            </select>
                        </div>
                        <input type="hidden"value="{{$kategori_detay->id}}"name="id" />
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Kategori guncelleme yap</button>
                    </div>
                </form>
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop