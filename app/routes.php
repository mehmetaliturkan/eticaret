<?php

/**
 * magaza index
 */
Route::get('/', 'MagazaController@getIndex');
Route::get('/hatali-istek', 'MagazaController@getHataliIstek');
Route::post('urun/yorum-yap', 'YorumController@postYorumYap');



Route::get('urun/{urunLink}', 'MagazaController@getUrunDetay');
Route::get('kategori/{kategoriLink}', 'MagazaController@getKategori');
Route::get('arama', 'MagazaController@getArama');



/**
 * Paypal odeme yonlendırmelerı
 * 
 * Burada siparis odeme bılgılerı gerı doner ve bu bılgıleri verıtabanına kayır ederız
 */
Route::get('paypal', 'PaypalController@getPaypal');
Route::post('paypal', 'PaypalController@postPaypal');
Route::get('uye/siparis-onaylandi', 'PaypalController@getSiparisOnaylandi');


/**
 * kullanıcıya bılgı maıl gondermek ıcın kullanılır
 */
Route::get('odeme-onaylandi', 'MagazaController@getOdemeOnaylandi');


/**
 * siparıs 
 */
Route::get('uye/siparis-adres', 'SiparisController@getSiparisAdres');
Route::get('uye/siparis-adresim-ekle', 'SiparisController@getSiparisAdresimEkle');
Route::post('uye/siparis-adresim-ekle', 'SiparisController@postSiparisAdresimEkle');
Route::post('uye/siparis-odeme', 'SiparisController@postSiparisOdeme');


/**
 * Sepet işlemleri
 */
Route::post('sepet-ekle', 'SepetController@postSepetEkle');

Route::get('sepet-urun-ekle/{id}', 'SepetController@getSepetUrunEkle');

Route::get('sepet-adet-eksil/{id}', 'SepetController@getSepetAdetEksil');
Route::get('sepet-adet-artir/{id}', 'SepetController@getSepetAdetArtir');
Route::get('sepet-urun-sil/{id}', 'SepetController@getSepetUrunSil');



/**
 * uye controller routes 
 */
Route::get('uye/uyeol', 'UyeController@getUyeol');
Route::post('uye/uyeol', 'UyeController@postUyeol');

Route::get('uye/giris', 'UyeController@getGiris');
Route::post('uye/giris', 'UyeController@postGiris');


Route::get('uye/cikis', 'UyeController@getCikis');



Route::get('uye/hesabim', 'UyeController@getHesabim');
Route::get('uye/bilgilerim', 'UyeController@getBilgilerim');
Route::post('uye/bilgilerim', 'UyeController@postBilgilerim');


Route::get('uye/sepetim', 'UyeController@getSepetim');
Route::get('uye/siparisler', 'UyeController@getSiparisler');
Route::post('uye/siparis-detay', 'UyeController@postSiparisDetay');
Route::post('uye/teslimat-detay', 'UyeController@postTeslimatDetay');
Route::get('uye/favoriler', 'UyeController@getFavoriler');


Route::get('uye/adres-defterim', 'UyeController@getAdresDefterim');
Route::get('uye/adres-defterim-ekle', 'UyeController@getAdresDefterimEkle');
Route::post('uye/adres-defterim-ekle', 'UyeController@postAdresDefterimEkle');
Route::post('uye/adres-defterim-sil', 'UyeController@postAdresDefterimSil');
Route::post('uye/adres-defterim-guncelle', 'UyeController@postAdresDefterimGuncelle');
Route::post('uye/adres-defterim-guncelle-bitir', 'UyeController@postAdresDefterimGuncelleBitir');


Route::get('aktivasyon/{kod}', 'UyeController@getAktivasyon');



/**
 * @name Yonetim routes
 */
Route::get('yonetim', function() {

    return Redirect::to("yonetim/index");
});
Route::get('yonetim/index', 'YonetimController@getYonetimIndex');


Route::get('yonetim/yorumlar/onay/{id}', 'YonetimController@getYonetimYorumOnay');
Route::get('yonetim/yorumlar/sil/{id}', 'YonetimController@getYonetimYorumSil');




/**
 * yonetim giris sayfası get ve post işlemleri
 * 
 */
Route::get('yonetim/giris', 'YonetimController@getYonetimGiris');
Route::post('yonetim/giris', 'YonetimController@postYonetimGiris');

/**
 * yonetim cıkıs routes
 */
Route::get('yonetim/cikis', 'YonetimController@postYonetimCikis');
Route::post('snCek', 'YonetimController@postYonetimSnCek');
Route::post('uye/siparis-guncelle', 'YonetimController@postSiparisGuncelle');
Route::post('uye/siparis-durum-guncelle', 'YonetimController@postSiparisDurumGuncelle');


/**
 * yonetim profil bilgileri
 */
/**
 * yonetim urun modul routes 
 * 
 */
Route::get('yonetim/urun-ekle', 'YonetimUrunController@getUrunEkle');
Route::post('yonetim/urun-ekle', 'YonetimUrunController@postUrunEkle');


Route::get('yonetim/urunler', 'YonetimUrunController@getUrunler');
Route::post('yonetim/urun-sil', 'YonetimUrunController@postUrunsil');
Route::post('yonetim/urun-guncelle', 'YonetimUrunController@postUrunGuncelle');
Route::post('yonetim/urun-guncelle-bitir', 'YonetimUrunController@postUrunGuncelleBitir');

/**
 * urun resım ekleme
 */
Route::post('yonetim/urun-resim-ekle', 'YonetimUrunController@postUrunResimEkle');
Route::post('yonetim/urun-resim-ekle-bitir', 'YonetimUrunController@postUrunResimEkleBitir');
Route::get('yonetim/urun-resim-yazi', 'YonetimUrunController@getUrunResimYazi');
Route::post('yonetim/urun-resim-yazi', 'YonetimUrunController@postUrunResimYazi');



/**
 * yonetim kategori modul routes 
 * 
 */
Route::get('yonetim/kategori-ekle', 'YonetimKategoriController@getKategoriEkle');
Route::post('yonetim/kategori-ekle', 'YonetimKategoriController@postKategoriEkle');

Route::get('yonetim/kategoriler', 'YonetimKategoriController@getKategoriler');


Route::get('yonetim/ziyaretciler', 'YonetimController@getZiyaretciler');
Route::post('yonetim/kategori-sil', 'YonetimKategoriController@postKategoriSil');
Route::post('yonetim/kategori-guncelle', 'YonetimKategoriController@postKategoriGuncelle');
Route::post('yonetim/kategori-guncelle-bitir', 'YonetimKategoriController@postKategoriGuncelleBitir');


/**
 * @mail send
 */
Route::get('yonetim/mail-gonder', 'YonetimMailController@getMailGonder');
Route::post('yonetim/mail-gonder', 'YonetimMailController@postMailGonder');

App::missing(function($exception)
{
    return Response::view('magaza.404', array(), 404);
});
