<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Settings;
class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name'=>'fitfree',
            'discription'=>'fitfree',
            'logo'=>'fitfree',
            'email'=>'fitfree',
            'facebook'=>'fitfree',
            'twiter'=>'fitfree',
            'linked_in'=>'fitfree',
            'instagram'=>'fitfree',
            'whatsapp'=>'fitfree',
            'twiter'=>'fitfree',
        ]);
    }
}
