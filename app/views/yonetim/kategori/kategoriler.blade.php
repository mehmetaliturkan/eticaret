
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
            Kategoriler
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">Kategoriler</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @if(isset($message)))
        <span class="text-success"><h4> {{$message->all()}}</h4></span>
        @endif

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bütün kategori kayıtları</h3>                                    
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Adi</th>
                            <th>Aciklama</th>
                            <th>Ust</th>
                            <th>Düzenleme</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoriler as $kategori)
                        <tr>
                            <td>{{$kategori->id}}</td>
                            <td>{{$kategori->adi}}</td>
                            <td> {{$kategori->aciklama}}</td>
                            <td>X</td>
                            <td>
                                <form action="kategori-sil" method="post">
                                    <input type="hidden" name="id" value="{{$kategori->id}}" />
                                    <input class="btn btn-danger" type="submit" value="Sil" />
                                </form>
                                <form action="kategori-guncelle" method="post">
                                    <input type="hidden" name="id" value="{{$kategori->id}}" />
                                    <input class="btn btn-warning" type="submit"value="Güncelle" />
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Adi</th>
                            <th>Aciklama</th>
                            <th>Ust</th>
                            <th>Düzenleme</th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->



    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop