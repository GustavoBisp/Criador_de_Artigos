@extends('templates/header')

@section('title',"Home")
@section('usuario',session('name'))

@section('email',session('email'))

@section('conteudo')
  <h1>Artigos recentes</h1>
  <div id="artigos">
  @foreach($artigo as $artigos)
    @foreach($usuario as $usuarios)
     @if($usuarios->id==$artigos->idAutor)
    <div class=artigos onClick="clicou({{$artigos->id}})">
          <div class=titulo><h2 id="titulo">{{$artigos->titulo}}</h2></div>
          <div class=subtitulo><h4>{{mb_strimwidth($artigos->subtitulo, 0, 120, "...")}}</h4></div>
          <div class=autor><h4 class=a>{{$artigos->autor}}</h4></div><br>
          <img id="foto"  src="storage/imagens/{{$usuarios->foto}}">
          <div class=data><h4>{{date('d/m/Y', strtotime($artigos->created_at))}}</h4></div>
          </div>
       <br>
     </div>
    @endif
   @endforeach
  @endforeach
@endsection

@section('javascript')
   <script>
    function clicou(id){
      var titulo=document.querySelector('#titulo');
      var titulo=titulo.innerText.replace( /\s/g, '' )
     localStorage.setItem('idArtigo',id);
     
     window.location.href="artigo";
    }
</script>
  

@endsection