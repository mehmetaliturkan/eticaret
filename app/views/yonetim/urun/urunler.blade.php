
@extends('yonetim.sablon.sablon')
@section('title')
<title>Bütün ürünler </title>
@stop
@section('container')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ürünler
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Ürünler</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Mağaza da bulunan bütün ürünler</h3>                                    
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Adı</th>
                            <th>Satılan</th>
                            <th>Stok</th>
                            <th>Mağazada gösterim</th>
                            <th>Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($urunler as $urun)

                        <tr>
                            <td>{{$urun->id}}</td>
                            <td>{{$urun->adi}}</td>
                            <td>{{$urun->satilan}}</td>
                            <td>{{$urun->adet-$urun->satilan}}</td>
                            <td>{{$urun->durum==0 ? "X" : "Onaylı"}}</td>
                            <td>
                                <form action="urun-sil" method="post">
                                    <input type="hidden" name="id" value="{{$urun->id}}" />
                                    <input class="btn btn-danger" type="submit" value="Sil" />
                                </form>
                                <form action="urun-guncelle" method="post">
                                    <input type="hidden" name="id" value="{{$urun->id}}" />
                                    <input class="btn btn-warning" type="submit"value="Güncelle" />
                                </form>
                                <form action="urun-resim-ekle" method="post">
                                    <input type="hidden" name="id" value="{{$urun->id}}" />
                                    <input class="btn btn-success" type="submit"value="Resim Ekle" />
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Adı</th>
                            <th>Satılan</th>
                            <th>Stok</th>
                            <th>Durum</th>
                            <th>Düzenle</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->

@stop
