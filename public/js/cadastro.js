var usuario = document.querySelector('#usuario');
var email = document.querySelector('#email');
var senha = document.querySelector('#senha');
var csenha = document.querySelector('#csenha');
var botao = document.querySelector('button');
var erro1 = document.querySelector('#erro1');

//verificar se os inputs não estão vazios,para habilitar o botão
function verificar() {
    if (csenha.value != "" && email.value != "" && senha.value != "" && usuario.value != "") {
        botao.style.backgroundColor = "#1E90FF";
        botao.style.cursor = "pointer";
        botao.disabled = false;
    }
    else {
        botao.style.backgroundColor = "black";
        botao.style.cursor = "not-allowed";
        botao.disabled = true;
    }
}

//validar dados
function validar(event) {
    if (csenha.value != senha.value) {
        erro1.innerHTML = "as senhas diferem";
        event.preventDefault();
    }
    else if (senha.value.length < 6) {
        erro1.innerHTML = "senha muito fraca";
        event.preventDefault();
    }
}