
@extends('templates/principal')

@section('title','Cadastro')

@section('formulario')
<form method="POST">
            @csrf
            <div id="fusuario" class="form">
            <div class="icone"><i class="fas fa-user"></i></div>
            <div class="input"><input maxlength="30"  onkeyup="verificar()" id="usuario" name="name" value="{{old('name')}}" placeholder="Nome de usuario" type="text"></div><br>
            </div>
            @error('name')
            <span class="erro" style="margin-left:-25px">{{$message}}</span>
            @enderror
            <div id="femail" class="form">
            <div class="icone"><i class="fas fa-envelope"></i></div>
            <div class="input"><input  onkeyup="verificar()" id="email" name="email" value="{{old('email')}}" placeholder="Email"></div><br>
            </div>
            @error('email')
            <span class="erro" style="margin-left:-25px">{{$message}}</span>
            @enderror
            <div id="fsenha" class="form">
            <div class="icone"><i class="fas fa-lock"></i></div>
            <div class="input"><input onkeyup="verificar()" id="senha" name="senha" placeholder="Senha" type="password"></div><i id="eye1" onClick="alternar()" class="fa fa-eye-slash"></i><br>
            </div>
            <div id="fsenha" class="form">
            <div class="icone"><i class="fas fa-lock"></i></div>
            <div class="input"><input onkeyup="verificar()" id="csenha" name="csenha" placeholder="Confirmar senha" type="password"></div><i onClick="alternar2()" id="eye2" class="fa fa-eye-slash"></i><br>
            </div>
            <span class="erro" id="erro1"></span>
            <button id="btnCadastro" name="cadastrar" disabled onClick="validar(event)">Cadastrar</button>
       
</form>
@endsection
@section('javascript')
<script src="js/cadastro.js"></script>
@endsection
