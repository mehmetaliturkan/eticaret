<?php

class PaypalController extends BaseController {

    public function getPaypal() {
        
    }

    public function postPaypal() {
        
    }

    public function getSiparisOnaylandi() {


        if ((Input::has('tx'))) {

            if (Sentry::getUser()->id == Input::get('item_number')) {





                if (Session::has('AdresBilgilerim')) {

                    if (Cart::total() > 200) {
                        $fiyat = Cart::total() + Cart::total() * 0.18;
                    } else {
                        $fiyat = Cart::total() + Cart::total() * 0.18 + 9.99;
                        //$fiyat = Cart::total() ;
                    }
                    if (round($fiyat,2) == Input::get('amt')) {
                        $teslimatAdresim = new TeslimatAdresim();

                        $teslimatAdresim->veri = Session::get('AdresBilgilerim');
                        if ($teslimatAdresim->save()) {
                            $insertedId = $teslimatAdresim->id;
                            //  echo $insertedId;
                            //simdide satılanlar tablosuna verı gırısı yapmada


                            $satilanlar = new Siparisler();

                            $satilanlar->users_id = Sentry::getUser()->id;
                            $satilanlar->ip = Request::server('HTTP_CLIENT_IP');
                            $satilanlar->satilanlardurum_id = 0;
                            $satilanlar->teslimatadresim_id = $insertedId;
                            $satilanlar->odemeturleri_id = 1;
                            $satilanlar->kargolar_id = 1;
                            $satilanlar->onay = 0;

                            if ($satilanlar->save()) {
                                $insertedSatilanId = $satilanlar->id;

                                $paypal = new Paypal();
                                $paypal->ip = Request::server('HTTP_CLIENT_IP');
                                $paypal->users_id = Sentry::getUser()->id;
                                $paypal->satilanlar_id = $insertedSatilanId;
                                $paypal->tx_kod = Input::get('tx');
                                $paypal->amt_tl = Input::get('amt');
                                $paypal->cc_birimi = Input::get('cc');
                                $paypal->st_durum = Input::get('st');
                                $paypal->save();

                                foreach (Cart::content() as $cart) {

                                    $UrunBul = Urunler::find($cart->id);
                                    $adet = $UrunBul->satilan + $cart->qty;

                                    $UrunBul->satilan = $adet;

                                    $UrunBul->save();

                                    $satilanDetay = new SiparisDetay();
                                    $satilanDetay->satilanlar_id = $insertedSatilanId;
                                    $satilanDetay->adet = $cart->qty;
                                    $satilanDetay->fiyat = $cart->price;
                                    $satilanDetay->urun_id = $cart->id;

                                    $satilanDetay->save();
                                }

                                Session::forget('AdresBilgilerim');
                                Cart::destroy();

                                return View::make('uye.siparis-odeme-tamamlama');
                            }
                        }
                    } else {
                        echo 'Kullanıcı bilgilerinde uyuşmama oldu! <br /> <a href="http://eticaret.maturkan.com">Anasayfaya git</a>';
                    }
                } else {
                    echo 'Bu islem daha once gercekleştirilmiş! <br /> <a href="http://eticaret.maturkan.com">Anasayfaya git</a>';
                }
            } else {
                echo 'Hatalı istek durumu!';
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function getIndex() {
        $en_son_urunler = Urunler::take(12)->orderBy('created_at', 'DESC')->paginate(12);
        $firsat = Urunler::where('firsat', '=', 1)->take(3)->orderBy('id', 'DESC')->get();
        $kategoriler = Kategoriler::all();
        return View::make('magaza/index')
                        ->with('en_son_urunler', $en_son_urunler)
                        ->with('firsat', $firsat)
                        ->with('kategoriler', $kategoriler);
    }

    /**
     * Urun detay gosterme
     */
    public function getUrunDetay($urunLink = "") {
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
