<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
</body>
</html>
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script>
var idSeguidor=localStorage.getItem('idSeguidor');
$.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
    });
  $.ajax({
    url:'seguir',
    type:'POST',
    data:{'idSeguidor':idSeguidor}
  }).then(function(response){
      window.location.href="perfil";
  }).catch(function(error){
      console.log(error);
  });
</script>