<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Artigo;
use App\Models\Seguidores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seguir(Request $request,Seguidores $seguidores)
    {
        //
       $idSeguidor=$request->idSeguidor;
       $idSeguiu=session('id');
       $data=[
          'idSeguidor'=>$idSeguidor,
          'idSeguiu'=>$idSeguiu
       ];
       Seguidores::create($data);
       return redirect('perfil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastro(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:usuarios',
            'email' => 'required|unique:usuarios|email',
            'senha' => 'required'
        ]);
        $foto="padrao.webp";
        $senha=Crypt::encryptString($request->senha);
        $data=[
           "name"=>$request->name,
           "email"=>$request->email,
           "senha"=>$senha,
           "foto"=>$foto,
       ];
        Usuario::create($data);
        return view('sucessoCadastro');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function logar(Usuario $usuario,Request $request)
    {
        foreach($usuario->all() as $user){
         $senha=Crypt::decryptString($user->senha);
         if($user->email==$request->email && $senha==$request->senha){
            $request->session()->put('id',$user->id);
             $request->session()->put('email',$user->email);
             $request->session()->put('name',$user->name);
             return redirect()-> route('Home');
         }
        }
        $erro="Email ou senha inválidos";
        return view('login',["erro" => $erro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function atualizarFoto(Request $request,Usuario $usuario)
    {
     $request->validate([
        "arquivo"=>'required'
     ]);
        if($request->hasFile('arquivo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('arquivo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('arquivo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('arquivo')->storeAs('public/imagens', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.png';
        }
        $id=$request->session()->get('id');
        $usuario=Usuario::find($id);
        $data=[
            "foto"=>$fileNameToStore,
        ];
        $usuario->update($data);
        return redirect()->route('meuPerfil');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //
        Auth::logout();
        $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function pegarPerfil(Usuario $usuario,Request $request,Artigo $artigo,Seguidores $seguidores)
    {
       $seguindo=false;
       $seguidores=$seguidores->all();
       $usuario=Usuario::where('id',$request->idUsuario)->first();
       $artigos=Artigo::where('idAutor',$request->idUsuario)->get();
       foreach($seguidores as $seguidor){
           if($seguidor->idSeguidor==$request->idUsuario && $seguidor->idSeguiu==session('id')){
                $seguindo=true;
           }
       }
       return response()->json(array('usuario'=>$usuario,'artigos'=>$artigos,'seguindo'=>$seguindo),200);
    }
}
