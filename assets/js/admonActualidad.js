$(document).ready(function() {
    $.ajax({
        url: '/php/actualidad/list.php',
        data: { limit: 5, offset: (findGetParameter("pagina") - 1) * 5 },
        success: function(data) {
            var json = $.parseJSON(data);
            $(json.resultados).each(
                function() {
                    $('#lista_examinar > tbody').append(
                        '<tr><td>' + 
                        this.categoria +
                        '</td><td>' +
                        this.titulo +
                        '</td><td>' +
                        this.fecha +
                        '</td><td>' +
                        recortar(this.descripcion, 200) +
                        '</td><td class="text-center">' +
                        '<span class="clickeable material-icons" onClick="editar(' + this.actualidad_id + ')">edit</span>' +
                        '</td><td class="text-center">' +
                        '<span class="clickeable material-icons" onClick="eliminar(' + this.actualidad_id + ')">delete</span>' +
                        '</td></tr>')
                });
            calcularPaginacion(json.total, findGetParameter("pagina"), '/admon/actualidad.html?');

        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });

    $('#descripcion_noticia').summernote({
        placeholder: 'Describir la noticia, puede agregar imágenes y videos.',
        tabsize: 2,
        height: 200,
        callbacks: {
            onPaste(e) {
                const bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            },
            onImageUpload: function(image) {
                editor = $(this);
                subirImagen(image[0], editor);
            }
        }
    });
    $('#fecha_noticia').datetimepicker({timepicker:false, format:'Y/m/d'});

});

function agregarNuevaNoticia() {
    $("#editar").css("display", "");
    $("#editar").attr("idActualidad", "");
    $("#fecha_noticia").val("");
    $("#noticia-titulo").val("");
    $("#noticia-autor").val("");
    $("option:selected").removeAttr("selected");
    $('#descripcion_noticia').summernote('code', '');
    $("#image_file_noticia").html('');
    $("#problema_creando_noticia").css("display", "none");
    var json = new Object();
    json.titulo = "Título";
    json.subtitulo = "Subtítulo";
    json.boton = 'Encuentra más Información';
    json.url_imagen = '';
    completarNoticia(json, 0);
    document.getElementById('editar').scrollIntoView(true);
}

function cambiarValorImagen($this) {
    var files = !!$this.files ? $this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    if (/^image/.test(files[0].type)) { // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function() { // set image data as background of div
            $("#noticia-imagen-0").attr("src",this.result);
        }
    }
}

function cambiarValorInput($this, id) {
    $("#" + id).html($($this).val());
}

function guardarNoticia() {
    var data = new FormData();
    data.append('imagen_noticia', $('#image_file_noticia').prop('files')[0]);
    data.append('titulo_noticia', $("#noticia-titulo").val());
    data.append('autor_noticia', $("#noticia-autor").val());
    data.append('fecha_noticia', $("#fecha_noticia").val());
    data.append('categoria_noticia', $("#noticia_categoria").val());
    data.append('descripcion_noticia', $("#descripcion_noticia").val());
    data.append('publicacion_noticia', $("#codigo_publicacion").val());
    data.append('id', $("#editar").attr("idActualidad"));
    $("#spinner_guardar").css("display", "");
    
    $.ajax({
        url: '/php/actualidad/post.php',
        method: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#spinner_guardar").css("display", "none");
            var json = $.parseJSON(data);
            if (json.resultado === "ok") {
                window.location.href = json.publicacion;
            } else if (json.includes("location")) {  
                var json = $.parseJSON(data);
                if (json.location) {
                    window.location.href = json.location;
                };
            } else {
                $("#problema_creando_noticia").css("display", "");
                console.log(data);
            }
        },
        error: function() {
            $("#spinner_guardar").css("display", "none");
            $("#problema_creando_noticia").css("display", "");
            console.log('There was some error performing the AJAX call!');
        }
    });
}

function editar(id) {
    agregarNuevaNoticia();
    $.ajax({
        url: '/php/actualidad/get.php',
        data: { id: id },
        success: function(data) {
            var json = $.parseJSON(data);
            $("#editar").attr("idActualidad", json.actualidad_id);
            $("#noticia-titulo").val(json.titulo);
            $("#noticia-autor").val(json.autor);
            $('#noticia_categoria option[value="'+json.categoria+'"]').attr("selected", "selected");
            $('#descripcion_noticia').summernote('code', json.descripcion);
            $("#fecha_noticia").val(json.fecha);
            completarActualidad(json, 0);
        },
        error: function() {
            console.log('There was some error performing the AJAX call!');
        }
    });

}

function completarActualidad(info, indice) {
    $("#noticia-titulo-" + indice).html(info["titulo"]);
    $("#noticia-autor-" + indice).html(info["autor"]);
    $("#noticia-imagen-" + indice).attr("src", info["url_imagen"]);
}

function eliminar(id) {
    $.ajax({
        url: '/php/actualidad/delete.php',
        data: { id: id },
        success: function(data) {
            if (data === "ok") {
                $("#enlace_actualidad")[0].click();
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