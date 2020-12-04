<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\producto;
use App\Model\user;
use Illuminate\Database\Eloquent\Scope;     //cosas del token
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Mail;        //cosa para correo
use App\Mail\informacionActualizada;        //referencia al correo con actualizaciones al admon

class ProductoController extends Controller
{

    //listado de los productos
    public function showProductos($id=null){
        if($id)
           return response()->json(["producto"=>producto::find($id)],200);
        return response()->json(["productos"=>producto::all()],200);
    }

    //creacion de los productos
    public function saveProductos(Request $request){
        if($request->user()->tokenCan('UsuarioAdmon')){

            $guardproductos=new producto();
            $guardproductos->nombreProducto=$request->nombreProducto;
            $guardproductos->precio=$request->precio;

            if($guardproductos->save())


            $productoEnviado="El producto : ".$request->nombreProducto." Se ha vendido a un precio de : ".$request->precio;


            $username=$request->user()['username'];
            $email=$request->user()['email'];
            $accion="";

            $informacionActalizada=[
                'username'=>$username,
                'email'=>$email,
                'proceso'=>"Insercion de un producto nuevo",
                'accion'=>$productoEnviado 
            ];
            Mail::to('brayan_itai@hotmail.com')
            ->send(new informacionActualizada($informacionActalizada));



                return response()->json(["Productos"=>$guardproductos],201);
            return response()->json(null,400);

        }elseif ($request->user()->tokenCan('UsuarioNormal')) {


            
            $username=$request->user()['username'];
            $email=$request->user()['email'];
            $accion="A causa de permisos insuficientes( Permisos Administrativos)";

            $informacionActalizada=[
                'username'=>$username,
                'email'=>$email,
                'proceso'=>"intento fallido de insercion de productos nuevos",
                'accion'=>$accion 
            ];
            Mail::to('brayan_itai@hotmail.com')
            ->send(new informacionActualizada($informacionActalizada));

        }else {
            abort(401,"PermisosDenegados");
            } 
    }



        //edicion de los productos
    public function editProductos(Request $request, $id){
        if($request->user()->tokenCan('UsuarioAdmon')){

        $guardproductos=new producto();
        $guardproductos=producto::find($id);

        $guardproductos->nombreProducto = $request->nombreProducto;
        $guardproductos->precio = $request->precio;

        if($guardproductos->update())
            return response()->json(["Productos"=>$guardproductos],201);
        return response()->json([null,400]);
    }abort(401,"PermisosDenegados");
}

        //eliminacion de los productos
    public function deleteProductos(Request $request, $id=null){
        if($request->user()->tokenCan('UsuarioAdmon')){

        $guardproductos=new producto();          
        $guardproductos=producto::find($id);
        if($guardproductos->delete())
            return response()->json(["Productos"=>producto::all()],200);
        return response()->json([null,400]);
    }abort(401,"PermisosDenegados");
    }





    
}