<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class comentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 
            DB::table('comentarios')->insert(array(
                'comentario'=>$faker->text($maxNbChars=30),
                'id_user'=>$faker->numberBetween($min=1,$max=20),
                'id_producto'=>$faker->numberBetween($min=1,$max=20)
            ));
        }
    }
}
