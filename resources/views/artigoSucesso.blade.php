@extends('templates/header')
@section('usuario',session('name'))

@section('email',session('email'))
@section('conteudo')
<h1 id="artigoSucesso">Artigo criado com sucesso</h1>
@endsection