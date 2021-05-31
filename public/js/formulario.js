var icone1 = document.querySelector('#eye1');
var icone2 = document.querySelector('#eye2');

//função para alternar o exibir senha da input senha
function alternar() {
    if (icone1.getAttribute('class') != "fa fa-eye-slash") {
        icone1.setAttribute('class', 'fa fa-eye-slash');
        senha.setAttribute('type', "password");
    }
    else {
        icone1.setAttribute('class', 'fas fa-eye');
        senha.setAttribute('type', "text");
    }
}

//função para alternar o exibir senha da input csenha
function alternar2() {
    if (icone2.getAttribute('class') != "fa fa-eye-slash") {
        icone2.setAttribute('class', 'fa fa-eye-slash');
        csenha.setAttribute('type', "password");
    }
    else {
        icone2.setAttribute('class', 'fas fa-eye');
        csenha.setAttribute('type', "text");
    }
}