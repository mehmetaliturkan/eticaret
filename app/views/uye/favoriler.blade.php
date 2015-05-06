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
            <div class="col-sm-9">
            </div>
        </div>
    </div>
</section>


@stop
