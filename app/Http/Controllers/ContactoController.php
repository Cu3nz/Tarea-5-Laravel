<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMaillabe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class ContactoController extends Controller
{
    //


    public function pintarFormulario(){

        return view('contactoform.formulario');

    }


    public function procesarFormulario(Request $request){


        $request -> validate([

            'nombre' => ['required' , 'string' , 'min:3'],
            'email' => ['required' , 'email'] , 
            'contenido' => ['required' , 'string' , 'min:10']
        ]);

        try {
            Mail::to("admin@gmail.com") -> send( new ContactoMaillabe(ucwords($request -> nombre) , $request -> email , ucfirst($request -> contenido)));
        } catch (\Exception $ex) {
            dd("Error" . $ex -> getMessage());
        }
        return redirect() -> route('home') -> with('mensaje' , "Se ha enviado el mensaje correctamente");

    }


}
