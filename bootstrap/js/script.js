//define function para validar telefone
function validar_codigo_produto() {
    var codigo = document.getElementById("codigo");

    if(codigo.length > 15) {
        return false;
        alert("Numero de telefone invalido !!");
    }else {
        return true;
    }
}