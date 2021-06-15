<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'nombre'=>'Juan Pablo Arrazola',
        'cargo'=>'admin',
        'email'=>'juanpabloarrazolas@gmail.com',
        'password'=>bcrypt('12345678'),
        ])->assignRole('Nutricionista');

       User::factory(9)->create();       
    }
}
