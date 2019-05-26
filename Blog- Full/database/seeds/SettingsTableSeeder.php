<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Settings::create([
            'site_name'=>'My Blog',
            'contact_number'=>'00963934538775',
            'contact_email'=>'fariddomat@outlook.com',
            'address'=>'Syria, Homs, Kafarram'
        ]);
    }
}
