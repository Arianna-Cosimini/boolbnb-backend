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
            "name" => 'Gian Marco',
            "surname" => 'Pimentel',
            "birth_date" => '1996/12/11'

        ];
        
    }
}
