
@extends('sablon.sablon')

@section('container')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="step-one "> 

                <h2 class="heading ">
                    <span class="text text-success"><span class="glyphicon glyphicon-ok"></span>Sepetim &nbsp;</span>
                    <span class="text text-success"><span class="glyphicon glyphicon-ok"></span>Adresim&nbsp;</span>
                    <span class="text text-warning"> <span class="glyphicon glyphicon-remove"></span>Ödeme İşlemi&nbsp;</span>
                    <span class="text text-warning">  <span class="glyphicon glyphicon-remove"></span>Onaylanma </span>
                </h2>
            </div>
            <div class=" col-sm-2 hidden-xs">
                @include('sablon.profil-nav')
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <?php
                    if (Cart::total() > 200) {
                        $fiyat = Cart::total() + Cart::total() * 0.18;
                    } else {
                        $fiyat = Cart::total() + Cart::total() * 0.18 + 9.99;
                        //$fiyat = Cart::total() ;
                    }
                    ?>


                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="payPalForm">
                        <input type="hidden" name="item_number" value="{{Sentry::getUser()->id}}">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="quantity" value="1" />
                        <input type="hidden" name="business" value="mehmetaliturkan-facilitator@gmail.com" />
                        <input type="hidden" name="currency_code" value="TRY" />
                        <input type="hidden" name="item_name" id="item_name" size="45" value="Bilgisayar urun satimi" />
                        <input type="hidden"name="amount"value="{{round($fiyat,2)}}" />

                        <input type="submit" name="Submit" value="Paypal ile ödemek için tıkla" class="btn btn-block btn-lg btn-danger" />

                    </form>
                    <br />
                    <div class="col-lg-7">
                        <div class="panel panel-primary">

                            <div class="panel-heading ">
                                Sipariş ürün bilgilerim
                            </div>
                            <div class="panel-body">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Adı</th>
                                                <th>Fiyat</th>
                                                <th>Adet</th>
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

                                                        {{$urun->qty}}

                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td colspan="3">
                                                    <table class="table table-condensed total-result">
                                                        <tr>
                                                            <td>Sepet ara toplam</td>
                                                            <td>{{Cart::total()}} <span class='fa fa-turkish-lira'></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kdv Tutarı(%18) <span class='fa fa-turkish-lira'></span></td>
                                                            <td>{{Cart::total()*0.18}} <span class='fa fa-turkish-lira'></span></td>
                                                        </tr>
                                                        <tr class="shipping-cost">
                                                            <td>Kargo</td>
                                                            @if(Cart::total()>200)
                                                            <td>Ücretsiz</td>	
                                                            @else
                                                            <td>9.99 <span class='fa fa-turkish-lira'></span></td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td><span>
                                                                    @if(Cart::total()>200)
                                                                    {{Cart::total()+Cart::total()*0.18}} <span class='fa fa-turkish-lira'></span>
                                                                    @else
                                                                    {{Cart::total()+Cart::total()*0.18+9.99}} <span class='fa fa-turkish-lira'></span>
                                                                    @endif
                                                                </span></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>


                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">

                     {{Session::get('AdresBilgilerim')}}

                    </div>

                </div>
            </div>


        </div>
    </div><!--col-md-12-->
</div><!--row-->
</div><!--container-->
@stop


@section('title')
<title>Burası sipariş odeme sayfası</title>
@stop


