<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
   
    public function showLoginForm(){
       
        if(Auth::check()===true){
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home(){
        return view('admin.dashboard');
    }

    public function login(Request $request){

        // validando se existe algum campo vazio
        if(in_array('',$request->only('email','password'))){
            $json['message']= $this->message->error('ops, informe os dados para efetuar o login')->render();
            return response()->json($json);
        }
         //   validando se o email é valido, FILTER_VALIDATE_EMAIL ja é nativo php

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json['message']= $this->message->error('ops, informe email válido')->render();
            return response()->json($json);
        }

    
        // validando dados no banco de dados
        if(!Auth::attempt(['email' => $request->email,'password' => $request->password])){
            $json['message']= $this->message->error('ops, dados não conferem')->render();
            return response()->json($json);
        }

        // apos todas as confirmacoes, alimentando uma variavel em json 
        $json['redirect'] = route('admin.home');
        return response()->json($json);
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
