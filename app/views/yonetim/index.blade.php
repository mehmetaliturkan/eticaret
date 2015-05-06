@extends('yonetim.sablon.sablon')
@section('title')
<title>E-Ticaret Yönetim Paneli</title>
@stop

@section('container')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="right-side">
        <section class="content-header">
            <h1>
                Yönetim 
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                {{DB::table('urunler')->count()}}
                            </h3>
                            <p>
                                Bütün Ürünler
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="urunler" class="small-box-footer">
                            Ürünlere git <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                 {{DB::table('kategoriler')->count()}}<sup style="font-size: 20px">%</sup>
                            </h3>
                            <p>
                                Kategoriler
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="kategoriler" class="small-box-footer">
                            Kategorilere git <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>
                                {{DB::table('users')->count()}}
                            </h3>
                            <p>
                                Müsterilere mail gonderme
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="mail-gonder" class="small-box-footer">
                            E-Mail git <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                                 {{DB::table('ziyaretciler')->count()}}
                            </h3>
                            <p>
                               Ziyaretci sayısı
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="ziyaretciler" class="small-box-footer">
                            Ziyaretcilere git <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- top row -->
            <div class="row">
                <hr />
                <div class="col-xs-12 connectedSortable">


                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Verilen Siparişler</h3>                                    
                        </div><!-- /.box-header -->


                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Siparis sahibi</th>
                                        <th>Kargo bilgileri</th>
                                        <th>Durumu</th>
                                        <th>Sipariş tarihi</th>
                                        <th>Sipariş detayı</th>
                                        <th>Teslimat adresi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($items as $item)

                                    <tr>
                                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                                        <td>{{$item->adi}} <br /> Kargo takip no:{{$item->kargo_no}}</td>
                                        <td>
                                            {{$item->durum}} 
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-adi="Sipariş durumu" data-id="{{$item->id}}">Güncelle</button>
                                        </td>
                                        <td>{{$item->created_at}} </td>
                                        <td> 
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-adi="Sipariş detayi" data-id="{{$item->id}}">Sipariş detayi</button>
                                        </td>
                                        <td>     
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"data-adi="Teslimat adresi" data-id="{{$item->adres_id}}">Teslimat adresi</button>

                                        </td>


                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div>
                <br class="header">
                <hr />
                <div class="col-xs-7 connectedSortable">

                    <!-- TO DO List -->
                    <div class="box box-success">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Onay bekleyen yorumlar</h3>

                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <ul class="todo-list">

                                @if($yorumlar->count()==0)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                    </span>                                             
                                    <!-- todo text -->
                                    <span class="text">Yeni yorum yapılmamış</span>
                                    <!-- General tools such as edit or delete-->                                  
                                </li>
                                @endif
                                @foreach ($yorumlar as $yorum)

                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </span>                                             
                                    <!-- todo text -->
                                    <span class="text text-primary">{{$yorum->yorum}}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <a href="yorumlar/onay/{{$yorum->id}}"><i class="fa fa-edit">onay</i></a>
                                        <a href="yorumlar/sil/{{$yorum->id}}"><i class="fa fa-trash-o">Sil</i></a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div><!-- /.col -->
                <div class="col-xs-5 connectedSortable">

                    <!-- TO DO List -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">Online kullanıcılar</h3>


                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <ul class="todo-list">

                                @if(count($onlines)==0)
                                <li>
                                    <!-- drag handle -->                             
                                    <!-- todo text -->
                                    <span class="text">Online kişi yok</span>                                
                                </li>
                                @endif
                                @foreach ($onlines as $online)
                                <?php
                                $onlinem = DB::table('online')
                                        ->select(DB::raw('time,ip'))
                                        ->where('users_id', '=', $online->users_id)
                                        ->orderBy('id', 'desc')
                                        ->first();
                                $sn = time() - $onlinem->time;
                                ?>
                                @if(time() - $onlinem->time<1200)
                                <li>                                           
                                    <!-- todo text -->
                                    <?php $users_online = User::where('id', '=', $online->users_id)->first() ?>
                                    <span class="text">{{ $users_online->email }}</span>
                                    <span class="text" id="saniye">
                                        <?php
                                        $snn = round($sn % 60);
                                        $dk = round($sn / 60);
                                        $sa = round($sn / 3600);

                                        echo $sa . ' saat ' . $dk . ' dk ' . $snn . ' sn önce aktifti ';
                                        ?>
                                    </span>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div><!-- /.col -->
            </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">

                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Baslık</h4>
            </div>


            <div class="modal-body"> 

            </div>
            <div class="modal-footer">
                <button type="button" id="kaydet" class="btn btn-danger" >Kaydet</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

    $('#kaydet').click(function () {

        var k_g = $('#k_g').val();
        var k_n = $('#k_n').val();
        var s_n = $('#s_n').val();

        if ($.isEmptyObject(k_n) == false) {

            if ($.isNumeric(k_n)) {

                $.ajax({
                    type: 'POST',
                    url: "http://eticaret.maturkan.com/uye/siparis-durum-guncelle",
                    data: {'siparis_durum': k_g, 'siparis_id': s_n, 'kargo_no': k_n},
                    success: function (data, textStatus, jqXHR) {
                        $('#sonuc').html(data);
                    }
                });

            } else {
                alert('Kargo numarası sayisal deger olması gerek!');
            }
        }
        else {
            $.ajax({
                type: 'POST',
                url: "http://eticaret.maturkan.com/uye/siparis-durum-guncelle",
                data: {'siparis_durum': k_g, 'siparis_id': s_n},
                success: function (data, textStatus, jqXHR) {
                    $('#sonuc').html(data);
                }
            });
        }

    });
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var adi = button.data('adi');
        if (adi != 'Sipariş detayi') {
            var modal = $(this);
            modal.find('.modal-title').text(adi);
            $.ajax({
                url: "http://eticaret.maturkan.com/uye/teslimat-detay",
                type: 'POST',
                data: {'id': id},
                success: function (data, textStatus, jqXHR) {
                    modal.find('.modal-body p').html(data);
                }
            });
            modal.find('.modal-title').text(adi);
        } else if (adi == 'Sipariş detayi') {
            var modal = $(this);
            $.ajax({
                url: "http://eticaret.maturkan.com/uye/siparis-detay",
                type: 'POST',
                data: {'id': id},
                success: function (data, textStatus, jqXHR) {
                    modal.find('.modal-body p').html(data);
                }
            });
            modal.find('.modal-title').text(adi);
        }
    });
    $('#exampleModal1').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var adi = button.data('adi');
        var modal = $(this);
        $.ajax({
            url: "http://eticaret.maturkan.com/uye/siparis-guncelle",
            type: 'POST',
            data: {'id': id},
            success: function (data, textStatus, jqXHR) {
                modal.find('.modal-body').html(data);
            }
        });
        modal.find('.modal-title').text(adi);
    });
</script>
@stop
