<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('UserTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('yonetim')->delete();

        Yonetim::create(array(
            'user_id' => 'admin',
            'email' => 'mehmetaliturkan@gmail.com',
            'password' => md5('123'),
            'seviye' => 0,
            'first_name' => 'mehmetali',
            'last_name' => 'turkan'
        ));
    }

}
