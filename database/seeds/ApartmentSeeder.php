<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table users is empty
        if(DB::table('apartments')->count() == 0){

            DB::table('apartments')->insert([

                [
                    'apartment_id' => 'ODEN1002',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'ODEN1003',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'ODEN1101',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'ODEN1102',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'ODEN1201',                    
                    'password' => bcrypt('12345678'),
                    
                ],

                [
                    'apartment_id' => 'ODEN1202',                    
                    'password' => bcrypt('12345678'),
                    
                ],

                [
                    'apartment_id' => 'ODEN1203',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1001',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1002',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'ODEN1103',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1003',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1101',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1102',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1103',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1201',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1202',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                [
                    'apartment_id' => 'SMED1203',                    
                    'password' => bcrypt('12345678'),
                    
                ],
                
                

            ]);
            
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    
    }
}
