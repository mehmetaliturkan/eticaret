<?php

$etiket = 'eticaret.maturkan.com';
//print_r($etiket);

$dizi = array();
$dizin = "images/magaza/urunler";
$ac = opendir($dizin);
while ($x = readdir($ac)) {
    if ($x != "." && $x != "..") {
        $dizi[] = $x;
    }
}
sort($dizi);

// Bu kodlar dönüştürme işlemi uzun sürdüğü zaman serverın işleminizi iptal etmesini geciktiren kodlardır.
set_time_limit(10);
ini_set('max_execution_time', 1000); // Buradaki 1000sn yi istediğiniz kadar uzatabilirsiniz. Ben 500 resim için 1.5dk bekledim. Fazla fazla süre verdim. Aksi halde işleminiz yarıda kalır 160 tanesini yaparsınız ve işleminiz kesilir. Resim işleme uzun bir süreçtir Unutmayın.


foreach ($dizi as $x => $y) {
    //echo $x.") ".$etiket[$x]." - ".$y."<br>";
    $font = './verdanab.ttf'; //klasörümüe kopyaladigimiz boldlu font dosyasi
    $kaynak = "a/" . $y; // resimleri alacagimiz dizin
    $resim = imagecreatefromjpeg($kaynak); //GD kodu ile resmimizi Ramde olusturuyoruz

    $yeniresim = imagecreatetruecolor(803, 862); //GD kodu ile Daha büyük bir resim olusturuyoruz
    //kullanacagimiz renkleri tanimliyoruz
    $beyaz = imagecolorallocate($yeniresim, 255, 255, 255);
    $gri = imagecolorallocate($yeniresim, 128, 128, 128);
    $siyah = imagecolorallocate($yeniresim, 0, 0, 0);
    //arkaplan rengimizi beyaz yapiyoruz
    imagefill($yeniresim, 0, 0, $beyaz);

    //yeni olusturdugumuz beyaz resim ile kaynaktan aldigimiz resimi birlestiriyoruz.
    //bu kodda resim yukaridan 94px bosluktan sonra ekrana yerlestirilmistir. En sondaki 2 deger resimin genislik ve yükseklik degerleridir.
    //
 imagecopyresampled($yeniresim, $resim, 0, 94, 0, 0, 803, 768, 803, 768);

    //yazilarin bulundugu diziden $etiket[$x] içinde bulunan yazidaki türkçe karakterleri UTF-8 yapiyoruz.
    $yazi = iconv("iso-8859-9", "utf-8", $etiket); //türkçe karakter sorunu çözüldü
    //bu bir hizalama fonksiyonu, uzun aramalar sonucu denk geldim. Yazinizi ortalamak için kullabilirsiniz.
    hizala($yeniresim, 40, 0, 0, 63, $gri, $font, $yazi, $alignment = 'C');
    hizala($yeniresim, 40, 0, 0, 60, $siyah, $font, $yazi, $alignment = 'C');

    //Resminize yaziyi da ekledikten sonra artik bir yerlere kaydetmelisiniz. 
    //b/$y dedigimiz b dizininde $y ismiyle kaydedilecek bu resim.
    imagejpeg($yeniresim, "b/$y", 100);
}
closedir($ac);

//yazıyı ortaya Hizalamak için bir fonksiyon. 

function hizala($image, $size, $angle, $x, $y, $color, $font, $text, $alignment = 'C') {
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
    imagettftext($image, $size, $angle, $x + 400, $y, $color, $font, $text);
}
