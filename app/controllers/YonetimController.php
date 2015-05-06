<?php

class YonetimController extends BaseController {

    /**
     * 
     * Bu yapılndırıcı sıparısı verılen butun verılerı kontrolunu otomatık saglamakta 
     * eger odemelerde sıkıntı yokssasipariş durumunu onaylar ve yotıcı kısıye sadece 
     * bılgılaerın kontrol etmesı gerektıgı kalır. Eger
     * dıger bılgılerınde sıkıntı yoksa bu sefer kargo hazılanması ıslemıne gecılır
     */
    /* public function __construct() {
 
      $items = DB::table('paypal')
      ->join('satilanlar', 'paypal.satilanlar_id', '=', 'satilanlar.id')
      ->join('users', 'paypal.users_id', '=', 'users.id')
      ->select('users.first_name', 'users.last_name', 'satilanlar.id', 'satilanlar.satilanlardurum_id', 'paypal.amt_tl', 'paypal.satilanlar_id', 'paypal.cc_birimi')
      ->get();
      foreach ($items as $item) {

      $satilanlar_onay_kontrolu_id = $item->satilanlar_id;
      $satilanlardetay_urunleri = SiparisDetay::where('satilanlar_id', $satilanlar_onay_kontrolu_id)->get();

      //Topla fıyat kdv hesaplanmsı ve net ucrfetın cıkarılması
      $toplam_fiyat = 0;
      $toplam_kdv = 0;

      foreach ($satilanlardetay_urunleri as $urunleri) {
      $toplam_fiyat+=$urunleri->adet * $urunleri->fiyat;
      }
      $toplam_kdv = $toplam_fiyat * 0.18;
      $odenmesi_gereken_net_fiyat = $toplam_fiyat + $toplam_kdv;
      if ($odenmesi_gereken_net_fiyat < 200) {
      $odenmesi_gereken_net_fiyat += 9.99;
      }
      //  die('odenmesi gereken:'.$odenmesi_gereken_net_fiyat.'<br />Ödenen:'.$item->amt_tl);
      //Siparis odemelerınde gereklı kontrolun yapılması
      if (round($odenmesi_gereken_net_fiyat, 2) == $item->amt_tl) {

      $satilanlar_guncelle = Siparisler::find($item->satilanlar_id);
      $satilanlar_guncelle->onay = 1;
      $satilanlar_guncelle->satilanlardurum_id = 1;

      $satilanlar_guncelle->save();
      } else {
      $satilanlar_guncelle = Siparisler::find($item->satilanlar_id);
      $satilanlar_guncelle->satilanlardurum_id = -1;

      $satilanlar_guncelle->save();
      }
      }
      } */
    public function postSiparisGuncelle() {
        $paypal = Paypal::where('satilanlar_id', '=', Input::get('id'))->first();
        $odenen_fiyat = $paypal->amt_tl;

        $satilanlardetay_urunleri = SiparisDetay::where('satilanlar_id', Input::get('id'))->get();

        //Topla fıyat kdv hesaplanmsı ve net ucrfetın cıkarılması
        $toplam_fiyat = 0;
        $toplam_kdv = 0;

        foreach ($satilanlardetay_urunleri as $urunleri) {
            $toplam_fiyat+=$urunleri->adet * $urunleri->fiyat;
        }
        $toplam_kdv = $toplam_fiyat * 0.18;
        $odenmesi_gereken_net_fiyat = $toplam_fiyat + $toplam_kdv;

        if ($odenmesi_gereken_net_fiyat < 200) {
            $odenmesi_gereken_net_fiyat += 9.99;
        }
        //  die('odenmesi gereken:'.$odenmesi_gereken_net_fiyat.'<br />Ödenen:'.$item->amt_tl);
        //Siparis odemelerınde gereklı kontrolun yapılması
        $secenekler = "";

        $satilanlardurum = SiparisDurum::all();
        $siparisler = Siparisler::where('id', '=', Input::get('id'))->first();

        foreach ($satilanlardurum as $satdurum) {

            if ($siparisler->satilanlardurum_id == $satdurum->id) {
                $secenekler = $secenekler . '<option selected value="' . $satdurum->id . '">' . $satdurum->durum . '</option>';
            } else {
                $secenekler = $secenekler . '<option value="' . $satdurum->id . '">' . $satdurum->durum . '</option>';
            }
        }
        echo
        '<p id="sonuc"class="text-center"> 
            
            <span class="text text-primary">Ödenecek sipariş tutarı: ' . round($odenmesi_gereken_net_fiyat, 2) . '</span>
            <br />
            <span class="text text-primary">Ödenen tutarı: ' . round($odenen_fiyat, 2) . '</span>
        </p>
        <div class="form-group">
            
        <input type="hidden" id="s_n"value="' . Input::get('id') . '" />
            <label for="form">Varsa korgo takip noyu girin</label>
            <input class="form-control" id="k_n" type="text" value="' . $siparisler->kargo_no . '" name="kargo-no" placeholder="Kargo takip noyu girin!" id="" />
        </div>
        <div class="form-group">
            <label for="form" >Sipariş durumunu güncelle</label>
            <select class="form-control" id="k_g" id="">
                ' . $secenekler . '
            </select>
        </div>';
    }

