<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run() {
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Robert',
            'surname'     => 'Kubisiak',
            'login' => 'admin',
            'email'    => 'robert.kubisiak8@gmail.com',
            'password' => Hash::make('awesome'),
        ));
    }
}