<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);




        $this -> call(TagSeeder::class); //? esta línea ejecutará el método run() de la clase TagSeeder.
        Storage::deleteDirectory('films'); //! Borra la carpeta films
        Storage::makeDirectory('films'); //*  Si el directorio ya existe, no se realizará ninguna acción, pero si no existe, se creará.

         // Llama al seeder de Film.
         $this -> call(FilmSeeder::class);

    }
}
