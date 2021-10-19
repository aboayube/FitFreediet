<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'wajeeh',
            'email' => 'snuora2019@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => "admin",
            'email_verified_at'=>now(),
            'status' =>1,
            'mobile' =>'000000',
            'image' =>'profile.png',
            ]);
            $user = User::create([
                'name' => 'hanan',
                'email' => 'hanan2019@gmail.com',
                'password' => bcrypt('123123123'),
                'role' => "docotor",
                'email_verified_at'=>now(),
                'status' =>1,
                'mobile' =>'000000',
                'image' =>'profile.png',
                ]);

    }
}
