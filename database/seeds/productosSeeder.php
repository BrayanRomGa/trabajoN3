<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class productosSeeder extends Seeder
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
            DB::table('productos')->insert(array(
                'nombreProducto'=>$faker->userName,
                'precio'=>$faker->randomFloat($nbMaxDecimals=2,$min=0.1,$max=1000)
            ));
        }
    }
}
