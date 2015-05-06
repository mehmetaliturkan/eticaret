<?php

/**
 * 
 * @author Mehmetali TURKAN <mehmetaliturkan@gmail.com>
 */

/**
 * Yonetın urun kontroller
 */
class YonetimUrunController extends BaseController {

    /**
     * getIndex Method
     */
    public function getUrunEkle() {
        if (!Session::has('yonetim_oturum')) {
            return Redirect::to('yonetim/giris');
        }

        $kategoriler = Kategoriler::all();

        return View::make('yonetim/urun/urun-ekle')->with('kategoriler', $kategoriler);
    }

    /**
     * 
     * @return View
     */
    public function getUrunResimYazi() {
        return View::make('yonetim.urun.resim-yazi-ekle');
    }

    public function postUrunResimYazi() {
        $etiket = Input::get('yazi');
//print_r($etiket);

        $dizi = array();
        $dizin = "images/magaza/urunler";
        $ac = opendir($dizin);
        while ($x = readdir($ac)) {
            if ($x != "." && $x != "..") {
                $dizi[] = $x;
            }
        }

// Bu kodlar dönüştürme işlemi uzun sürdüğü zaman serverın işleminizi iptal etmesini geciktiren kodlardır.
        set_time_limit(10);
        ini_set('max_execution_time', 1000); // Buradaki 1000sn yi istediğiniz kadar uzatabilirsiniz. Ben 500 resim için 1.5dk bekledim. Fazla fazla süre verdim. Aksi halde işleminiz yarıda kalır 160 tanesini yaparsınız ve işleminiz kesilir. Resim işleme uzun bir süreçtir Unutmayın.


        foreach ($dizi as $x => $y) {
            //echo $x.") ".$etiket[$x]." - ".$y."<br>";
            $font = 'fonts/Verdana.ttf'; //klasörümüe kopyaladigimiz boldlu font dosyasi
            $kaynak = "images/magaza/urunler/" . $y; // resimleri alacagimiz dizin
            $resimm = imagecreatefromjpeg($kaynak); //GD kodu ile resmimizi Ramde olusturuyoruz

            $yeniresim = imagecreatetruecolor(640, 480); //GD kodu ile Daha büyük bir resim olusturuyoruz
            //kullanacagimiz renkleri tanimliyoruz
            $beyaz = imagecolorallocate($yeniresim, 255, 255, 255);
            $gri = imagecolorallocate($yeniresim, 128, 128, 128);
            $siyah = imagecolorallocate($yeniresim, 0, 0, 0);
            //arkaplan rengimizi beyaz yapiyoruz
            imagefill($yeniresim, 0, 0, $beyaz);

            //yeni olusturdugumuz beyaz resim ile kaynaktan aldigimiz resimi birlestiriyoruz.
            //bu kodda resim yukaridan 94px bosluktan sonra ekrana yerlestirilmistir. En sondaki 2 deger resimin genislik ve yükseklik degerleridir.
            //
 imagecopyresampled($yeniresim, $resimm, 0, 0, 0, 0, 640, 480, 640, 480);

            //yazilarin bulundugu diziden $etiket[$x] içinde bulunan yazidaki türkçe karakterleri UTF-8 yapiyoruz.
            $yazi = iconv("iso-8859-9", "utf-8", 'maturkan.com  '); //türkçe karakter sorunu çözüldü
            //bu bir hizalama fonksiyonu, uzun aramalar sonucu denk geldim. Yazinizi ortalamak için kullabilirsiniz.
            YonetimUrunController::hizala($yeniresim, 40, 0, 0, 63, $gri, $font, $yazi);
            YonetimUrunController::hizala($yeniresim, 40, 0, 0, 60, $siyah, $font, $yazi);

            //Resminize yaziyi da ekledikten sonra artik bir yerlere kaydetmelisiniz. 
            //b/$y dedigimiz b dizininde $y ismiyle kaydedilecek bu resim.
            imagejpeg($yeniresim, "images/magaza/urunler/$y", 100);
        }
        closedir($ac);


//yazıyı ortaya Hizalamak için bir fonksiyon. 


        return Redirect::to('/');
    }

