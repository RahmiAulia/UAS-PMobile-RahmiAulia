<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 4; $i++) {
            Pengguna::create([
                'nama' => $faker->name,
                'email' => $faker->email,
                'password' => 'abcde', 
                'alamat' => $faker->address,
                'no_telepon' => '08'.$faker->numerify(str_repeat('#', 7))
            ]);
        }
    }
}
