@extends('templates/header')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/perfilUsuario.css">
@endsection

@section('usuario',session('name'))

@section('email',session('email'))

@section('conteudo')
<div id="infoUsuarios"> 

</div>
<div id="infoArtigos">

</div>

@endsection

@section('javascript')
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>

<script>
    $.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
    });
    $(document).ready(function(){
       var idUsuario= localStorage.getItem('idUsuario');
      $.ajax({
       url:'/pegarPerfil',
       type:'POST',
       data:{'idUsuario':idUsuario}
      }).then(function(response){
        if(!response['usuario']['bio']){
          response['usuario']['bio']="";
        }
        var user="<div><img id=img src=storage/imagens/"+response['usuario']['foto']+"><h2>"+response['usuario']['name']+"</h2>"+response['usuario']['bio']+"</div>";
        $('#infoUsuarios').append(user);
        if(response['usuario']['id']!="{{session('id')}}"){
          if(response['seguindo']==false){
          var botao="<button  name=seguir  onClick=seguir('"+response['usuario']['email']+"',"+response['usuario']['id']+") id=seguir>Seguir</button>"
          }
          else{
            var botao="<button  name=seguindo  id=seguindo>Seguindo</button>"
          }
        }
        for(artigo of response['artigos']){
        var data=artigo['created_at'].substr(0,10);  
        
        var artigos="<div onClick=clicou("+artigo['id']+") class=artigos><div class=titulo><h2>"+artigo['titulo']+"</h2></div><div class=subtitulo><h4>"+artigo['subtitulo']+"</h4></div><div class=autor><img src=storage/imagens/"+response['usuario']['foto']+"><h4 class=a>"+response['usuario']['name']+"</h4><br><div class=data><h4>"+data+"</h4></div></div></div><br>";
        $('#infoArtigos').append(artigos);
      }
        $('#infoUsuarios').append(botao);
      }).catch(function(error){
        console.log(error);
      });
    });
      
    function seguir(usuario,idSeguidor){ 
      alert("você está seguindo "+usuario+"");
      localStorage.setItem('idSeguidor',idSeguidor);
      window.location.href="seguir";
    }
    function clicou(id){
    
    localStorage.setItem('idArtigo',id);
    
    window.location.href="artigo";
   }
</script>


@endsection

