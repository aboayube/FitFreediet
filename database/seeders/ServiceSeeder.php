<?php

namespace Database\Seeders;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name'=>'اشتراك مجاني',
            'consulted'=>'3',
            'type'=>'مجاني',
            'benefits'=>'تحصل علي خدمات عدية',
            'price'=>0,
            'day'=>3,
        ]);
        Service::create([
            'name'=>'اشتراك اسبوعي',
            'consulted'=>'30',
            'type'=>'اسبوع',
            'benefits'=>'تحصل علي خدمات عدية',
            'price'=>10,
            'day'=>7,
        ]);
        Service::create([
            'name'=>'اشتراك شهري',
            'consulted'=>'30',
            'type'=>'شهري',
            'benefits'=>'تحصل علي خدمات عدية',
            'price'=>30,
            'day'=>30,
        ]);
    }
}
