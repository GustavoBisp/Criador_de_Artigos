var botao = document.querySelector('button');
var email = document.querySelector('#email');
var senha = document.querySelector('#senha');


//verificar se os inputs não estão vazios,para habilitar o botão
function verificar() {
    if (email.value != "" && senha.value != "") {
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