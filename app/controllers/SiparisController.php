<?php

class SiparisController extends BaseController {

    public function __construct() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
    }

    /**
     * 
     * @return type
     */
    public function getSiparisAdres() {

        $UserId = Sentry::getUser();


        //echo$UserId->id;

        $adresDefterim = AdresDefterim::where('user_id', '=', $UserId->id)->get();

        return View::make('uye.siparis-adres')->with('adresler', $adresDefterim);
    }

    /**
     * 
     * @return type
     */
    public function getSiparisAdresimEkle() {
        return View::make('uye.siparis-adresim-ekle');
    }

    /**
     * 
     * @return type
     */
    public function postSiparisAdresimEkle() {


        $rules = array(
            'adi' => 'required|min:3|unique:adresdefterim',
            'adres' => 'required|min:3',
            'telefon' => 'required|min:10',
        );

        /**
         * sartlar saglan?yor mu 
         */
        $validator = Validator::make(Input::all(), $rules);



        if ($validator->fails()) {

            /**
             * sartlarda s?k?nt? varsa
             */
            return Redirect::to('uye/siparis-adresim-ekle')->withErrors($validator)->withInput();
        } else {

            $AdresDefterim = new AdresDefterim();

            $AdresDefterim->user_id = Sentry::getUser()->id;
            $AdresDefterim->adi = Input::get('adi');
            $AdresDefterim->adsoyad = Sentry::getUser()->firstname . " " . Sentry::getUser()->lastname;
            $AdresDefterim->adres = Input::get('adres');
            $AdresDefterim->ulke = Input::get('ulke');
            $AdresDefterim->sehir = Input::get('sehir');
            $AdresDefterim->ilce = Input::get('ilce');
            $AdresDefterim->telefon = Input::get('telefon');
            $AdresDefterim->cepno = Input::get('cepno');
            $AdresDefterim->tipi = Input::get('tipi');

            if ($AdresDefterim->save()) {

                if (Input::has('siparisAdres')) {
                    return Redirect::to("uye/siparis-adres");
                } else {
                    return Redirect::to("uye/adres-defterim");
                }
            }
        }
    }

    /**
     * @return type siparis odeme sayfas?
     */
    public function postSiparisOdeme() {


        $rules = array(
            'siparisAdres' => 'required',
        );

        /**
         * sartlar saglan?yor mu 
         */
        $validator = Validator::make(Input::all(), $rules);



        if ($validator->fails()) {

            /**
             * sartlarda s?k?nt? varsa
             */
            return Redirect::to('uye/siparis-adres')->withErrors($validator)->withInput();
        } else {


            $siparisAdres = AdresDefterim::where('id', '=', Input::get('siparisAdres'))->first();



            $AdresBilgilerim = '<div class="panel panel-primary"><div class="panel-heading ">Sipariş adres bilgilerim</div><div class="panel-body "><p class="text text-light-blue">Adres adı: ' . $siparisAdres->adi . '</p><br /><p> Adres detayı:' . $siparisAdres->adres . '</p><br />'.'AdresBilgilerim<p>'.$siparisAdres->ulke.' / ' . $siparisAdres->sehir . '/ '. $siparisAdres->ilce . '</p><br /><p>Müşteri irtibat no: ' . $siparisAdres->telefon . '</p><br /></div></div>';
            
            Session::put('AdresBilgilerim',$AdresBilgilerim);
            
            

            $items = Cart::content();

            return View::make('uye.siparis-odeme')->with('items', $items);



            /* $AdresDefterim = new AdresDefterim();

              $AdresDefterim->user_id = Sentry::getUser()->id;
              $AdresDefterim->adi = Input::get('adi');
              $AdresDefterim->adsoyad = Sentry::getUser()->firstname . " " . Sentry::getUser()->lastname;
              $AdresDefterim->adres = Input::get('adres');
              $AdresDefterim->ulke = Input::get('ulke');
              $AdresDefterim->sehir = Input::get('sehir');
              $AdresDefterim->ilce = Input::get('ilce');
              $AdresDefterim->telefon = Input::get('telefon');
              $AdresDefterim->cepno = Input::get('cepno');
              $AdresDefterim->tipi = Input::get('tipi');

              if ($AdresDefterim->save()) {

              if (Input::has('siparisAdres')) {
              return Redirect::to("uye/siparis-adres");
              } else {
              return Redirect::to("uye/adres-defterim");
              }
              } */
        }
    }

}
