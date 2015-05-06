
<div class="left-sidebar">
    <h2>Kategoriler</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

        @foreach($kategoriler as $kategori)

        @if($kategori->ust_id==0)
        <?php $kate_alt_katler_count = DB::table('kategoriler')->where('ust_id', '=', $kategori->id)->count(); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                @if($kate_alt_katler_count>0)
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#{{$kategori->adi}}">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        {{$kategori->adi}}
                    </a>
                </h4>
                @else
                <h4 class="panel-title"><a href="{{URL::to('/kategori/'.$kategori->adi)}}">{{$kategori->adi}}</a></h4>
                @endif
            </div>
            @if($kate_alt_katler_count>0)
            <div id="{{$kategori->adi}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php $kate_alt_katler = DB::table('kategoriler')->where('ust_id', '=', $kategori->id)->get(); ?>
                    <ul>
                        <li><a href="{{URL::to('/kategori/'.$kategori->adi)}}">{{$kategori->adi}} </a></li>
                        @foreach($kate_alt_katler as $kate_alt_kat)
                        <li><a href="{{URL::to('/kategori/'.$kate_alt_kat->adi)}}">{{$kate_alt_kat->adi}} </a></li>
                        @endforeach
                    </ul>

                </div>
            </div>
            @endif
        </div>
        @endif
        @endforeach

    </div><!--/category-products-->

    

    <div class="shipping text-center hidden-xs"><!--shipping-->
        <img src="../images/home/shipping.jpg" alt="" />
    </div><!--/shipping-->

</div>
