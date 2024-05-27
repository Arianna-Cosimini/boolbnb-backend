<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $views = [
            [
                'ip_address' => '101.56.58.201',
                'apartment_id'=> '1',
                'created_at' =>   '2024-06-23',  
            ],
            [
                'ip_address' => '101.56.54.208',
                'apartment_id'=> '1',
                'created_at' =>   '2024-05-23',  
            ],
            [
                'ip_address' => '101.56.54.207',
                'apartment_id'=> '1',
                'created_at' =>   '2024-04-23',  
            ],
            [
                'ip_address' => '101.56.54.205',
                'apartment_id'=> '1',
                'created_at' =>   '2024-05-23',  
            ],
            [
                'ip_address' => '101.56.54.204',
                'apartment_id'=> '2',
                'created_at' =>   '2024-04-23',  
            ],
            [
                'ip_address' => '101.56.54.203',
                'apartment_id'=> '2',
                'created_at' =>   '2024-06-23',  
            ],
            [
                'ip_address' => '101.56.54.202',
                'apartment_id'=> '2',
                'created_at' =>   '2024-05-23',  
            ],
            [
                'ip_address' => '101.56.54.201',
                'apartment_id'=> '2',
                'created_at' =>   '2024-04-23',  
            ],
            [
                'ip_address' => '101.56.54.200',
                'apartment_id'=> '2',
                'created_at' =>   '2024-05-23',  
            ],
            [
                'ip_address' => '101.56.54.209',
                'apartment_id'=> '2',
                'created_at' =>   '2024-06-23',  
            ],
            
        ];

        foreach($views as $view) {
            View::create([
            'ip_address' => $view['ip_address'], 
            'apartment_id' => $view['apartment_id'],
            'created_at' => $view['created_at'],
            ]);
        }
    }
}
