<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\producto;
use App\Model\user;
use Illuminate\Database\Eloquent\Scope;     //cosas del token
use Illuminate\Support\Facades\DB;
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
                return response()->json(["Productos"=>$guardproductos],201);
            return response()->json(null,400);
        }abort(401,"PermisosDenegados");
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