@extends('sablon/sablon')


@section('title')

<title>Üye Profil</title>

@stop

@section('container')
<section>
    <style type="text/css">
        .not-active {
            pointer-events: none;
            cursor: default;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="step-one "> 

                    <h2 class="heading ">
                        <span class="text text-warning"><span class="glyphicon glyphicon-remove "></span>Sepetim &nbsp;</span>
                        <span class="text text-warning"><span class="glyphicon glyphicon-remove"></span>Adresim&nbsp;</span>
                        <span class="text text-warning"> <span class="glyphicon glyphicon-remove"></span>Ödeme İşlemi&nbsp;</span>
                        <span class="text text-warning">  <span class="glyphicon glyphicon-remove"></span>Onaylanma </span>
                    </h2>
                </div>

            </div>
            <div class=" col-sm-3 hidden-xs">
                @include('sablon.profil-nav')
            </div>
            <div class="col-sm-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sepetimde da bulunan ürünler</h3>   
                        <small>Sepette {{Cart::count()}} ürün var.</small>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Adı</th>
                                    <th>Fiyat</th>
                                    <th>Adet</th>
                                    <th>Düzenle</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($items as $urun)

                                <tr>
                                    <td>{{$urun->id}}</td>
                                    <td>{{$urun->name}}</td>
                                    <td>{{$urun->price}} <span class="fa fa-turkish-lira"></span></td>
                                    <td>
                                        <div class="cart_quantity_button">

                                            <a class="fa fa-plus-circle" href="{{URL::to('sepet-adet-artir/'.$urun->rowid)}}"></a>
                                            <input class="cart_quantity_input" type="text" name="quantity" value="{{$urun->qty}}" autocomplete="off" size="1"/>
                                            <a class="fa fa-minus-circle" href="{{URL::to('sepet-adet-eksil/'.$urun->rowid)}}"></a>
                                        </div>
                                    </td>

                                    <td>
                                        <a class="fa fa-trash-o btn btn-lg" href="{{URL::to('sepet-urun-sil/'.$urun->rowid)}}">Sepetten cıkar</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>Sepet ara toplam</td>
                                                <td>{{Cart::total()}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kdv Tutarı(%18)</td>
                                                <td>{{Cart::total()*0.18}}</td>
                                            </tr>
                                            <tr class="shipping-cost">
                                                <td>Kargo</td>
                                                @if(Cart::total()>200)
                                                <td>Ücretsiz</td>	
                                                @else
                                                <td>10</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><span>
                                                        @if(Cart::total()>200)
                                                        {{Cart::total()+Cart::total()*0.18}}
                                                        @else
                                                        {{Cart::total()+Cart::total()*0.18+10}}
                                                        @endif
                                                    </span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>


                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <div class="col-md-6">
                    <a class="btn btn-block btn-warning  pull-left"  href="{{URL::to('/')}}">Alişveriş devam</a>

                </div>
                <div class="col-md-6">
                    <a class="btn btn-block btn-danger pull-right 
                       <?php
                       if (Cart::total() == 0) {
                           echo ' not-active';
                       }
                       ?> " href="{{URL::to('/uye/siparis-adres')}}">Sipariş ver</a>

                </div>
                &nbsp;
                &nbsp;
                &nbsp;

            </div>
        </div>
    </div>
</section>


@stop
