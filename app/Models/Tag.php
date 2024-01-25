<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

    protected $fillable = ['nombre' , 'color']; //? Definimos los atributos que se puede rellenar, modificar eliminar etc...

    use HasFactory;


    //* Al ser una relacion N:M un tag puede esta definida en muchas films, por lo tanto tengo que utilizar el BelongsToMany

    //* Este método define la relación de muchos a muchos (N:M)
     //* entre las tablas tags y films.

    public function films():BelongsToMany{
        return $this -> belongsToMany(Film::class);
    }



}
