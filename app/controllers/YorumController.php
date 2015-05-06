<?php

/**
 * 
 */
class YorumController extends BaseController {

    /**
     * 
     * @return yorum kayıt işlemi
     */
    public function postYorumYap() {

        $rules = array(
            'adiniz' => 'required',
            'email' => 'required',
            'yorum' => 'required',
        );

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);

        $link = Input::get('link') . '#reviews';

        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('urun/' . $link)->withErrors($validator)->withInput();
        } else {
            $yorumlar = new Yorumlar();

            $yorumlar->adiniz = Input::get('adiniz');
            $yorumlar->email = Input::get('email');
            $yorumlar->urunler_id = Input::get('urunler_id');

            $yorumlar->yorum = Input::get('yorum');
            $yorumlar->durum = 0;

            if ($yorumlar->save()) {

                return Redirect::to("urun/".$link)->with('sonuc','Yorumunuz başarılı birşekilde kaydedildi.');
            }
        }
    }

}
