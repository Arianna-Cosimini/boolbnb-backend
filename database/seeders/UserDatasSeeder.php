<?php

namespace Database\Seeders;

use App\Models\User_datas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user_datas = [
            [

                "name" => 'Gian Marco',
                "surname" => 'Pimentel',
                "birth_date" => '1996/12/11',
                "photo" => "",

            ],
            [

                "name" => 'Vincenzo',
                "surname" => 'Sergi',
                "birth_date" => '1996/12/11',
                "photo" => "",

            ],
            [

                "name" => 'Arianna',
                "surname" => 'Cosimini',
                "birth_date" => '1996/12/11',
                "photo" => "",

            ],
            [

                "name" => 'Federico',
                "surname" => 'Di Bitonto',
                "birth_date" => '1996/12/11',
                "photo" => "",

            ],

        ];
        
        foreach($user_datas as $user_data) {
            $newUser_data = new User_datas();

            $newUser_data->name = $user_data['name'];
            $newUser_data->surname = $user_data['surname'];
            $newUser_data->birth_date = $user_data['birth_date'];

            $newUser_data->save();
        }
    }
}
