<?php

/**
 * Yonetın urun kontroller
 */
class YonetimMailController extends BaseController {

    /**
     * getIndex Method
     */
    public function getMailGonder() {

        $mail_adresler = User::all();

        return View::make('yonetim/mail/mail-gonder')->with('mail_adresler', $mail_adresler);
    }

    /**
     * 
     * @Urun ekleme post istegı olursa
     * 
     * 
     */
    public function postMailGonder() {
        /**
         * Kategoride bulunan tum verılerı al ve gonder
         */
        $rules = array(
            'mesaj' => 'required|min:3',
            'kime' => 'required|min:5|max:255',
            'kategori' => 'required');

        /**
         * sartlar saglanıyor mu 
         */
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            /**
             * sartlarda sıkıntı varsa
             */
            return Redirect::to('yonetim/mail-gonder')->withErrors($validator)->withInput();
        } else {

            if (Input::get('kime') == 'hepsi') {


                /**
                 * mail gonderme işlemi
                 */
                $bilgi = array('gonderen' => Session::get('yonetim_user_id'),
                    'mesaj' => Input::get('mesaj'),
                );
                $too = DB::table('users')->lists('email');
                foreach ($too AS $person) {

                    if (Input::get('kayit') == 1) {

                        $mail = new Mailler;

                        $mail->gonderen_id = Session::get('yonetim_id');
                        $mail->kime = $person;
                        $mail->baslik = Input::get('kategori');
                        $mail->mesaj = Input::get('mesaj');
                        $mail->save();
                    }

                    Mail::send('emails.mail-gonder', $bilgi, function($message) use ($person) {
                        $message->from('mehmetaliturkan@gmail.com', Input::get('kategori'));
                        $message->to($person)->subject(Input::get('konu'));
                    });
                }
                $mail_adresler = User::all();
                return View::make('yonetim/mail/mail-gonder')->with('mail_adresler', $mail_adresler)
                                ->withErrors(array('mail' => 'Email gonderimi başarılı..'));
            } else {

                $bilgi = array('gonderen' => Session::get('yonetim_user_id'),
                    'mesaj' => Input::get('mesaj'),
                );
                Mail::send('emails.mail-gonder', $bilgi, function($message) {
                    $message->from('mehmetaliturkan@gmail.com', Input::get('kategori'));
                    $message->to(Input::get('kime'))->subject(Input::get('konu'));
                });
                if (Input::get('kayit') == 1) {

                    $mail = new Mailler;

                    $mail->gonderen_id = Session::get('yonetim_id');
                    $mail->kime = Input::get('kime');
                    $mail->baslik = Input::get('kategori');
                    $mail->mesaj = Input::get('mesaj');

                    if ($mail->save()) {
                        $mail_adresler = User::all();
                        return View::make('yonetim/mail/mail-gonder')
                                        ->with('mail_adresler', $mail_adresler)
                                        ->withErrors(array('mail' => 'Email gonderimi başarılı..'));
                    }
                }
                $mail_adresler = User::all();
                return View::make('yonetim/mail/mail-gonder')
                                ->with('mail_adresler', $mail_adresler)
                                ->withErrors(array('mail' => 'Email gonderimi başarılı..'));
            }
        }
    }

}
