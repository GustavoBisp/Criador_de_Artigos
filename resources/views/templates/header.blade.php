<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    @yield('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>@yield('title')</title>
</head>
<body>
<header>
    <nav>
        <div id='lista'>
            <a id='home' class="link" href='../Home'>Home</a>
            <a id='criar' class="link" href='../criar'>Criar</a>
            
            <div id='perfil' class="link" href='../perfil'>@yield('usuario')<br><span>@yield('email')</span>
            <div id="opcoes">
                <br>
            <a id="meuperfil" class="op" href="../meuPerfil">Meu Perfil</a><br>
            <a id="deslogar" class="op" href="logout"><i class="fas fa-sign-out-alt"></i>Sair</a>
            </div>
</div>
        </div>
    </nav>
</header>
<main>
  @yield('conteudo')
</main>
</body>
@yield('javascript')
</html>