@extends('templates/header')
@section('css')
<link rel="stylesheet" href="css/criar.css">
@endsection
@section('usuario',session('name'))

@section('email',session('email'))
@section('conteudo')
<div id="main">
    <div id="criarr">
    <form method="POST">
    @csrf
    <input   name="titulo" maxlength="50" placeholder="Titulo do Artigo" id="titulo">
    @error('titulo')
     <br><span class="erro">{{$message}}</span>
    @enderror
    <br>
    
    <input   name="subtitulo" placeholder="Subtitulo do Artigo" id="subtitulo"><br>
    @error('subtitulo')
     <span class="erro">{{$message}}</span>
    @enderror
    <br><br>
    <textarea id="conteudo" name="conteudo"  cols="1" rows="20" placeholder="Conteudo do artigo" ></textarea><br>
    @error('conteudo')
     <span class="erro">{{$message}}</span>
    @enderror
    <br><button  name="btn" id="btn">Criar</button>
    </form>
</div>
</div>
@endsection

@section('javascript')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea#conteudo',width:800,plugins: 'advlist link image lists'});</script>
@endsection