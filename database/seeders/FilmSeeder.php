<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //? Generamos 50 registros aleatorios para Film y lo guardamos en $film

       $films= Film::factory(50) -> create();

       //* Asignamos a cada film un numero aleatorio de tags 

       foreach($films as $item){
        $item -> tags() -> attach($this -> devolverIdTagRandom()); 
       }
    }

       //* Creamos la funcion devolverIdTagRandom privada, ya que no va a salir de esta clase 

       private function devolverIdTagRandom():array{

        $tags = []; //? Definimos un array vacia.


        $arrayTags = Tag::pluck('id')->toArray(); 
        //* Esta línea recoge todas las 'id' de los registros de la tabla 'tags' en la base de datos y las convierte en un array.

        //* La función 'pluck' es utilizada para obtener solo una columna (en este caso, 'id') de todos los registros en la tabla 'tags'.

        //* Esto significa que si tienes, por ejemplo, 12 registros (o tags) en tu tabla 'tags', 'pluck' recogerá los 12 IDs de estos registros.

        //* El método 'toArray()' convierte la colección resultante en un array simple de PHP y lo almacena en $arrayTags.

        //* El resultado será un array que contiene los IDs de todos los tags en orden. 
        //* Si tienes 12 tags con IDs del 1 al 12, el resultado será: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].

        //* Es importante recordar que en PHP, como en muchos otros lenguajes de programación, los arrays comienzan con el índice 0.
        //* Por lo tanto, el índice del array para el ID 4 será 3 (0 para el ID 1, 1 para el ID 2, 2 para el ID 3, y así sucesivamente).

        $arrayIndices = array_rand($arrayTags , random_int(2 , count($arrayTags))); //? Te metes dentro de arrayTags y me sacas un numero aleatorio, minimo 2 y como maximo el numero de indices que tiene el $arrayTags que en este caso son 12, entonces si el random_int devuelve 6, array_rand selecciona 6 indices aleatorios de $arrayTags.

        // todo  Esta línea selecciona una cantidad aleatoria de índices de elementos dentro del array $arrayTags.

        //? 'array_rand($array, $num)' es una función de PHP que toma dos parámetros: 
        //* 1. Un array del cual se quieren obtener índices aleatorios.
        //* 2. El número de índices aleatorios que se desean obtener. (que en este caso es un numero aleatorio, minimo 2 y maximo 12 en este caso que es el numero de indices que imprimira.)

        // todo  En este caso, el primer parámetro es $arrayTags, que ya sabemos que contiene los IDs de los tags.

        //? El segundo parámetro es el resultado de 'random_int(2, count($arrayTags))'. 
        //? Esta es una función de PHP que genera un número entero aleatorio entre dos valores dados.
        //? Aquí, genera un número aleatorio entre 2 y el número total de elementos en $arrayTags (12).

        // todo 'count($arrayTags)' cuenta el numero total de elementos en el array $arrayTags (12 de nuevoooooo son el numero de indices que tiene el array).

        // * Entonces, 'random_int(2, count($arrayTags))' devolverá un número aleatorio entre 2 y el total de tags en $arrayTags.
        //? Por ejemplo, si hay 12 tags, devolverá un número entre 2 y 12.

        //todo  El resultado de 'array_rand($arrayTags, random_int(2, count($arrayTags)))' será un array de índices seleccionados aleatoriamente de $arrayTags.
        //* El tamaño de este array estará determinado por el número generado por 'random_int'.
        // ? Por ejemplo, si 'random_int' devuelve 5, 'array_rand' seleccionará 5 índices aleatorios de $arrayTags.

        foreach ($arrayIndices as $indice) {
        
            $tags[] = $arrayTags[$indice]; //? Basicamente aqui lo que hago es lo siguiente: 
            //* Si $arrayIndices devuelve los siguientes indices:  2 , 4 , 8 , 3 , 6
            //* Nos metemos dentro del $arrayTags y cogemos el  id que esta en los indices que nos ha devuelto $arrayIndices. 
            //todo En este caso: 
            //$arrayTags = [1,2,3,4,5,6,7,8,9,10,11,12]. 
            //* el array $tag tendra el id [3 , 5 , 9 , 4 , 7].
            //? 3 porque esta en el indice 2 
            //? 5 porque esta en el indice 5 y asi sucesivamente.
    

            //todo mejor explicado: 

             // Este bloque de código recorre cada índice almacenado en $arrayIndices.

    // '$arrayIndices' contiene un conjunto de índices seleccionados aleatoriamente. 
    // Por ejemplo, si contiene [2, 4, 8, 3, 6], estos números son índices en el array $arrayTags.

    // En cada iteración del bucle 'foreach', '$indice' será uno de estos valores (2, 4, 8, 3, 6, etc.).

    // '$arrayTags[$indice]' accede al elemento en $arrayTags que está en la posición indicada por '$indice'.
    // Esto significa que estamos obteniendo el ID del tag que está en la posición '2', luego '4', y así sucesivamente en $arrayTags.

    // Estos IDs son añadidos al array $tags usando '$tags[] = ...'.
    // Esto crea o expande el array $tags, añadiendo cada nuevo ID obtenido de $arrayTags.

    // Siguiendo con el ejemplo dado, si $arrayTags es [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], y
    // $arrayIndices es [2, 4, 8, 3, 6], entonces los IDs obtenidos serán:
    // - $arrayTags[2], que es 3
    // - $arrayTags[4], que es 5
    // - $arrayTags[8], que es 9
    // - $arrayTags[3], que es 4
    // - $arrayTags[6], que es 7
    // Por lo tanto, $tags terminará siendo [3, 5, 9, 4, 7].
          }
          return $tags;
       }

}
