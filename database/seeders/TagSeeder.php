<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //? Nos creamos un array de etiquetas: 
        $tags = [
            'Acción' => "#FF0000", // Rojo
            'Aventura' => "#FFA500", // Naranja
            'Comedia' => "#FFFF00", // Amarillo
            'Drama' => "#0000FF", // Azul
            'Terror' => "#800080", // Púrpura
            'Ciencia Ficción' => "#00FF00", // Verde
        ];

        //todo Recorremos el foreach y creamos los tag mediante el nombre y el color.

        foreach($tags as $nombre => $color){
            Tag::create(compact('nombre' , 'color'));
        }





    }
}
