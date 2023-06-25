<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Persona;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Provider\DateTime as DateTimeProvider;
use Faker\Provider\es_ES\Address as SpanishAddressProvider;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'administrador',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'rol' => 'G',
        ]);

        // User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create();
        $faker->addProvider(new SpanishAddressProvider($faker));
        
        $startDate = '1950-01-01';
        $endDate = '2005-12-31';

        

        for ($i=0; $i < 50; $i++) {

            $email = $faker->unique()->safeEmail;
            $randomTimestamp = mt_rand(strtotime($startDate), strtotime($endDate));
        ;
            User::factory()->create([ 'email' => $email, 'password' => 'Tecsup2023']);

            \DB::table('personas')->insert([
                'email'     => $email,
                'nombre'    => $faker->firstNameFemale,
                'apellido'  => $faker->lastName,
                'celular'   => $faker->numerify('9########'),
                'pais'      => $faker->country,
                'fecha_nac' =>$randomDate = date('Y-m-d',$randomTimestamp),
                'sexo'      => $faker->randomElement(['M','F']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        for ($i=0; $i < 50; $i++) {

            $email = $faker->unique()->safeEmail;
            $randomTimestamp = mt_rand(strtotime($startDate), strtotime($endDate));
            $usuario = 'Hotel '.$faker->lastName;
            
        ;
            User::factory()->create(['name' => $usuario ,'email' => $email, 'password' => 'Tecsup2023', 'rol' => 'M']);

            \DB::table('hotels')->insert([
                'id'        => $faker->numerify('11###########'),
                'email'     => $email,
                'titulo'    => $usuario,
                'pais'      => $faker->country,
                'ciudad'    => $faker->city,
                'direccion' => $faker->streetAddress,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
