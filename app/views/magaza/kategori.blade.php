@extends('sablon/sablon')


@section('title')

<title>E-Ticaret Mehmetali TURKAN</title>

@stop

@section('container')


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('sablon.kategori')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Kategori de bulunan ürünler</h2>

                    @foreach($urunler as $en_son_urun)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center" id="alisveris">
                                    <?php $urunresim = DB::table('urunresimler')->where('urun_id', $en_son_urun->id)->first(); ?>
                                    <img src="../{{$urunresim->adi}}" alt="" />
                                    <h2>{{$en_son_urun->fiyat}}&nbsp;<span class="fa fa-turkish-lira"></span> </h2> 
                                    <p>{{$en_son_urun->adi}}</p>
                                    <?php if ($en_son_urun->adet - $en_son_urun->satilan != 0) { ?>
                                        <a href="{{URL::to('sepet-urun-ekle/'.$en_son_urun->link)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete ekle</a>
                                    <?php } else { ?>
                                        <div id="{{$en_son_urun->kod}}"></div>
                                        <a href="#{{$en_son_urun->kod}}" class="btn btn-danger add-to-cart"><i class="fa fa-shopping-cart"></i>Stokta kalmadı</a>
                                    <?php } ?>
                                </div>
                                <div class="product-overlay" id="product-overlay">
                                    <div class="overlay-content">
                                        <a href="{{URL::to('urun/'.$en_son_urun->link)}}"><img src="../{{$urunresim->adi}}" alt="" /></a>
                                        <h2>{{$en_son_urun->fiyat}}&nbsp;<span class="fa fa-turkish-lira"></span></h2> 
                                        <p><a href="{{URL::to('urun/'.$en_son_urun->link)}}">{{$en_son_urun->adi}}</a></p>
                                        <?php if ($en_son_urun->adet - $en_son_urun->satilan != 0) { ?>
                                            <a href="{{URL::to('sepet-urun-ekle/'.$en_son_urun->link)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete ekle</a>
                                        <?php } else { ?>
                                            <div id="{{$en_son_urun->kod}}"></div>
                                            <a href="#{{$en_son_urun->kod}}" class="btn btn-danger add-to-cart"><i class="fa fa-shopping-cart"></i>Stokta kalmadı</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--<img src="images/home/new.png" class="new" alt="" />-->
                            </div>

                        </div>
                    </div>
                    @endforeach
                    
                    @if($urunler->count()<1)
                    <span class="title"> Ürün ekleme yapılmamış! Yakında eklenecektir..</span>
                    @endif
                    <div class="clearfix"></div>
                    <ul class="pagination">
                        <?php echo $urunler->links(); ?>
                    </ul>
                </div><!--features_items-->


            </div>
        </div>
    </div>
</section>


@stop