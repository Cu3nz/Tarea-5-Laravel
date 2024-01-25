<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::orderBy('id', 'desc') -> paginate(5); //? Almaceno en $films todas las peliculas ordenadas por id de forma descendenet y paginando de 5 en 5
        return view('films.index' , compact('films')); //? Le paso a la vista todos los objetos de pelicula, por lo tanto en la vista puedo hacer $fimls -> nombre
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $tags = Tag::select('id' , 'nombre') -> orderBy('nombre') -> get();
        return view('films.create' , compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request -> validate([
            'titulo' => ['required' , 'string' , 'min:3' , 'unique:films,titulo'],
            'descripcion' => ['required' , 'string' , 'min:5'],
            'imagen' => ['nullable' , 'image' , 'max:2048'],
            'tags' => ['required' , 'array' ,  'exists:tags,id']
        ]);

        //* Una vez que hemos pasado las validaciones, me creo el objeto de pelicula

        $films = Film::create([
            'titulo' => ucfirst($request -> titulo),
            'descripcion' => ucfirst($request -> descripcion),
            //? Valido que se suba una imagen que se hace con esto ($request -> imagen).
            //? Si se ha subido, la imagen ahora valdra lo que ha subido el usuario
            //! Si no, ponemos la imagen por defecto cuando no se sube ninguna imagen 
            'imagen' => ($request -> imagen) ? $request -> imagen -> store('films') : 'noimage.jpg'
        ]);
         // Le asignamos los tags seleccionados al film que hemos creado.
         $films -> tags() -> attach($request -> tags);
         return redirect() -> route('films.index') -> with('mensaje' , "Pelicula " .  $request -> titulo . " añadida correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        //
        return view('films.info' , compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        //? Devolvemos la vista con el objeto de pelicula, para poder acceder a todos sus atributos

        // Almacena en la variable $filmTags los tags del film
        // a través de la función devolverFilmTagsId().
        $filmTags = $film -> devolverFilmTagsId();
        // Almacena en la variable $tags el id y el nombre de los tags
        // ordenados por id en orden descendente y los obtiene con get.
        $tags = Tag::select('id' , 'nombre') -> orderBy('id' , 'desc') -> get();

        return view('films.update' , compact('film' , 'tags' , 'filmTags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        //
        $request -> validate([
            'titulo' => ['required' , 'string' , 'min:3' , 'unique:films,titulo,' . $film -> id],
            'descripcion' => ['required' , 'string' , 'min:5'],
            'imagen' => ['nullable' , 'image' , 'max:2048'],
            'tags' => ['required' , 'array' ,  'exists:tags,id']
        ]);

        //? Guardamos la imagen actual del film en $imagen.
        $imagen = $film -> imagen; 

        if ($request -> imagen){ //? Si hemos subido una imagen 

            if (basename($request -> imagen) != 'noimagen.jpg'){ //? Verificamos que si es distinta a la default la borramos

                Storage::delete($film -> imagen); //! borramos la imagen actual del film
            }

            $imagen = $request -> imagen -> store('films');

        }

        $film -> update([

            'titulo' => ucfirst($request -> titulo),
            'descripcion' => ucfirst($request -> descripcion),
           //? imagen, vale la nueva imagen que se ha subido.
            'imagen' => $imagen

        ]);

         // Le quita al film todas los tags que tenga y le añade 
        // los que haya marcados tras la actualización del film.
        $film -> tags() -> sync($request -> tags); 

        

        return redirect() -> route('films.index') -> with('mensaje' , "Pelicula " . $film -> titulo ." actualizada correctamente");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //


        //? Si la foto es distinta a la default, la borramos
        if (basename($film -> imagen) != 'noimage.jpg'){
            Storage::delete($film -> imagen); //* Borramos la foto
        }

        //* Borramos todo el objeto

        $film -> delete();

        return redirect() -> route('films.index') -> with('mensaje' , "Pelicula " . $film -> titulo . " borrada correctamente");

    }
}
