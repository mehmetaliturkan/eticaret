<?php

class MagazaController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */
 
    public function getIndex() {
        $en_son_urunler = Urunler::take(12)->orderBy('created_at', 'DESC')->paginate(12);
        $firsat = Urunler::where('firsat', '=', 1)->take(3)->orderBy('id', 'DESC')->get();
        $kategoriler = Kategoriler::all();
        return View::make('magaza/index')
                        ->with('en_son_urunler', $en_son_urunler)
                        ->with('firsat', $firsat)
                        ->with('kategoriler', $kategoriler);
    }
    public function getArama() {
        $ara=Input::get('ara');
        $en_son_urunler = Urunler::where('adi', 'like', '%'.$ara.'%')->take(12)->orderBy('created_at', 'DESC')->paginate(12);
        $firsat = Urunler::where('firsat', '=', 1)->take(3)->orderBy('id', 'DESC')->get();
        $kategoriler = Kategoriler::all();
        return View::make('magaza/arama')
                        ->with('en_son_urunler', $en_son_urunler)  
                        ->with('kategoriler', $kategoriler);
    }

    /**
     * Urun detay gosterme
     */
    public function getUrunDetay($urunLink="") {



        $urun_detay = DB::table('urunler')->where('link', '=', $urunLink)->first();


        $items = Yorumlar::all();



        $kategoriler = Kategoriler::all();
        return View::make('magaza.urun-detay')->with('urun_detay', $urun_detay)->with('kategoriler', $kategoriler)->with('items', $items);
    }

    /**
     * 
     * @param type $link gore urun sergileme
     */
    public function getKategori($kategoriLink) {
        $urun_detay = DB::table('kategoriler')->where('adi', '=', $kategoriLink)->first();
        $Urunler = Urunler::where('kategori_id', '=', $urun_detay->id)->paginate(9);
        $kategoriler = Kategoriler::all();
        return View::make('magaza.kategori')->with('urunler', $Urunler)->with('kategoriler', $kategoriler);
    }

    /**
     * Hatalı ısteklerın gosterılecegı bolum
     * @return view
     */
    public function getHataliIstek() {


        return View::make('magaza.404');
    }

}
