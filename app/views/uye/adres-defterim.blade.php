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
                <section class="content">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Bütün adres defterimde olan kayıtlar</h3>                                    

                            <a class="btn btn-success btn-block" href="{{URL::to('uye/adres-defterim-ekle')}}">Adres defterine ekleme yap</a>
                        </div><!-- /.box-header -->


                        <div class="box-body table-responsive">


                            <br />
                            <table id="example1" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Adı</th>
                                        <th>Ad Soyad</th>
                                        <th>Adres</th>
                                        <th>Sil</th>
                                        <th>Guncelle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($adresler as $adres)

                                    <tr>
                                        <td>{{$adres->id}}</td>
                                        <td>{{$adres->adi}}</td>
                                        <th>{{$adres->adsoyad}}</th>
                                        <th>{{$adres->adres}}</th>
                                        <td>
                                            <form  action="adres-defterim-sil" method="post">
                                                <input type="hidden" name="id" value="{{$adres->id}}" />
                                                <input class="btn btn-danger" type="submit" value="Sil" />
                                            </form>
                                        </td>
                                        <td>
                                            <form action="adres-defterim-guncelle" method="post">
                                                <input type="hidden" name="id" value="{{$adres->id}}" />
                                                <input class="btn btn-warning" type="submit"value="Güncelle" />
                                            </form>
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Adı</th>
                                        <th>Ad Soyad</th>
                                        <th>Adres</th>
                                        <th>Sil</th>
                                        <th>Guncelle</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                        <br />
                        <br />
                        <br />
                    </div><!-- /.box -->
                </section>
            </div>
        </div>
</section>


@stop