    public function hizala($image, $size, $angle, $x, $y, $color, $font, $text, $alignment = 'C') {
        //check width of the text 
        $bbox = imagettfbbox($size, $angle, $font, $text);
        $textWidth = $bbox[2] - $bbox[0];
        switch ($alignment) {
            case "R":
                $x -= $textWidth;
                break;
            case "C":
                $x -= $textWidth / 2;
                break;
        }

        //ekrana metni yazdır, ben metini resmin ortasında yazdırmak istediğim için 400 olan 
        //resmimin genişliğine -değer olan xi ekledim. ortalanmış oldu
        imagettftext($image, $size, $angle, $x + 400, $y + 400, $color, $font, $text);
    }

    /**
     * 
     * @Urun ekleme post istegı olursa
     * 
     * 
     */
    public function postUrunEkle() {
        /**
         * Kategoride bulunan tum verılerı al ve gonder
         */
        $rules = array(
            'detay' => 'required|min:3',
            'adet' => 'required|min:1',
            'satilan' => 'required',
            'spot' => 'required',
            'fiyat' => 'required|min:1',
            'indirim' => 'required',
            'firsat' => 'required',
            'durum' => 'required',
            'gosterim' => 'required',
            'kategori_id' => 'required',
            'adi' => 'required|unique:urunler'
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('yonetim/urun-ekle')->withErrors($validator)->withInput();
        } else {

            $resim = Input::file('file');
            $resim_ad = date("Y-m-d-H-m-s") . "-" . $resim->getClientOriginalName();
            $path = public_path('images/magaza/urunler/' . $resim_ad);



            Image::make($resim->getRealPath())->resize(640, 480)->save($path);


            $font = 'fonts/Verdana.ttf'; //klasörümüe kopyaladigimiz boldlu font dosyasi
            $kaynak = "images/magaza/urunler/" . $resim_ad; // resimleri alacagimiz dizin
            $resimm = imagecreatefromjpeg($kaynak); //GD kodu ile resmimizi Ramde olusturuyoruz

            $yeniresim = imagecreatetruecolor(640, 480); //GD kodu ile Daha büyük bir resim olusturuyoruz
            //kullanacagimiz renkleri tanimliyoruz
            $beyaz = imagecolorallocate($yeniresim, 255, 255, 255);
            $gri = imagecolorallocate($yeniresim, 128, 128, 128);
            $siyah = imagecolorallocate($yeniresim, 0, 0, 0);
            //arkaplan rengimizi beyaz yapiyoruz
            imagefill($yeniresim, 0, 0, $beyaz);

            //yeni olusturdugumuz beyaz resim ile kaynaktan aldigimiz resimi birlestiriyoruz.
            //bu kodda resim yukaridan 94px bosluktan sonra ekrana yerlestirilmistir. En sondaki 2 deger resimin genislik ve yükseklik degerleridir.
            //
 imagecopyresampled($yeniresim, $resimm, 0, 0, 0, 0, 640, 480, 640, 480);

            //yazilarin bulundugu diziden $etiket[$x] içinde bulunan yazidaki türkçe karakterleri UTF-8 yapiyoruz.
            $yazi = iconv("iso-8859-9", "utf-8", 'maturkan.com  '); //türkçe karakter sorunu çözüldü
            //bu bir hizalama fonksiyonu, uzun aramalar sonucu denk geldim. Yazinizi ortalamak için kullabilirsiniz.
            YonetimUrunController::hizala($yeniresim, 40, 0, 0, 63, $gri, $font, $yazi);
            YonetimUrunController::hizala($yeniresim, 40, 0, 0, 60, $siyah, $font, $yazi);

            //Resminize yaziyi da ekledikten sonra artik bir yerlere kaydetmelisiniz. 
            //b/$y dedigimiz b dizininde $y ismiyle kaydedilecek bu resim.
            imagejpeg($yeniresim, "images/magaza/urunler/$resim_ad", 100);

            $urunler = new Urunler();
            $urunler->adi = Input::get('adi');
            $urunler->kategori_id = Input::get('kategori_id');
            $urunler->adet = Input::get('adet');
            $urunler->satilan = Input::get('satilan');
            $urunler->spot = Input::get('spot');
            $urunler->fiyat = Input::get('fiyat');
            $urunler->indirim = Input::get('indirim');
            $urunler->kod = substr(md5(Input::get('adi')), 10, 15);
            $urunler->detay = Input::get('detay');
            $urunler->firsat = Input::get('firsat');
            $urunler->durum = Input::get('durum');
            $urunler->link = YonetimUrunController::seflink(Input::get('adi'));
            $urunler->gosterim = Input::get('gosterim');

            if ($urunler->save()) {

                $insertedId = $urunler->id;
                $UrunResimler = new UrunResimler();

                $UrunResimler->adi = 'images/magaza/urunler/' . $resim_ad;
                $UrunResimler->urun_id = $insertedId;

                if ($UrunResimler->save())
                    return Redirect::to('yonetim/urunler');
            }
        }
    }

