@extends('sablon/sablon')




@section('container')

<br />
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('sablon.kategori')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <?php $urunresim = DB::table('urunresimler')->where('urun_id', $urun_detay->id)->first(); ?>
                            <img src="{{URL::to($urunresim->adi)}}" alt="" />

                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="{{URL::to($urunresim->adi)}}"> <img src="{{URL::to($urunresim->adi)}}" alt="" /></a>
                                </div>
                                <?php $urunresimler = DB::table('urunresimler')->where('urun_id', $urun_detay->id)->get(); ?>
                                @foreach($urunresimler as $urunresi)
                                <div class="item">
                                    <a href="{{URL::to($urunresi->adi)}}"> <img src="{{URL::to($urunresi->adi)}}" alt="" /></a>
                                </div>
                                @endforeach

                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <form action="{{URL::to('sepet-ekle')}}" method="post">
                                <img src="{{URL::to('images/product-details/new.jpg')}}" class="newarrival" alt="" />
                                <h2>{{$urun_detay->adi}}</h2>
                                <p>Ürün ID: {{$urun_detay->kod}}</p>
                                <img src="{{URL::to('images/product-details/rating.png')}}" alt="" />
                                <span>
                                    <span>{{$urun_detay->fiyat}} TL </span>
                                    <label>Adet:</label>

                                    <input type="text" name="qty" value="1" />
                                    <input type="hidden" name="fiyat" value="{{$urun_detay->fiyat}}" />
                                    <input type="hidden" name="id" value="{{$urun_detay->id}}" />
                                    <input type="hidden" name="adi" value="{{$urun_detay->adi}}" />
                                    <button type="submit" accesskey="  "
                                    <?php
                                    if ($urun_detay->adet - $urun_detay->satilan == 0)
                                        echo 'disabled';
                                    ?>

                                            class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Sepete Ekle
                                    </button>

                                </span>
                            </form>
                            <p>
                                <b>Stokta:</b>

                                @if($urun_detay->adet-$urun_detay->satilan>0)
                                Var
                                @else
                                Yok
                                @endif

                            </p>
                            <p><b>Marka:</b> E-TİCARET</p>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Ürün detayı</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Yapılmış yorumlar</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            {{$urun_detay->detay}}
                        </div>
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">

                                @foreach($items as $item)
                                @if($item->urunler_id==$urun_detay->id && $item->durum==1)
                                <div class="alert alert-warning" role="alert">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>{{$item->adiniz}}</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>{{$item->created_at}}</a></li>
                                    </ul>

                                    <p>{{$item->yorum}}</p>

                                </div> 
                                @endif
                                @endforeach
                                <hr />

                                <p><b>Ürün hakkında düşüncelerinizi yazınız!</b></p>

                                {{ '<span class=" text text-success">'.Session::get('sonuc').'</span>' }}

                                {{ $errors->first('email', '<span class=" text text-primary">:message</span>') }}
                                <br />{{ $errors->first('adiniz', '<span class=" text text-primary">:message</span>') }}
                                <br />{{ $errors->first('yorum', '<span class=" text text-primary">:message</span>') }}
                                <form action="{{URL::to('urun/yorum-yap')}}" method="post">
                                    <span>
                                        <input type="hidden"name="link" value="{{$urun_detay->link}}" />
                                        <input type="hidden"name="urunler_id" value="{{$urun_detay->id}}" />
                                        <input type="text" name="adiniz"  value="{{ Input::old('adiniz') }}" placeholder="Adınızı girin!"/>
                                        <input type="text" name="email" value="{{ Input::old('email') }}" placeholder="Email Adresiniz!"/>
                                    </span>
                                    <textarea name="yorum" ></textarea>

                                    <button type="submit" class="btn btn-default pull-right">
                                        Yorumu kaydet
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->
            </div>
        </div>
    </div>
</section>


@stop
@section('title')

<title>{{$urun_detay->adi}}</title>

@stop
