<?php
namespace App\Http\Controllers\AUTH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\user;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Validation\ValidationException;       //este ese el el Accept 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validatos;
class authTokenController extends Controller
{
    
    //iniciar secion( registrar usuario normal)
    public function logIn(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user = user::where('email',$request->email)->first();
          if(!$user||!Hash::check($request->password,$user->password)){
            throw ValidationException::withMessages([      //ValidationException es el Accept en el header de insomnia
                'email|password'=>['Credenciales incorrectas..'],
            ]);
        }
        $token=$user->createToken($request->email,['UsuarioNormal'])->plainTextToken;
        return \response()->json(["UsuarioNormal"=>$token],201);
    }



    public function logInAdmon(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user = user::where('email',$request->email)->first();
          if(!$user||!Hash::check($request->password,$user->password)){
            throw ValidationException::withMessages([      //ValidationException es el Accept en el header de insomnia
                'email|password'=>['Credenciales incorrectas..'],
            ]);
        }

        $token=$user->createToken($request->email,['UsuarioNormal','UsuarioAdmon'])->plainTextToken;
        return \response()->json(["UsuarioAdmon"=>$token],201);
    }


    public function eliminarUsuarios()
    {

        
    }



    public function logOut(Request $request)
    {
        return response()->json(["afectados"=>$request->user()->tokens()->delete()],266);
    }
}