    public function getUrunler() {
        if (!Session::has('yonetim_oturum')) {
            return Redirect::to('yonetim/giris');
        }


        $urunler = Urunler::all();
        return View::make('yonetim/urun/urunler')->with('urunler', $urunler);
    }

    public function postUrunSil() {


        $ID = Input::get('id');
        $urunler = Urunler::find($ID);

        if ($urunler->delete())
            return Redirect::to('yonetim/urunler');
    }

    public function postUrunGuncelle() {


        $ID = Input::get('id');
        $urun_detay = Urunler::find($ID);
        $kategoriler = Kategoriler::all();
        return View::make('yonetim.urun.urun-guncelle')
                        ->with('urun_detay', $urun_detay)
                        ->with('kategoriler', $kategoriler);
    }

    public function postUrunGuncelleBitir() {


        $ID = Input::get('id');

        $urun_detay = Urunler::find($ID);

        $urun_detay->adi = Input::get('adi');
        $urun_detay->kategori_id = Input::get('kategori_id');
        $urun_detay->firsat = Input::get('firsat');
        $urun_detay->detay = Input::get('detay');
        $urun_detay->adet = Input::get('adet');
        $urun_detay->durum = Input::get('durum');
        $urun_detay->spot = Input::get('spot');
        $urun_detay->fiyat = Input::get('fiyat');
        $urun_detay->indirim = Input::get('indirim');
        if ($urun_detay->save()) {
            return Redirect::to('yonetim/urunler');
        }
    }

    public function seflink($string) {
        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
        $string = strtolower(str_replace($find, $replace, $string));
        $string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
        $string = trim(preg_replace('/\s+/', ' ', $string));
        $string = str_replace(' ', '-', $string);
        return $string;
    }

    /**
     * resim ekleme get post ıslemlerı
     * 
     */
    public function postUrunResimEkle() {

        if (!Input::has('id')) {
            return Redirect::to('yonetim/urunler');
        } else
            return View::make('yonetim.urun.urun-resim-ekle')->with('id', Input::get('id'));
    }

    public function postUrunResimEkleBitir() {

        $ID = Input::get('id');
        $resim = Input::file('file');
        $resim_ad = date("Y-m-d-H-m-s") . "-" . $resim->getClientOriginalName();
        $path = public_path('images/magaza/urunler/' . $resim_ad);

        Image::make($resim->getRealPath())->resize(300, 200)->save($path);
        $UrunResimler = new UrunResimler();

        $UrunResimler->adi = 'images/magaza/urunler/' . $resim_ad;
        $UrunResimler->urun_id = $ID;

        if ($UrunResimler->save())
            return Redirect::to('yonetim/urunler');
    }

}
