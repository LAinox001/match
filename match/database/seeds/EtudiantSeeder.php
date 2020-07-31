<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\Etudiant');

        for($i=0; $i<50; $i++){
            DB::table('etudiants')->insert([
                'nom' => $faker->lastName(),
                'prenom' => $faker->firstName(),
                'filliere_id' => rand(1, 5),
                'plat_id' => rand(1, 5),
                'couleur_id' => rand(1, 5),
                'animal_id' => rand(1, 4),
            ]);
        }
    }
}
