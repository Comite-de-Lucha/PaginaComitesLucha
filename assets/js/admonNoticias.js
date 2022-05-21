$(document).ready(function() {
    $('#descripcion_noticia').summernote({
        placeholder: 'Describir la noticia, puede agregar imágenes y videos.',
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
    $('#fecha_noticia').datetimepicker({timepicker:false, format:'Y/m/d'});

});

function agregarNuevaNoticia() {
    $("#editar").css("display", "");
    $("#editar").removeAttr("idNoticia");
}

function cambiarValorImagen($this) {
    var files = !!$this.files ? $this.files : [];
    console.log(files.length);
    console.log(window.FileReader);
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    console.log("2");
    if (/^image/.test(files[0].type)) { // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function() { // set image data as background of div
            //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
            $("#cursos-eventos-imagen-0").css("background-image", "url(" + this.result + ")");
        }
        console.log("3");
    }
}