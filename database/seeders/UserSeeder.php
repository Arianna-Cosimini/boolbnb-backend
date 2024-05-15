<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'Gian Marco',
                'surname' => 'Pimentel',
                'email' => 'gian@gmail.com',
                'photo' => '',
                'birth_date' => '1996/12/11',
                'password' => '$2y$10$XoHFKD0.f4e83Cb.HPemcea1M13wrqV12cq0Yt8cLCSk4OO96lt4e',
                // pass=>12345678

            ],
            [

                'name' => 'Vincenzo',
                'surname' => 'Sergi',
                'email' => 'vin@gmail.com',
                'photo' => '',
                'birth_date' => '1996/12/11',
                'password' => '$2y$10$XoHFKD0.f4e83Cb.HPemcea1M13wrqV12cq0Yt8cLCSk4OO96lt4e',
                // pass=>12345678

            ],
            [

                'name' => 'Arianna',
                'surname' => 'Cosimini',
                'email' => 'ari@gmail.com',
                'photo' => '',
                'birth_date' => '1996/12/11',
                'password' => '$2y$10$XoHFKD0.f4e83Cb.HPemcea1M13wrqV12cq0Yt8cLCSk4OO96lt4e',
                // pass=>12345678

            ],
            [

                'name' => 'Federico',
                'surname' => 'Dibitonto',
                'email' => 'fe@gmail.com',
                'photo' => '',
                'birth_date' => '1996/12/11',
                'password' => '$2y$10$XoHFKD0.f4e83Cb.HPemcea1M13wrqV12cq0Yt8cLCSk4OO96lt4e',
                // pass=>12345678

            ],

        ];
        
        foreach($users as $user) {
            $newUser = new User();

            $newUser->name = $user['name'];
            $newUser->surname = $user['surname'];
            $newUser->email = $user['email'];
            $newUser->photo = $user['photo'];
            $newUser->birth_date = $user['birth_date'];
            $newUser->password = $user['password'];

            $newUser->save();
        } 
    }
}
