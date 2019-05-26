<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=App\User::create([
            'name'=>'Farid',
            'email'=>'fariddomat@outlook.com',
            'password'=>bcrypt('82446352'),
            'admin'=>1
        ]);

        App\Profile::create([
            'avatar'=>'uploads/avatars/avatar.png',
            'user_id'=>$user->id,
            'about'=>'Lorem ipsum text',
            'facebook'=>'facebook.com/fariddomat',
            'youtube'=>'youtube.com/fariddomat'
        ]);
    }
}