    /**
     * 
     * @return View yonetim index
     */
    public function getYonetimIndex() {

        if (!Session::has('yonetim_oturum')) {
            return Redirect::to('yonetim/giris');
        }

        $items = DB::table('satilanlar')->orderBy('satilanlar.id', 'desc')
                ->join('odemeturleri', 'satilanlar.odemeturleri_id', '=', 'odemeturleri.id')
                ->join('teslimatadresim', 'satilanlar.teslimatadresim_id', '=', 'teslimatadresim.id')
                ->join('kargolar', 'satilanlar.kargolar_id', '=', 'kargolar.id')
                ->join('satilanlardurum', 'satilanlar.satilanlardurum_id', '=', 'satilanlardurum.id')
                ->join('users', 'satilanlar.users_id', '=', 'users.id')
                ->select('users.email', 'users.first_name', 'users.last_name', 'satilanlar.id', 'satilanlar.created_at', 'odemeturleri.detay', 'kargolar.adi', 'satilanlar.kargo_no', 'satilanlardurum.durum', 'teslimatadresim.id as adres_id')
                ->get();


        $yorumlar = Yorumlar::where('durum', '=', 0)->get();


        $onlines = DB::table('online')
                ->select(DB::raw('time,ip,users_id'))
                ->groupBy('users_id')
                ->orderBy('id', 'desc')
                ->get();

        /* Cart::destroy();
          Cart::add(array('id' => '1', 'name' => 'Product 1', 'qty' => 3, 'price' => 9.99, 'options' => array('size' => 'large')));
          Cart::add(array('id' => '2', 'name' => 'Product 2', 'qty' => 1, 'price' => 19.99, 'options' => array('size' => 'large')));
          $items = Cart::content();
         */
        return View::make('yonetim/index')->with('yorumlar', $yorumlar)->with('onlines', $onlines)->with('items', $items);
    }

    /**
     * @return View
     */
    public function getYonetimGiris() {

        /*
          $Yonetim=new Yonetim;

          $Yonetim->user_id='yonetim';
          $Yonetim->last_name='TÜRKAN';
          $Yonetim->first_name='Mehmetali';
          $Yonetim->email='mehmetaliturkan@gmail.com';
          $Yonetim->password=  md5('123');
          $Yonetim->seviye=0;

          $Yonetim->save();

         */

        if (Sentry::check()) {
            return Redirect::to('uye/hesabim');
        }

        if (Session::has('yonetim_oturum')) {
            return Redirect::to('yonetim/index');
        }
        return View::make('yonetim/giris');
    }

    /**
     * Yonetici giris ıstegı yaptıgında
     */
    public function postYonetimGiris() {

        /**
         * her ihtımale karsı uyelerın buraya erısımlerını sıkıtlıyorum
         */
      
        /**
         * gerekli form kontrollerını burada tanımlanmasını yapıyorum
         */
        $rules = array(
            'user_id' => 'required|min:6',
            'password' => 'required|min:3'
        );

        /**
         * kontrol zamanı
         */
        $Validator = Validator::make(Input::all(), $rules);


        /**
         * kontrollerde hata olmussa
         */
        if ($Validator->fails()) {


            /**
             * hataları gırıs ınputları ıle bırlıkte gerıye gonder
             */
            return Redirect::to('yonetim/giris')->withErrors($Validator)->withInput();
        } else {
            /**
             * hata veya eksıklık olmazsa buradan devam edecegız
             * kullanıcı gırıs bılgılerını alalım
             */
            $user_id = Input::get("user_id");

            /**
             * sifreyı md5 ıle yada Hash::make('sifre'); kullanılarak yapılabılır
             */
            $password = md5(Input::get("password"));


            $YonetimSay = Yonetim::whereRaw('user_id=? and password=?', array($user_id, $password))->count();

            if ($YonetimSay > 0) {

                /**
                 * yonetici bılgılerı gırılmıs ve dogrulanmıs demektır
                 */
                $Yonetim = Yonetim::whereRaw('user_id=?', array($user_id))->first();

                Session::put('yonetim_id', $Yonetim->id);
                Session::put('yonetim_user_id', $Yonetim->user_id);
                Session::put('yonetim_oturum', true);
                Session::put('yonetim_seviye', $Yonetim->seviye);

                return Redirect::to('yonetim/index');
            } else {
                return View::make('yonetim/giris')->with('sonuc', 'Kullanıcı adı veya sifre hatalı');
            }
        }
    }

    /**
     * 
     * Yonetim cıkısı
     */
    public function postYonetimCikis() {

        Session::forget('yonetim_id');
        Session::forget('yonetim_user_id');
        Session::forget('yonetim_oturum');
        Session::forget('yonetim_seviye');

        return Redirect::to('yonetim/index');
    }

    public function getYonetimYorumOnay($param) {

        DB::table('yorumlar')
                ->where('id', $param)
                ->update(array('durum' => 1));
        return Redirect::to('yonetim');
    }

    public function getYonetimYorumSil($param) {
        DB::table('yorumlar')->where('id', '=', $param)->delete();
        return Redirect::to('yonetim');
    }

    public function getZiyaretciler() {
        $ziyaret=  Ziyaretciler::all();
        return View::make('yonetim.ziyaretciler')->with('items', $ziyaret);
    }

    public function postSiparisDurumGuncelle() {

        if (Input::has('kargo_no')) {

            $siparis = Siparisler::find(Input::get('siparis_id'));
            $siparis->kargo_no = Input::get('kargo_no');
            $siparis->satilanlardurum_id = Input::get('siparis_durum');


            if ($siparis->save()) {
                echo '<span class="text text-primary">Sipariş durumu ve kargo nosu güncellendi!</span>';
            } else {
                echo '<span class="text text-danger">Bağlantı başarısız!</span>';
            }
        } else {
            $siparis = Siparisler::find(Input::get('siparis_id'));
            $siparis->satilanlardurum_id = Input::get('siparis_durum');

            if ($siparis->save()) {
                echo '<span class="text text-primary">Sipariş durumu güncellendi!</span>';
            } else {
                echo '<span class="text text-danger">Bağlantı başarısız!</span>';
            }
        }
    }

}
