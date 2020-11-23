<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class perfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $faker = Faker::create();
        for ($i=0; $i < 30; $i++) { 
            DB::table('perfiles')->insert(array(
                'nombre'=>$faker->name,
                'apellido'=>$faker->lastName,
                'edad'=>$faker->numberBetween($min=18,$max=100),
                'email'=>$faker->unique()->email,
                'numPer'=>random_int($min="1000",$max=999999)
            ));
        }


    
    
    }
}
