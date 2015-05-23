<?php

class UyeController extends BaseController {

    /**
     * @return View
     */
    public function getGiris() {

        if (Sentry::check()) {
            return Redirect::to('/');
        }
        return View::make('uye/giris');
    }

    public function postGiris() {
        /**
         * Uye kayıt olurken gereklı fitreler
         */
        $rules = array(
            'password' => 'required|min:3',
            'email' => 'required|email'
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);



        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('uye/giris')->withErrors($validator)->withInput();
        } else {
            /**
             * sartlarda sıkıntı yoksa
             */
            try {
                // Login credentials
                $credentials = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                );

                // Authenticate the user
                $user = Sentry::authenticate($credentials, false);

                if ($user) {
                    return Redirect::to('uye/hesabim');
                }
            } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
                return View::make('uye.giris', array('sonuc' => 'Şifre hatalı '));
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                return View::make('uye.giris', array('sonuc' => 'Email adresine kayıtlı hesap bulunamadı'));
            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                return View::make('uye.giris', array('sonuc' => 'Email adresine kayıtlı hesap aktif değil'));
            } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
                return View::make('uye.giris', array('sonuc' => 'Email adresi suspenned'));
            } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
                return View::make('uye.giris', array('sonuc' => 'Email adresi banned'));
            }
        }
    }

    /**
     * 
     * @return View
     */
    public function getUyeol() {
        return View::make('uye/uyeol');
    }

    public function getCikis() {

        if (Sentry::check()) {

            Cart::destroy();
            Sentry::logout();
            return Redirect::to('uye/giris');
        }

        return Redirect::to('/');
    }

    /**
     * @return uye kaıyt etme aktıvasyonu maile gonderme 
     */
    public function postUyeol() {

        /**
         * Uye kayıt olurken gereklı fitreler
         */
        $rules = array(
            'first_name' => 'required|min:3',
            'password' => 'required|min:3',
            'email' => 'required|email|unique:users'
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);



        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('uye/uyeol')->withErrors($validator)->withInput();
        } else {
            /**
             * sartlarda sıkıntı yoksa
             */
            $user = Sentry::register(array(
                        'first_name' => Input::get('first_name'),
                        'last_name' => Input::get('last_name'),
                        'email' => Input::get('email'),
                        'password' => Input::get('password'),
            ));

            /**
             * mail gonderme işlemi
             */
            $bilgi = array('ad' => $user->first_name,
                'detay' => $user->getActivationCode(),
            );

            Mail::send('emails.aktivasyon', $bilgi, function($mesaj) {

                $mesaj->from('mehmetaliturkan@gmail.com', 'Mağaza Eticaret Admini');
                $mesaj->to(Input::get('email'), Input::get('first_name') . ' ' . Input::get('last_name'))->subject('Üyelik aktifleştirme linki');
            });

            return View::make('uye.uyeol', array('sonuc' => 'Maille aktivasyon linki gönderildi.'));
        }
    }

    /**
     * 
     * @return View
     */
    public function getHesabim() {
        if (Sentry::check()) {
            return View::make('uye/profil');
        }
        return Redirect::to('uye/giris');
    }

    /**
     * bilgilerim
     */
    public function getBilgilerim() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
        return View::make('uye.bilgilerim');
    }

    /**
     * user  profil bılgılerını guncellmesını yap
     */
    public function postBilgilerim() {

        $id = Sentry::getUser()->id;
        $rules = array(
            'last_name' => 'required|min:3',
            'first_name' => 'required|min:3'
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);



        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('uye/bilgilerim')->withErrors($validator)->withInput();
        } else {
            $sifre1 = Input::get('password1');
            $sifre2 = Input::get('password2');
            if (empty($sifre1)) {
                try {
                    // Find the user using the user id
                    $user = Sentry::findUserById($id);

                    // Update the user details
                    $user->last_name = Input::get('last_name');
                    $user->first_name = Input::get('first_name');

                    // Update the user
                    if ($user->save()) {
                        return Redirect::to("uye/bilgilerim");
                    } else {
                        // User information was not updated
                    }
                } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                    echo 'User with this login already exists.';
                } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    echo 'User was not found.';
                }
            } elseif (($sifre1) == $sifre2) {
                try {
                    // Find the user using the user id
                    $user = Sentry::findUserById($id);

                    // Update the user details
                    $user->last_name = Input::get('last_name');
                    $user->first_name = Input::get('first_name');
                    $user->password = Input::get('password1');

                    // Update the user
                    if ($user->save()) {
                        return Redirect::to("uye/bilgilerim");
                    } else {
                        // User information was not updated
                    }
                } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                    echo 'User with this login already exists.';
                } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    echo 'User was not found.';
                }
            } else {
                return View::make('uye/bilgilerim')->with('sonuc', 'Girilen şifreler aynı değil');
            }
        }
    }

    /**
     * sepetim
     */
    public function getSepetim() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
        $items = Cart::content();
        return View::make('uye.sepetim')->with('items', $items);
    }

    /**
     * siparisler
     */
    public function getSiparisler() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }

        $items = DB::table('satilanlar')
                ->join('odemeturleri', 'satilanlar.odemeturleri_id', '=', 'odemeturleri.id')
                ->join('satilanlardurum', 'satilanlar.satilanlardurum_id', '=', 'satilanlardurum.id')
                ->join('teslimatadresim', 'satilanlar.teslimatadresim_id', '=', 'teslimatadresim.id')
                ->join('kargolar', 'satilanlar.kargolar_id', '=', 'kargolar.id')
                ->join('users', function($join) {
                    $join->on('satilanlar.users_id', '=', 'users.id')
                    ->where('users.id', '=', Sentry::getUser()->id);
                })
                ->select('satilanlar.id', 'satilanlar.created_at', 'odemeturleri.detay', 'kargolar.adi', 'satilanlar.kargo_no', 'satilanlardurum.durum', 'teslimatadresim.id as adres_id')
                ->get();
        return View::make('uye.siparisler')->with('items', $items);
    }

    /**
     * 
     */
    public function postSiparisDetay() {
        $gidecek = "";

        $sonuc = DB::table('satilanlardetay')
                ->join('urunler', function($join) {

                    $join->on('satilanlardetay.urun_id', '=', 'urunler.id')
                    ->where('satilanlardetay.satilanlar_id', '=', Input::get('id'));
                })
                ->select('urunler.adi', 'urunler.link', 'satilanlardetay.adet', 'satilanlardetay.fiyat')
                ->get();
        $toplamFiyat = 0;
        foreach ($sonuc as $son) {
            $toplamFiyat+=$son->fiyat * $son->adet;
            $gidecek.="<tr><td> <a href='http://eticaret.maturkan.com/urun/" . $son->link . "'>" . $son->adi . "</a></td> <td>" . $son->adet . "</td><td>" . $son->fiyat . " <span class='fa fa-turkish-lira'></span></td><td>" . ($son->fiyat * $son->adet) . " <span class='fa fa-turkish-lira'></span> </td></tr>";
        }
        $kargo = 0;
        if ($toplamFiyat < 200) {
            $kargo = 9.99; 
        }
        $gidecekson = "<div class='box-body table-responsive'>
                        <table id='example1'class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>Adı</th>
                                    <th>Adet</th>
                                    <th>Fiyat</th>
                                    <th>Ara toplam</th>
                                    
                                </tr>
                            </thead>
                            <tbody>" . $gidecek . " </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan='2'>&nbsp;</td>
                                    <td colspan='2'>
                                        <table class='table table-condensed total-result'>
                                            <tr>
                                                <td>Sipariş ara toplam</td>
                                                <td>" . $toplamFiyat . " <span class='fa fa-turkish-lira'></span></td>
                                            </tr>
                                            <tr>
                                                <td>Kdv Tutarı(%18)</td>
                                                <td>" . ($toplamFiyat * 0.18) . " <span class='fa fa-turkish-lira'></span></td>
                                            </tr>
                                            <tr>
                                                <td>Kargo fiyati:</td>
                                                <td>" . $kargo . " <span class='fa fa-turkish-lira'></span></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Total</td>
                                                <td>" . ($toplamFiyat + $toplamFiyat * 0.18 + $kargo) . " <span class='fa fa-turkish-lira'></span> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>";
        echo $gidecekson;
    }

    public function postTeslimatDetay() {
        $sonuc = DB::table('teslimatadresim')->where('id', '=', Input::get('id'))->first();


        echo $sonuc->veri;
    }

    /**
     * Favoriler
     */
    public function getFavoriler() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
        return View::make('uye.favoriler');
    }

    /**
     * adres defterim view
     */
    public function getAdresDefterim() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
        $adresdefterim = DB::table('adresdefterim')
                        ->where('user_id', '=', Sentry::getUser()->id)->get();

        return View::make('uye.adres-defterim')->with('adresler', $adresdefterim);
    }

    /**
     * 
     * @return View Adres deferi ekleme
     */
    public function getAdresDefterimEkle() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
        return View::make('uye.adres-defterim-ekle');
    }

    /**
     * 
     * @return redirect adres kaydı
     */
    public function postAdresDefterimEkle() {
        if (!Sentry::check()) {
            return View::make('uye/giris');
        }
        $rules = array(
            'adi' => 'required|min:3|unique:adresdefterim',
            'adres' => 'required|min:3',
            'telefon' => 'required|min:10',
            'adsoyad' => 'required'
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);



        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('uye/adres-defterim-ekle')->withErrors($validator)->withInput();
        } else {




            $AdresDefterim = new AdresDefterim();

            $AdresDefterim->user_id = Sentry::getUser()->id;
            $AdresDefterim->adi = Input::get('adi');
            $AdresDefterim->adsoyad = Input::get('adsoyad');
            $AdresDefterim->adres = Input::get('adres');
            $AdresDefterim->ulke = Input::get('ulke');
            $AdresDefterim->sehir = Input::get('sehir');
            $AdresDefterim->ilce = Input::get('ilce');
            $AdresDefterim->telefon = Input::get('telefon');
            $AdresDefterim->cepno = Input::get('cepno');
            $AdresDefterim->tipi = Input::get('tipi');
            $AdresDefterim->vergino = Input::get('vergino');
            $AdresDefterim->vergidairesi = Input::get('vergidaire');

            if ($AdresDefterim->save()) {

                return Redirect::to("uye/adres-defterim");
            }
        }
    }

    /**
     * 
     * @Adres defterınde verılerı sılme
     */
    public function postAdresDefterimSil() {
        $ID = Input::get('id');
        $AdresDefterim = AdresDefterim::find($ID);

        if ($AdresDefterim->delete()) {
            return Redirect::to('uye/adres-defterim');
        }
    }

    /**
     * adres defterımı guncelle
     */
    public function postAdresDefterimGuncelle() {
        $ID = Input::get('id');
        $adres_detay = AdresDefterim::find($ID);
        return View::make('uye.adres-defterim-guncelle')
                        ->with('adres_detay', $adres_detay);
    }

    public function postAdresDefterimGuncelleBitir() {
        $ID = Input::get('id');

        $AdresDefterim = AdresDefterim::find($ID);

        $AdresDefterim->adi = Input::get('adi');
        $AdresDefterim->adsoyad = Input::get('adsoyad');
        $AdresDefterim->adres = Input::get('adres');
        $AdresDefterim->ulke = Input::get('ulke');
        $AdresDefterim->sehir = Input::get('sehir');
        $AdresDefterim->ilce = Input::get('ilce');
        $AdresDefterim->telefon = Input::get('telefon');
        $AdresDefterim->cepno = Input::get('cepno');
        $AdresDefterim->tipi = Input::get('tipi');
        $AdresDefterim->vergino = Input::get('vergino');
        $AdresDefterim->vergidairesi = Input::get('vergidaire');

        if ($AdresDefterim->save()) {
            return Redirect::to('uye/adres-defterim');
        }
    }

    /**
     * get aktivasyon yapma bolumu
     */
    public function getAktivasyon($kod) {


        $user = User::where('activation_code', '=', $kod)->update(array('activated' => 1, 'activation_code' => null));

        if ($user) {
            return Redirect::to('uye/giris')->with('sonuc', 'Hesap aktif edildi. Giris yapabilir siniz');
        } else {
            return Redirect::to('uye/giris')->with('sonuc', 'Hatali hesap aktivasyon kodu..');
        }
    }

}
