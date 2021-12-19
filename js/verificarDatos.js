function redirigirDatos(stringAction) {
    let formulario = document.getElementById('datos');
    formulario.action = stringAction;
    formulario.submit();
}