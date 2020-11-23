<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $faker = Faker::create();
        for ($i=1; $i < 29; $i++) { 
            DB::table('users')->insert(array(
                'username'=>$faker->name,
                'email'=>$faker->unique()->email,
                'password'=>Hash::make("12345"),
                'id_perfil'=>$i
            ));
        }


    
    
    }
}
