<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>@yield('title')</title>
</head>
<body>
    <header>
    <nav>
        <a class="link" id="logar" href="login">Logar</a>
        <a class="link" href="cadastro">Cadastrar</a>
        <a class="link" href="">Sobre</a>
    </nav>
    </header>
    <main>
        @yield('sucesso')
        @yield('formulario')
    </main>
    <footer></footer>
</body>
<script src="js/formulario.js"></script>
@yield('javascript')
</html>