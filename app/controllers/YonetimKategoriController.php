<?php

/**
 * Yonetın urun kontroller
 */
class YonetimKategoriController extends BaseController {

    /**
     * getIndex Method
     */
    public function getKategoriEkle() {
        if (!Session::has('yonetim_oturum')) {
            return Redirect::to('yonetim/giris');
        }
        if (Sentry::check()) {
            return Redirect::to('uye/hesabim');
        }
        /**
         * Kategoride bulunan tum verılerı al ve gonder
         */
        $ust_kategoriler = Kategoriler::all();

        return View::make('yonetim/kategori/kategori-ekle')->with('ust_kategoriler', $ust_kategoriler);
    }

    public function postKategoriEkle() {
        /**
         * Kategoride bulunan tum verılerı al ve gonder
         */
        $rules = array(
            'kategori_aciklama' => 'required|min:3',
            'ust_kategori' => 'required',
            'adi' => 'required|unique:kategoriler'
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('yonetim/kategori-ekle')->withErrors($validator)->withInput();
        } else {

            $adi = Input::get('adi');
            $aciklama = Input::get('kategori_aciklama');
            $ust_kategori = Input::get('ust_kategori');
            $durum = Input::get('durum');
            $kategoriler = Kategoriler::all();
            $kategori = new Kategoriler();
            $kategori->adi = $adi;
            $kategori->aciklama = $aciklama;
            $kategori->ust_id = $ust_kategori;
            $kategori->durum = $durum;
            if ($kategori->save()) {
                return Redirect::to('yonetim/kategoriler')->with('message', 'Kategori ekleme başarili');
            }
        }
    }

    public function getKategoriler() {
        if (!Session::has('yonetim_oturum')) {
            return Redirect::to('yonetim/giris');
        }
        if (Sentry::check()) {
            return Redirect::to('uye/hesabim');
        }
        $kategoriler = Kategoriler::all();
        return View::make('yonetim/kategori/kategoriler')->with('kategoriler', $kategoriler);
    }

    public function postKategoriSil() {


        $ID = Input::get('id');
        $kategoriler = Kategoriler::find($ID);

        if ($kategoriler->delete())
            return Redirect::to('yonetim/kategoriler');
    }

    public function postKategoriGuncelle() {


        $ID = Input::get('id');
        $kategori_detay = Kategoriler::find($ID);
        $kategoriler = Kategoriler::all();
        return View::make('yonetim.kategori.kategori-guncelle')
                        ->with('kategori_detay', $kategori_detay)
                        ->with('kategoriler', $kategoriler);
    }

    public function postKategoriGuncelleBitir() {


        $ID = Input::get('id');
        $kategori_detay = Kategoriler::find($ID);

        $kategori_detay->adi = Input::get('adi');
        $kategori_detay->ust_id = Input::get('ust_id');
        $kategori_detay->aciklama = Input::get('aciklama');
        $kategori_detay->durum = Input::get('durum');
        if ($kategori_detay->save()) {
            return Redirect::to('yonetim/kategoriler');
        }
    }

}
