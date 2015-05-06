
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
            Kategori ekle
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Kategori ekle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='col-lg-10'>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Yeni kategori ekleme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="kategori-ekle" method="post">
                    <div class="box-body">

                        <div class="form-group">

                            <label for="">Kategori adi</label>
                            <input type="text" name='adi' class="form-control" id=""value="{{Input::old('adi') ? Input::old('adi'):"";}}" placeholder="Kategori adi"/>
                            <span class="text-warning"> {{$errors->first('adi')}}</span>
                        </div>
                        <div class="form-group">

                            <label for="">Kategori acıklama</label>
                            <input type="text"name='kategori_aciklama' class="form-control"value="{{Input::old('kategori_aciklama') ? Input::old('kategori_aciklama'):"";}}" id="" placeholder="Kategori acıklama"/>
                            <span class="text-warning"> {{$errors->first('kategori_aciklama')}}</span>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Üst kategori sec</label>
                            <select name="ust_kategori" class="form-control">
                                <option value='0'>Üst kategori yok</option>
                                @foreach($ust_kategoriler as $ust_kategori)
                                <option value='{{$ust_kategori->id}}' >{{$ust_kategori->adi}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori durumu</label>
                            <select name="durum" class="form-control">
                                <option value='1'>Durum onaylı</option>
                                
                                <option value='0' >Durum onaysız</option>
                                
                            </select>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Kategori ekleme yap</button>
                    </div>
                </form>
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop