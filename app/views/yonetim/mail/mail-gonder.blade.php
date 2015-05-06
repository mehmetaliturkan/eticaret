
@extends('yonetim.sablon.sablon')
@section('title')
<title>E-Mail gönderme </title>
@stop
@section('container')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            E-Mail gönderme
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Yonetim</a></li>
            <li class="active">E-Mail gönderme</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='col-lg-10'>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Yeni e-mail gönderme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="mail-gonder" method="post">

                    <div class="box-body">
                        
                        <span class="col-lg-offset-5 text-success text-maroon"> {{$errors->first('mail')}}</span>
                        
                        <div class="form-group">
                            <label for="">E-Mail adresini sec</label>
                            <select name="kime" class="form-control" >
                                <option value="">Gönderilecek E-Mail adresini sec</option>
                                <option value='hepsi'>Herkese gönder</option>
                                @foreach($mail_adresler as $mail_adres)
                                <option value='{{$mail_adres->email}}' >{{$mail_adres->email}}</option>
                                @endforeach
                            </select>
                            <span class="text-warning"> {{$errors->first('kime')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">E-Mail kategorisi</label>
                             <select name="kategori" class="form-control" >
                                <option value="Magaza icerik">Magaza icerik</option>
                                <option value='Mağaza sipariş'>Mağaza siparis</option>
                                <option value='Mağaza üyelik'>Mağaza üyelik</option>
                                <option value='Sipariş kargo'>Sipariş kargo</option>
                                <option value='Şikayetiniz hakkında'>Şikayet hakkında</option>
                            </select>
                            <span class="text-warning"> {{$errors->first('kategori')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="">E-Mail konusu</label>
                            <input type="text" name='konu' class="form-control" id=""value="{{Input::old('konu') ? Input::old('konu'):"";}}" placeholder="E-mail konusu giriniz!"/>
                            <span class="text-warning"> {{$errors->first('konu')}}</span>
                        </div>

                        <div class="form-group">

                            <label for="">Mail ile gönderilecek mesaj</label>
                            <textarea type="text"name='mesaj' class="form-control"value="{{Input::old('mesaj') ? Input::old('mesaj'):"";}}"  rows="4"id="" placeholder="E-Mail Mesaj yazınız!"> </textarea>
                            <span class="text-warning"> {{$errors->first('mesaj')}}</span>
                        </div>
                        <div class="form-group">
                            <label>Veritabanına kayıt alınsın mı?</label>
                            <select name="kayit" class="form-control">
                                <option value='1'>Evet</option>
                                <option value='0' >Hayır</option>    
                            </select>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Mail gönder</button>
                    </div>
                </form>
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@stop