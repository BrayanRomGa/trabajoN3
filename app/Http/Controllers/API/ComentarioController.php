<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\comentario;
use App\Model\user;
use Illuminate\Database\Eloquent\Scope;     //cosas del token
use Illuminate\Support\Facades\Mail;        //cosa para correo
use Illuminate\Support\Facades\DB;
use App\Mail\informacionActualizada;        //referencia al correo con actualizaciones al admon

class ComentarioController extends Controller
{
    //mostrar comentarios
    public function ShowComentarios($id=null){
        if($id)
            return response()->json(["Comentario"=>comentario::find($id)],201);
        return response()->json(["Comentarios"=>comentario::all()],201);
    }

    //guardar comentarios
    public function saveComentarios(Request $request){
    if($request->user()->tokenCan('UsuarioNormal') || $request->user()->tokenCan('UsuarioAdmon')){
        
        $guardComentarios=new comentario();
        $guardComentarios->comentario=$request->comentario;
        $guardComentarios->id_user=$request->user()['id'];
        $guardComentarios->id_producto=$request->id_producto;

        if($guardComentarios->save()){

            $username=$request->user()['username'];
            $email=$request->user()['email'];

            $accion=$request->comentario;
            $informacionActalizada=[
                'username'=>$username,
                'email'=>$email,
                'proceso'=>"insercion de comentarios",
                'accion'=>$accion 
            ];
            Mail::to('brayan_itai@hotmail.com')                 //correo del administador
            ->send(new informacionActualizada($informacionActalizada));
            return response()->json(["Comentario"=>$guardComentarios],255);
        }else {

            $username=$request->user()['username'];
            $email=$request->user()['email'];

            $problema="Error en la generneracion del comentario";
            $infoProceso=[
                'username'=>$username,
                'email'=>$email,
                'problema'=>$problema
            ];
            Mail::to('brayan_itai@hotmail.com')
            ->send(new procesoFallido($infoProceso));
        return response()->json(["Error"=>$problema],406);
        }
    }abort(401,"PermisosDenegados");
}

    //editar comentario
    public function editComentarios(Request $request, $id){
        if($request->user()->tokenCan('UsuarioNormal') || $request->user()->tokenCan('UsuarioAdmon')){
            $guardComentarios=new comentario();
        $guardComentarios=comentario::find($id);

        $guardComentarios->comentario=$request->comentario;
        $guardComentarios->id_user=$request->user()['id'];
        $guardComentarios->id_producto=$request->id_producto;

        if($guardComentarios->update()){
            return response()->json(["Comentario"=>$guardComentarios],205);
        }else {
            
            $username=$request->user()['username'];
            $email=$request->user()['email'];

            $problema="Error en la edicion del comentario";
            $infoProceso=[
                'username'=>$username,
                'email'=>$email,
                'problema'=>$problema
            ];
            Mail::to('brayan_itai@hotmail.com')
            ->send(new procesoFallido($infoProceso));
        return response()->json(["Error"=>$problema],406);
        }
    }abort(401,"PermisosDenegados");
}
    //eliminar comentario
    public function deleteComentarios(Request $request, $id=null){
        if($request->user()->tokenCan('UsuarioAdmon')){
        $guardComentarios=new comentario();     //linea agregada de prueba
        $guardComentarios=comentario::find($id);
        if($guardComentarios->delete())
            return response()->json(["Comentario"=>comentario::all()],201);
        return response()->json([null,400]);
    }abort(401,"PermisosDenegados");
}
   





}