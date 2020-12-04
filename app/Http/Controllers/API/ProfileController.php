<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\perfil;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;   // referencia al email
use App\Mail\envioVerificacionCorreo;   //adjuntar el controlador del correo

class ProfileController extends Controller
{
    //creacion de nuevos perfiles
    public function saveProfile(Request $request){
        $guardpersonas=new perfil();
        $guardpersonas->nombre=$request->nombre;
        $guardpersonas->apellido=$request->apellido;
        $guardpersonas->edad=$request->edad;
        $guardpersonas->email=$request->email;
        $guardpersonas->numPer=random_int($min="1000",$max=999999);

        if($guardpersonas->save())
        {      
            
            
            //informacion para mandar al correo
            $datosUsuCorreo=[
                'nombre'=>$guardpersonas->nombre,
                'apellido'=>$guardpersonas->apellido,
                'email'=>$guardpersonas->email,

                'direccionUrl'=>url("/api/saveUsuario/{$guardpersonas->numPer}/NuevoUsuario")

            ];              //correo a comprobar/destino
            $mail=Mail::to($guardpersonas->email)
                    ->send(new envioVerificacionCorreo($datosUsuCorreo));


            return response()->json(["Mail"=>$mail,"Personas"=>$guardpersonas],201);

        }else {
            return response()->json(["Error en la creacion del perfil",
                                "Verifico que sea veridico el email?"],304);
    }   
}         










}