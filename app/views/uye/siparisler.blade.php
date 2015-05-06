@extends('sablon/sablon')


@section('title')

<title>Üye Profil</title>

@stop

@section('container')
<section>
    <div class="container">
        <div class="row">
            <div class=" col-sm-2 hidden-xs">
                @include('sablon.profil-nav')
            </div>
            <div class="col-sm-10">


                <div class="panel panel-primary">

                    <div class="panel-heading ">
                        <h4>Siparişlerim</h4>
                    </div>
                    <div class="panel-body">


                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Ref no</th>
                                        <th>Ödeme türü</th>
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
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->detay}}</td>
                                        <td>{{$item->adi}} <br /> Kargo takip no:{{$item->kargo_no}}</td>
                                        <td>{{$item->durum}} </td>
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
                    </div>
                </div>

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
                <script type="text/javascript">
                    $('#exampleModal').on('show.bs.modal', function (event) {
                        var button = $(event.relatedTarget); // Button that triggered the modal
                        var id = button.data('id');
                        var adi = button.data('adi');

                        if (adi != 'Sipariş detayi') {
                            var modal = $(this);
                            modal.find('.modal-title').text(adi);
                            $.ajax({
                                url: "teslimat-detay",
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
                                url: "siparis-detay",
                                type: 'POST',
                                data: {'id': id},
                                success: function (data, textStatus, jqXHR) {
                                    modal.find('.modal-body p').html(data);
                                }
                            });
                            modal.find('.modal-title').text(adi);

                        }

                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                    })
                </script>

            </div>
        </div>
</section>



@stop
