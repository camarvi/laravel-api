<?php

namespace App\Http\Controllers;

use App\Heroe;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function getAllHeroes(){
        $heroes = Heroe::get()->toJson(JSON_PRETTY_PRINT);
        return response($heroes, 200);
        
    }

    public function getHeroe($id){

        if (Heroe::where('id',$id)->exists()){
            $heroe = Heroe::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($heroe,200);
        } else {
            return response()->json([
                "message" =>"Heroe not found"
            ]);
        }
    }

    public function buscarHeroes($name){
        
        // $heroes = Heroe::where('nombre', 'LIKE', "%$nombre%")->get();
         if (Heroe::where('nombre', 'LIKE', "%$name%")->exists()){
             $heroes = Heroe::where('nombre', 'LIKE', "%$name%")->get()->toJson(JSON_PRETTY_PRINT);
             return response($heroes,200);
         }  else {
             return response()->json([
                 "message"=>"Heroes not found"
             ]);
         }  

    }

    public function createHeroe(Request $request){

        $heroe = new Heroe();
        $heroe->nombre = $request->nombre;
        $heroe->poder = $request->poder;
        $heroe->save();

        return response($heroe,201);
       // return response()->json([
       //     "message" => "Heroe Creado correctamenta"
       // ],201);

    }

    public function updateHeroe(Request $request, $id){

        if ( Heroe::where('id', $id)->exists() ){
            $heroe = Heroe::find($id);
            $heroe->nombre = is_null($request->nombre) ? $heroe->nombre : $request->nombre;
            $heroe->poder = is_null($request->poder) ? $heroe->poder : $request->poder;

            $heroe->save();

            return response($heroe,200);
           // return response()->json([
           //     "message" => "Heroe actualizado correctamente"
          //  ],200);
        } else {
            return response()->json([
                "message" => "Heroe no encontrado"
            ],404);
        }
    }

    public function deleteHeroe($id){

        if (Heroe::where('id', $id)->exists()){
            $heroe = Heroe::find($id);
            $heroe->delete();

            return response()->json([
                "message" => "Heroe eliminado"
            ],202);
        } else {
            return response()->json([
                "message" => "Heroe no encontado"
            ]);
        }
    }

}
