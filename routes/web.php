<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArtigoController;
use App\Models\Artigo;
use App\Models\Usuario;
use App\Models\curtidas;
use App\Models\Comentario;
use App\Models\Seguidores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('cadastro');
});

Route::get('/login',function(){
    return view('login',["erro" => ""]);
});

Route::get('/cadastro',function(){
    return view('cadastro',["erro1"=>"","erro2"=>""]);
});


Route::get('Home',function(Artigo $artigo,Usuario $usuario){
    return view('Home',['artigo'=>DB::table('artigos')->orderBy('created_at','desc')->take(100)->get(),'usuario'=>$usuario->all()]);
})->name('Home')->middleware('checarLogin');

Route::get('/criar',function(){
    return view('criar');
})->middleware('checarLogin');

Route::get('/meuPerfil',function(Usuario $usuario,Artigo $artigo){
    $usuario=Usuario::find(session('id'));
    $artigo=$artigo->all();
    return view('meuPerfil',['usuario'=>$usuario,"artigo"=>$artigo]);
})->name('meuPerfil')->middleware('checarLogin'); 

Route::post('/artigos',function(Request $request,Artigo $artigo,Usuario $usuario,curtidas $curtidas,Comentario $comentario){
  $request->session()->put('idArtigo',$request->id);
  $artigo = Artigo::find($request->id);
  $usuario=Usuario::find($artigo->idAutor);
  $existe=0;
  $curtidas=curtidas::all();
  foreach($curtidas as $curtida){
      if($curtida->idArtigo==$artigo->id && $curtida->idCurtiu==session('id')){
          $existe++;
      }
  }
  if($existe==0){
      $logado=false;
  }
  else{
      $logado=true;
  }
  $comentario=Comentario::where('idArtigo',$request->id)->get();
  $comentarioUsuario=$usuario->all();
  return response()->json(array('artigo'=>$artigo,'usuario'=>$usuario,'logado'=>$logado,'comentario'=>$comentario,'comentarioUsuario'=>$comentarioUsuario),200);
})->name('artigos')->middleware('checarLogin');

Route::get('/artigo',function(){
    return view('artigo');
})->name('artigo')->middleware('checarLogin');

Route::post('/meuPerfil',[UsuarioController::class,'atualizarFoto']);
Route::post('/cadastro',[UsuarioController::class, 'cadastro']);
Route::post('/login',[UsuarioController::class, 'logar']);
Route::post('/criar',[ArtigoController::class,'criar']);
Route::post('/curtida',[ArtigoController::class,'curtir'])->name('curtida');
Route::post('/comentar',[ArtigoController::class,'comentar'])->name('comentar');
Route::get('/logout',[UsuarioController::class,'logout'])->name('logout');
Route::get('/perfil',function(){
      return view('perfil');
})->name('perfil');
Route::post('/pegarPerfil',[UsuarioController::class,'pegarPerfil']);

Route::get('/seguir',function(){
    return view('seguir');
})->name('pegarPerfil');

Route::post('/seguir',[UsuarioController::class,'seguir']);

