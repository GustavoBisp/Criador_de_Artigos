
@extends('templates/principal')

@section('title','Login')

@section('formulario')
<form method="POST">
        @csrf
        <div id="femail" class="form">
            <div class="icone"><i class="fas fa-envelope"></i></div>
            <div class="input"><input onkeyup="verificar()"  id="email" name="email" placeholder="Email"></div><br>
            </div><br>
            <div id="fsenha" class="form">
            <div class="icone"><i class="fas fa-lock"></i></div>
            <div class="input"><input onkeyup="verificar()"  id="senha" name="senha" placeholder="Senha" type="password"></div><i id="eye1" onClick="alternar()" class="fa fa-eye-slash"></i><br>
            </div><br>
            <span class="erro" id="erro1"></span>
            <span class="erro">{{$erro}}</span>
            <button id="btnLogin" name="cadastrar" disabled onClick="validar(event)">Logar</button>   
</form>
@endsection
@section('javascript')
<script src="js/login.js"></script>
@endsection