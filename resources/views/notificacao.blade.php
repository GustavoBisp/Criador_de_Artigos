@extends('templates/header')
@section('css')

@endsection
@section('usuario',session('name'))

@section('email',session('email'))

@section('conteudo')
@foreach($artigos as $artigo)
@foreach($seguidores as $seguidor)
@foreach($usuario as $usuarios)
 @if($artigo->idAutor==$seguidor->idSeguidor)
 @if($artigo->idAutor==$usuarios->id)
 <div class="artigos" onClick="clicou({{$artigo->id}})">
          <div class=titulo><h2 id="titulo">{{$artigo->titulo}}</h2></div>
          <div class=subtitulo><h4>{{mb_strimwidth($artigo->subtitulo, 0, 120, "...")}}</h4></div>
          <div class=autor><h4 class=a>{{$artigo->autor}}</h4></div><br>
          <img id="foto"  src="storage/imagens/{{$usuarios->foto}}">
          <div class=data><h4>{{date('d/m/Y', strtotime($artigo->created_at))}}</h4></div>
          </div>
       <br>
     </div>
     @endif
 @endif
 @endforeach
 @endforeach
@endforeach
@endsection
@section('javascript')

@endsection