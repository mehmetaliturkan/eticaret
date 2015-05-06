<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <?php $a = 0; ?>
                        @foreach($firsat as $firsat)
                        <div class="item <?php $a++; 
                        echo $a==1?'active':''; ?>">
                            <div class="col-sm-6">
                                <h1><span>E</span>-TICARET'DE</h1>
                                <h3>{{$firsat->adi}} </h3>
                                <h2>Fırsat Ürünü sadece {{$firsat->fiyat}} <span class="fa  fa-turkish-lira"> </span></h2>
                                <a role="button"  href="{{URL::to('/urun/'.$firsat->link)}}" class="btn btn-default get">Ürüne git</a>
                            </div>
                            <div class="col-sm-6">
                                 <?php $urunresim = DB::table('urunresimler')->where('urun_id', $firsat->id)->first(); ?>
                            <img src="{{URL::to($urunresim->adi)}}"  class="girl img-responsive"alt="" />
                            
                            
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->