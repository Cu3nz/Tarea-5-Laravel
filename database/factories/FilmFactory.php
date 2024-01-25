<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //? Definimos el picsum para las imagenes 
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        return [
            //? Generamos los registros

            'titulo' => fake() -> unique() -> words(random_int(1, 2), true),
            'descripcion' => fake() -> text(),
            'imagen' => 'films/'.fake()->picsum('public/storage/films', 640, 480, false) //? Definimos que se almacene en la base de datos como films/kgfjjkgkjfjkgjklfskjlgkjld.jpg y que ademas se va a almacenar en la siguiente ruta ("public/storage/films)
        ];
    }
}
