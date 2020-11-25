<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\perfil;
use App\Model\user;
use Illuminate\Support\Facades\Hash;        //permite Hashear las contraseñas

use Illuminate\Database\Eloquent\Scope;     //cosas del token

use Illuminate\Support\Facades\Storage;     //hacer la referencia a la libreria storage

use Illuminate\Support\Facades\Mail;        //cosa para correo
use App\Mail\envioVerificacionCorreo;       //referencia al archivo para el correo
use App\Mail\informacionActualizada;        //referencia al correo con actualizaciones al admon

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
        //creacion del usuario (previamente creado el perfil)
    public function saveUsuario(Request $request,$numPer=null)
    {
        if($request->hasFile('file')) { //verifica si hay un archivo
            if($numPer)//verifica la entrada de la persona
            {
                $buscarPerfil = DB::table('perfiles')->where('numPer',$numPer)->first();

                $guardusuario=new user();
                $guardusuario->username=$request->username;
                $guardusuario->password=Hash::make($request->password);
                $guardusuario->email=$buscarPerfil->email;
                $guardusuario->id_perfil=$buscarPerfil->id;
                if($guardusuario->save())
                {                     
                    //renombrar el archivo \/
                    $path=Storage::putFileAs('documentosUsuarios/imagenesUsuario',$request->file,$guardusuario->id.".png");
           
                    echo response()->json(["SubidaLocal"=>$path],201);
                    return response()->json(["Usuario"=>$guardusuario],201);
                }
                return response()->json(["error guardando el perfil/imagen"],460);
            }else{
                return response()->json(["No existe el usuario/Usuario invalido"],466);
            }
        }else {
            return response()->json(['que esperabas al no agregar un archivo? que se subiera?',
            'pues error mi loco, dele pa fuera'],456);
        }
    }

        //informacion siendo usuario normal
        public function verPerfilUsuarioInfo(Request $request)
        {
            if($request->user()->tokenCan('UsuarioNormal') || $request->user()->tokenCan('UsuarioAdmon')){
                $infoBasicaUsuario=[
                    'nombre'=>$request->user()['username'],
                    'email'=>$request->user()['email'],
                ]; 
                return response()->json(["Tu Perfil"=> $infoBasicaUsuario],200);
            }abort(401,"PermisosDenegados");
        }

        
        //imagen
        public function verPerfilUsuarioImg(Request $request)
        {
            if($request->user()->tokenCan('UsuarioNormal') || $request->user()->tokenCan('UsuarioAdmon'))
                $imagen ="documentosUsuarios/imagenesUsuario/".$request->user()['id_perfil'].".png";
                return Storage::download($imagen);
            abort(401,"PermisosDenegados");
        }



        public function actualizarUsuario(Request $request)
        {
            if($request->user()->tokenCan('UsuarioNormal') || $request->user()->tokenCan('UsuarioAdmon'))
                {
                $id=$request->user()['id'];

                $guardUser=new user();
                $guardUser=user::find($id)->first();
                $guardUser->username=$request->username;
                if($request->hasFile('file')){ //verifica si hay un archivo
                    Storage::putFileAs('documentosUsuarios/imagenesUsuario',$request->file,$id.".png");
                    $accion="actualizacion de nombre de usuario e imagen de usuario";
                    echo "Imagen cambiada";
                }else {
                    $accion="actualizacion de nombre de usuario";
                }
                if($guardUser->update())
                {
                $username=$request->user()['username'];
                $email=$request->user()['email'];
    
                $informacionActalizada=[
                    'username'=>$username,
                    'email'=>$email,
                    'proceso'=>"actualizacion de usuario",
                    'accion'=>$accion 
                ];
                Mail::to('brayan_itai@hotmail.com')
                ->send(new informacionActualizada($informacionActalizada));

                        return response()->json(["userActualizado"=>$guardUser],201);
                    }return response()->json(["No se ha actualizado el usuario",304]);
            }abort(401,"PermisosDenegados");
        }
    





        public function plantillaToken(Request $request)
        {
            if($request->user()->tokenCan('UsuarioNormal'))
            {
                //codigo
            }abort(401,"PermisosDenegados");
        }













    public function pruebaTemporal(Request $request)
    {
        $datosUsuCorreo=[
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'email'=>$request->email,
            'numPer'=>$request->numPer,
            'direccionTxT'=>"/api/saveUsuario/{$request->numPer}/NuevoUsuario",
            'direccionUrl'=>url("/api/saveUsuario/{$request->numPer}/NuevoUsuario")
        ];
        //$mail=Mail::to($guardpersonas->email)
                //->send(new envioVerificacionCorreo($datosUsuCorreo));

        return response()->json(["PruebaTmp"=>$datosUsuCorreo],201);
    }








    public function editPersonas(Request $request, $id)
    {
        if ($id){
        $guardpersonas=new user();
        $guardpersonas=user::find($id);

        $guardpersonas->nomUsuario=$request->nomUsuario;
        $guardpersonas->contrasena=$request->contrasena;

        if($guardpersonas->update())
            return response()->json(["Personas"=>$guardpersonas],201);
        return response()->json(["No se ha efectuado la modificacion"],304);
    }else 
    {
        return response()->json(["Sin datos de entrada"],304);
    }
    }



    public function deletePersonas($id=null)
    {
        if ($id) 
        {        
        $guardpersonas=user::find($id);
        if($guardpersonas->delete())
            return response()->json(["Personas"=>user::all()],200);
        return response()->json(["Error en la eliminacion"],304);
        }else {
            return response()->json(["Sin datos de entrada"],304);
        }
    }






}