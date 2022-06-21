$(document).ready(function() {
    $.ajax({
        url: '/php/publicacion/list.php',
        data: { limit: 5, offset: (findGetParameter("pagina") - 1) * 5 },
        success: function(data) {
            var json = $.parseJSON(data);
            $(json.resultados).each(
                function() {
                    $('#lista_examinar > tbody').append(
                        '<tr><td>' + 
                        this.categoria +
                        '</td><td>' +
                        this.fecha +
                        '</td><td class="text-center">' +
                        '<span class="clickeable material-icons" onClick="editar(' + this.publicacion_id + ')">edit</span>' +
                        '</td><td class="text-center">' +
                        '<span class="clickeable material-icons" onClick="eliminar(' + this.publicacion_id + ')">delete</span>' +
                        '</td></tr>')
                });
            calcularPaginacion(json.total, findGetParameter("pagina"), '/admon/actualidad.html?');

        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });
    $('#fecha_publicacion').datetimepicker({timepicker:false, format:'Y/m/d'});

});

function agregarNuevapublicacion() {
    $("#editar").css("display", "");
    $("#editar").attr("idPublicacion", "");
    $("#fecha_publicacion").val("");
    $("option:selected").removeAttr("selected");
    $("#problema_creando_publicacion").css("display", "none");

}

function cambiarInstrucciones($this){
    $("#instrucciones_fb").css("display", "none");
    $("#instrucciones_tw").css("display", "none");
    $("#instrucciones_yt").css("display", "none");
    $("#instrucciones_tt").css("display", "none");
    if ($($this).val()==="facebook"){
        $("#instrucciones_fb").css("display", "");
    }
   else if ($($this).val()==="twitter"){
        $("#instrucciones_tw").css("display", "");
    }
   else if ($($this).val()==="youtube"){
        $("#instrucciones_yt").css("display", "");
    }
    else if ($($this).val()==="tiktok"){
        $("#instrucciones_tt").css("display", "");
    }

}
function cambiarVistaPrevia($this){
    $("#vista_previa").html($($this).val());
}

function guardarPublicacion() {
    var data = new FormData();
    data.append('fecha_publicacion', $("#fecha_publicacion").val());
    data.append('categoria_publicacion', $("#publicacion_categoria").val());
    data.append('codigo_publicacion', $("#codigo_publicacion").val());
    data.append('id', $("#editar").attr("idPublicacion"));

    $.ajax({
        url: '/php/publicacion/post.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            if (data === "ok") {
                $("#enlace_redes")[0].click();
            } else if (data.includes("location")) {
                var json = $.parseJSON(data);
                if (json.location) {
                    window.location.href = json.location;
                };
            } else {
                $("#problema_creando_publicacion").css("display", "");
                console.log(data);
            }
        },
        error: function() {
            $("#problema_creando_publicacion").css("display", "");
            console.log('There was some error performing the AJAX call!');
        }
    });
}

function editar(id) {
    agregarNuevapublicacion();
    $.ajax({
        url: '/php/publicacion/get.php',
        data: { id: id },
        success: function(data) {
            var json = $.parseJSON(data);
            $("#editar").attr("idPublicacion", json.publicacion_id);
            $('#publicacion_categoria option[value="'+json.categoria+'"]').attr("selected", "selected");
            $('#codigo_publicacion').val(json.codigo);
            $("#fecha_publicacion").val(json.fecha);
            $("#vista_previa").html(json.codigo);
        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });

}

function eliminar(id) {
    $.ajax({
        url: '/php/publicacion/delete.php',
        data: { id: id },
        success: function(data) {
            if (data === "ok") {
                $("#enlace_redes")[0].click();
            } else if (data.includes("location")) {
                var json = $.parseJSON(data);
                if (json.location) {
                    window.location.href = json.location;
                };
            } else {
                console.log('There was some error deleting entity');
                console.log(data);
            }
        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });

}