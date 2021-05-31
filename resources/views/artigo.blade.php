@extends('templates/header')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="../css/artigo.css">
@endsection
@section('usuario',session('name'))

@section('email',session('email'))

@section('conteudo')
<h1 id="carregar" style="margin-top:15%;margin-left:40%"></h1>
<div id="artigo">






</div>
<form method="POST" action="comentar">
@csrf

</form>


<div id="comentarios">

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
    id=localStorage.getItem('idArtigo');
    
    $.ajax({
      url:'artigos',
      type:'POST',
      data:{'id':id},
      beforeSend:function(){
        $('#carregar').html('Carregando artigo...');
      }
     }).then(function(response){
       $('#carregar').remove();
       var titulo="<h1 id=titulo>"+response['artigo']['titulo']+"</h1>";
       $("#artigo").append(titulo);
       var subtitulo="<h2>"+response['artigo']['subtitulo']+"</h2>";
       $("#artigo").append(subtitulo);
       var conteudo="<span style=overflow-wrap: break-word;>"+response['artigo']['conteudo']+"</span>";
       $("#artigo").append(conteudo);
       if(response['logado']==false){
        var icone="<i id=heart onClick=curtiu("+response['artigo']['id']+",{{session('id')}})  class='far fa-heart'></i><span id=curtidas>"+response['artigo']['curtidas']+"<span><hr>";
       }
       else{
        var icone="<i id=heartPreenche class='fas fa-heart'></i><span id=curtidas>"+response['artigo']['curtidas']+"<span><hr>"; 
       }
       $("#artigo").append(icone);
       var foto="<img id=foto style=cursor:pointer; onClick=clicou("+response['usuario']['id']+") src=storage/imagens/"+response['usuario']['foto']+" ><span id=name>"+response['usuario']['name']+"</span><br><br><br><br><hr>";
       $("#artigo").append(foto);
       var comentarios="<h2>Comentarios</h2><img id=foto src=storage/imagens/"+response['usuario']['foto']+"><input placeholder=Comentario name=comentario><button id=comentar>Comentar</button>";
       $("form").append(comentarios);
       for(coment of response['comentario']){
         for(user of response['comentarioUsuario']){
           if(coment['idComentou']==user['id']){
           var comentario="<div style=width:50%;height:100px;margin-left:27%><div style=width:90px;height:100px;float:left;><img src=storage/imagens/"+user['foto']+" style=border-radius:none;width:60px;height:60px;cursor:pointer; ></div><div style=width:670px;float:left<span>"+user['name']+"<br></span><span style=float:left;font-size:18px;margin-top:5px;>"+coment['comentario']+"</span></div></div><hr style=width:760px;margin-left:27%><br>";
           $("#comentarios").append(comentario);
           }
         }
       }
     }).catch(function(error){
        console.log(error);
     });
   });


   function curtiu(idArtigo,idCurtiu){
     $('#heart').attr('class','fas fa-heart');
     $('#heart').css('color','red');
     $.ajax({
       url:"{{URL::route('curtida')}}",
       type:'POST',
       data:{'idArtigo':idArtigo,'idCurtiu':idCurtiu}
     }).then(function(response){
         console.log(response);
     }).catch(function(error){
        console.log(error);
     });
}
function clicou(idUsuario){
  localStorage.setItem('idUsuario',idUsuario);
  window.location.href="perfil";
}
 
</script>

@endsection