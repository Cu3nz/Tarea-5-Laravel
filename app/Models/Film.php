<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    protected $fillable = ['titulo' , 'descripcion' , 'imagen'];

    use HasFactory;

    //* Al ser una relacion de N:M un film, cuantas tag puede tener? mas de uno.

        //*Este método define la relación de muchos a muchos
        //* entre las tablas films y tags

    public function tags():BelongsToMany{
        return $this -> belongsToMany(Tag::class);
    }

    // ?Devolvemos todos los id de las etiquetas (tag) de un film en forma de array.

    public function devolverFilmTagsId():array{

        $tagFilm = [];

        //? Recorremos los tags que tiene el film 

        foreach ($this -> tags as $item) {
            
            $tagFilm[] = ($item -> id);  //? Almaceno en $tagFilm la id de cada uno de los tags de ese film
        }
        return $tagFilm;
    }

}
