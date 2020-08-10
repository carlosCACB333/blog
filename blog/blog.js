document.getElementById('foto').addEventListener('change', function() {
    var info = document.getElementById('foto').files;
    var ruta = URL.createObjectURL(info[0]);
    document.getElementById('previsualizar').src = ruta;

    $('#salir').css('display', 'block');

});

$('#seleccionar').click(function() {
    $('#foto').click();
})


$('#salir').click(function() {
    document.getElementById('previsualizar').src = '';
    $('#salir').css('display', 'none');

})

document.getElementById('perfil').addEventListener('click', function() {
    $('#selector_foto').click();

})

document.getElementById('selector_foto').addEventListener('change', function() {
    var info = document.getElementById('selector_foto').files;
    var ruta = URL.createObjectURL(info[0]);
    document.getElementById('perfil').src = ruta;


});

$('#datos').click(function() {
    $('#desplegar form').slideToggle(300);
});

document.getElementById('actualizar').addEventListener('submit', function() {
    var nombre = $("#desplegar input[type='text']").val().trim().length;
    var email = $("#desplegar input[type='email']").val().trim().length;
    var clave = $("#desplegar input[type='password']").val().trim().length;


    if (nombre === 0 || email === 0 || clave === 0) {
        return false;



    } else {
        return true;
    }
})