$(document).ready(function() {
    $.ajax({
        url: '/php/luchadores/list.php',
        data: { limit: 5, offset: (findGetParameter("pagina") - 1) * 5 },
        success: function(data) {
            var json = $.parseJSON(data);
            $(json.resultados).each(
                function() {
                    $('#lista_examinar > tbody').append(
                        '<tr><td>' +
                        parsearCategoriaLuchadores(this.categoria) +
                        '</td><td>' +
                        this.titulo +
                        '</td><td>' +
                        parsearPrioridad(this.prioridad) +
                        '</td><td>' +
                        this.fecha +
                        '</td><td>' +
                        recortar(this.descripcion, 200) +
                        '</td><td class="text-center">' +
                        '<span class="clickeable material-icons" onClick="editar(' + this.luchadores_id + ')">edit</span>' +
                        '</td><td class="text-center">' +
                        '<span class="clickeable material-icons" onClick="eliminar(' + this.luchadores_id + ')">delete</span>' +
                        '</td></tr>')
                });
            calcularPaginacion(json.total, findGetParameter("pagina"), '/admon/luchadores.html?');

        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });

    $('#descripcion_info').summernote({
        placeholder: 'Describir la información, puede agregar imágenes y videos.',
        tabsize: 2,
        height: 200,
        callbacks: {
            onPaste(e) {
                const bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        }
    });
    $('#fecha_info').datetimepicker({timepicker:false, format:'Y/m/d'});

});

function agregarNuevaInformacion() {
    $("#editar").css("display", "");
    $("#editar").attr("idluchadores", "");
    $("option:selected").removeAttr("selected");
    $("#prioridad_info").val('2')
    $("#fecha_info").val("");
    $("#info-titulo").val("");
    $("#info-subtitulo").val("");
    $('#descripcion_info').summernote('code', '');
    $("#image_file_info").html('');
    $("#problema_creando_info").css("display", "none");
    var json = new Object();
    json.titulo = "Título";
    json.subtitulo = "Subtítulo";
    json.url_imagen = '';
    completarLuchadores(json, 0);
    document.getElementById('editar').scrollIntoView(true);
}

function cambiarValorImagen($this) {
    var files = !!$this.files ? $this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    if (/^image/.test(files[0].type)) { // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function() { // set image data as background of div
            $("#info-imagen-0").attr("src",this.result);
        }
    }
}

function cambiarValorInput($this, id) {
    $("#" + id).html($($this).val());
}

function guardarinformacion() {
    var data = new FormData();
    data.append('imagen_info', $('#image_file_info').prop('files')[0]);
    data.append('categoria_info', $("#categoria_info").val().join(' '));
    data.append('prioridad_info', $("#prioridad_info").val());
    data.append('titulo_info', $("#info-titulo").val());
    data.append('subtitulo_info', $("#info-subtitulo").val());
    data.append('fecha_info', $("#fecha_info").val());
    data.append('descripcion_info', $("#descripcion_info").val());
    data.append('id', $("#editar").attr("idluchadores"));

    $.ajax({
        url: '/php/luchadores/post.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            var json = $.parseJSON(data);
            if (json.resultado === "ok") {
                window.location.href = json.publicacion;
            } else if (json.includes("location")) {  
                var json = $.parseJSON(data);
                if (json.location) {
                    window.location.href = json.location;
                };
            } else {
                $("#problema_creando_info").css("display", "");
                console.log(data);
            }
        },
        error: function() {
            $("#problema_creando_info").css("display", "");
            console.log('There was some error performing the AJAX call!');
        }
    });
}

function editar(id) {
    agregarNuevaInformacion();
    $.ajax({
        url: '/php/luchadores/get.php',
        data: { id: id },
        success: function(data) {
            var json = $.parseJSON(data);
            $("#editar").attr("idluchadores", json.luchadores_id);
            selectValuesCategoriaLuchadores(json.categoria);
            selectvaluePrioridad(json.prioridad);
            $("#info-titulo").val(json.titulo);
            $("#info-subtitulo").val(json.subtitulo);
            $('#descripcion_info').summernote('code', json.descripcion);
            $("#fecha_info").val(json.fecha);
            completarLuchadores(json, 0);
        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });

}

function eliminar(id) {
    $.ajax({
        url: '/php/luchadores/delete.php',
        data: { id: id },
        success: function(data) {
            if (data === "ok") {
                $("#enlace_luchadores")[0].click();
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

function parsearCategoriaLuchadores(texto){
    texto = texto.replace('arte', 'Arte para el pueblo,');
    texto = texto.replace('asambleas', 'Asambleas populares,');
    texto = texto.replace('regiones', 'Coordinación de regiones,');
    texto = texto.replace('primera_linea', 'Primera Linea,');
    texto = texto.replace('mujeres', 'Mujeres,');
    texto = texto.replace('etnias', 'Campesinos, indígenas y etnias,');
    return texto;
}

function parsearPrioridad(texto){
    if (texto=== 1){
        return "Alta";
    }
    if (texto=== 2){
        return "Media";
    }
    if (texto=== 3){
        return "Baja";
    }
}

function selectValuesCategoriaLuchadores(texto){
    var arrayTexto = texto.split(" ");
    $.each( arrayTexto, function( key, value ) {
        $('#categoria_info option[value="'+value+'"]').attr("selected", "selected");
      });
  
}

function selectvaluePrioridad(texto){
    $('#prioridad_info option[value="'+texto+'"]').attr("selected", "selected");
}

function completarLuchadores(info, indice) {
    $("#info-titulo-" + indice).html(info["titulo"]);
    if (info["subtitulo"].length>0){
        $("#info-subtitulo-" + indice).html(info["subtitulo"]);
    }else{
        $("#noticia-subtitulo-" + indice).html("");
    }
    
    $("#info-imagen-" + indice).attr("src", info["url_imagen"]);
}