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
                    <h2 class="title text-center">En Son eklenen ürünler</h2>

                   
                    <div class="clearfix"></div>
                   
                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>


@stop
