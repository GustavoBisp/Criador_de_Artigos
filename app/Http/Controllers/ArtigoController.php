<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\curtidas;
use App\Models\Comentario;
use App\Models\Notificacao;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function criar(Request $request)
    {
        $request->validate([
         'titulo'=>'required',
         'subtitulo'=>'required',
         'conteudo'=>'required',
        ]);
        $autor=$request->session()->get('name');
        $idAutor=$request->session()->get('id');
        $data=[
            'titulo'=>$request->titulo,
            'subtitulo'=>$request->subtitulo,
            'conteudo'=>$request->conteudo,
            'autor'=>$autor,
            'idAutor'=>$idAutor,
            'curtidas'=>0
        ];
      
        Artigo::create($data);
       
        return view('artigoSucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function curtir(Artigo $artigo,curtidas $curtida,Request $request)
    {
        $artigo= Artigo::find($request->idArtigo);
        $new=($artigo->curtidas)+1;
        $data=[
          "curtidas"=>$new
        ];       
        $artigo->update($data);
        $data=[
            "idArtigo"=>$artigo->id,
            "idCurtiu"=>$request->idCurtiu,
        ];
        curtidas::create($data);
        $mensagem="Curtiu com sucesso";
        return response()->json(array("sucess"=>$mensagem),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function comentar(Artigo $artigo,Request $request,Comentario $comentario)
    {
        $request->validate([
            'comentario'=>'required'
        ]);
        $dados=[
        'idArtigo'=>session('idArtigo'),
        'idComentou'=>session('id'),
        'comentario'=>$request->comentario
        ];
        Comentario::create($dados);
        return redirect()->route('artigo');
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artigo $artigo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artigo $artigo)
    {
        //
    }
}
