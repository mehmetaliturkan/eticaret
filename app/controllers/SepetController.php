<?php

class SepetController extends BaseController {

    /**
     * 
     * @return View
     */
    public function postSepetEkle() {
        if (!Sentry::check()) {
            return Redirect::to('uye/giris');
        }


        $urunIdGelen = Input::get('id');

        $urun_kontrol = DB::table('urunler')->where('id', '=', $urunIdGelen)->first();

        if ($urun_kontrol->adet - $urun_kontrol->satilan > 0) {

            Cart::add(array('id' => Input::get('id'), 'name' => Input::get('adi'), 'qty' => Input::get('qty'), 'price' => Input::get('fiyat'), 'options' => array('size' => null)));

            return Redirect::to('/#product-overlay');
        }else {
          
            
            return Redirect::to('/hatali-istek');
            
        }
    }

    /**
     * 
     * @param type $link
     * @return sepet Ürün ekleme 
     */
    public function getSepetUrunEkle($link) {
        if (!Sentry::check()) {
            return Redirect::to('uye/giris');
        }

        $urun_detay = DB::table('urunler')->where('link', $link)->first();
        Cart::add(array('id' => $urun_detay->id, 'name' => $urun_detay->adi, 'qty' => 1, 'price' => $urun_detay->fiyat, 'options' => array('size' => null)));

        return Redirect::to('/#product-overlay');
    }

    /**
     * 
     * @param type $id
     * @return adet eksıltme
     */
    public function getSepetAdetEksil($id) {
        if (!Sentry::check()) {
            return Redirect::to('uye/giris');
        }

        $urun = Cart::get($id);
        $urun_adet = $urun->qty;
        if ($urun_adet > 0) {
            $urun_adet = $urun->qty--;
            Cart::update($id, array('qty' => $urun_adet));
        }


        return Redirect::to('uye/sepetim');
    }

    /**
     * 
     * @param type $id
     * @return adet artırma
     */
    public function getSepetAdetArtir($id) {
        if (!Sentry::check()) {
            return Redirect::to('uye/giris');
        }
        $urun = Cart::get($id);
        $urun_adet = $urun->qty++;


        Cart::update($id, array('qty' => $urun_adet));

        return Redirect::to('uye/sepetim');
    }

    /**
     * 
     * @param type $id
     * @return sepet urun sıl
     */
    public function getSepetUrunSil($id) {
        if (!Sentry::check()) {
            return Redirect::to('uye/giris');
        }
        Cart::remove($id);

        return Redirect::to('uye/sepetim');
    }

}
