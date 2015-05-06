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
                                       <th>ID</th>
                                       <th>Yapılan istek</th>
                                       <th>HTTP CLIENT IP</th>
                                       <th>REQUEST_TIME</th>
                                       <th>HTTP ACCEPT LANGUAGE</th>
                                       <th>HTTP USER AGENT</th>
                                       <th>REQUEST_METHOD</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($items as $item)

                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->REQUEST_URI}}</td>
                                        <td>{{$item->HTTP_CLIENT_IP}}</td>
                                        <td>{{time()-$item->REQUEST_TIME }} sn. önce</td>
                                        <td>{{$item->HTTP_ACCEPT_LANGUAGE}}</td>
                                        <td>{{$item->HTTP_USER_AGENT}}</td>
                                        <td>{{$item->REQUEST_METHOD}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                </div>

            </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
@stop
