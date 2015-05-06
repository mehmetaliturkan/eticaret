
@extends('yonetim.sablon.sablon')
@section('title')
<title>Yeni ürün resimlerine yazı ekleme </title>
@stop
@section('container')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ürün resimlerine yazı ekle
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Ürün resimleri yazı ekle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='col-lg-10'>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Yeni ürün resimlerine yazı ekleme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="urun-resim-yazi" method="post"enctype="multipart/form-data">
                    <div class="box-body">                        
                        <div class="form-group">
                            <label>Yazıyı secin</label>
                            <select name="yazi" class="form-control">
                                <option value="MAturkan.com" >MAturkan.com</option>

                                <option value='Eticaret'  >Eticaret</option>

                            </select>
                        </div>
                        
                        
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Ürün resimlere yazı ekleme yap</button>
                    </div>
                </form>
            </div>
        </div><!-- /.box -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop