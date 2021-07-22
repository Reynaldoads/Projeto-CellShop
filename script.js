function slide() {
    var textos = document.querySelector('.sobre-2');
    textos.classList.add('textoAnimation');
}

function slideLateral() {
    var texto = document.querySelector('.info-loja');
    texto.classList.add('slideLateral');

}

function fechar() {
    var modal = document.getElementById("modal-imagem");
    modal.style.display = "none";
}
function abrir() {
    var modal = document.getElementById("modal-imagem");
    var foto = document.querySelector('.modal');
    foto.classList.add('modalAnimation');
    modal.style.display = "flex";
}