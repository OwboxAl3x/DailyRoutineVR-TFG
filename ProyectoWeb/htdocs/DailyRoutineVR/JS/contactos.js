$(document).ready(function() {
    $('#contactos').DataTable({
        "language": {
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas",
            "infoFiltered": "(filtrados de _MAX_ entradas en total)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se han encontrado resultados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});

$('#nuevo_contacto_ficha').on('click', function ()
{
    window.open("contacto-ficha.php");
});

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

function bajaContacto(id)
{
    $.post("../Views/contactos.php", {
        accion: 'baja',
        idContacto: id
    });

    sleep(1000);
    location.reload();
}

function altaContacto(id)
{
    $.post("../Views/contactos.php", {
        accion: 'alta',
        idContacto: id
    });

    sleep(1000);
    location.reload();
}