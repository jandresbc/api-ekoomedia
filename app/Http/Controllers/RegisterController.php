<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registros;

class RegisterController extends Controller
{
    //
    public function getData(Request $request){
        return Registros::all();
    }

    public function register(Request $request){
        $nick = explode("@",$request["email"]);

        $val = Registros::where("nickname",$nick)->exists();

        if(!$val){
            $registro = Registros::create([
                "nombres"=>$request["nombres"],
                "email"=>$request["email"],
                "celular"=>$request["celular"],
                "edad"=>$request["edad"],
                "nickname"=>$nick[0]
            ]);

            return response()->json([
                "code"=>200,
                "data"=>$registro,
                "mensaje"=>"Registro realizado exitosamente"
            ],200);
        }else{
            return response()->json([
                "code"=>500,
                "data"=>[],
                "mensaje"=>"Error el nickname ya se encuentra registrado"
            ]);
        }
    }
}
