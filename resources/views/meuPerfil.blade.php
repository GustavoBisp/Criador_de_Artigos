@extends('templates/header')

@section('title','Perfil')
@section('css')
<link rel="stylesheet" href="css/perfil.css">
@endsection
@section('usuario',session('name'))

@section('email',session('email'))
@section('conteudo')
<div id="infos">
  <div id="info">
          <div><img id="img" src="storage/imagens/{{$usuario->foto}}"></div>
   <form method='POST'  enctype="multipart/form-data">
   @csrf
            <input type="file" id="arquivo"  name="arquivo">
            <button id="atualizar" name="btn">Atualizar</button>
   </form>
 </div>
<div id="user">
        <span>Nome:{{$usuario->name}} </span><br><br>
        <span>Email:{{$usuario->email}} </span><br><br>
        <span>Bio:@if(!isset($bio)) (bio vazia) @endif </span><br><br><br>
        <form id="sairr" method="POST">
        <button name="editar" id="editar">Editar perfil</button><br><br>
        <div id="projetos">
        <h2 id="mes">Meus artigos</h2>
        @foreach($artigo as $artigos)
        @if($artigos->idAutor==$usuario->id)
        <div class=artigos onClick=clicou({{$artigos->id}})>
        <div class=titulo><h2>{{$artigos->titulo}}</h2></div>
        <div class=subtitulo><h4>{{mb_strimwidth($artigos->subtitulo, 0, 120, "...")}}</h4></div>
        <div class=autor><h4 class=a>{{$artigos->autor}}</h4></div><br>
        <img id="foto"  src="storage/imagens/{{$usuario->foto}}">
        <div class=data><h4>{{date('d/m/Y', strtotime($artigos->created_at))}}</h4></div>
        </div>
        <br>
        @endif
        @endforeach
        </form>
</div>

@endsection
@section('javascript')
   <script>
    function clicou(id){
    
     localStorage.setItem('idArtigo',id);
     
     window.location.href="artigo";
    }
</script>
  

@endsection