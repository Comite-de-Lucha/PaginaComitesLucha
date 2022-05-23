function irAPaginaInterna(url) {
    location.href = url;
}

function calcularPaginacion(total, pagina_actual, href) {
    $("#paginacion").find("ul").html("");
    if (total > 5) {
        for (i = 1; i - 1 <= total / 5; i++) {
            if (i + '' === pagina_actual) {
                $("#paginacion").find("ul").append('<li class="page-item"><a href="#" class="page-link ">' + i + '</a></li>');
            } else {
                $("#paginacion").find("ul").append('<li class="page-item"><a href="' + href + 'pagina=' + i + '" class="page-link  bg-dark">' + i + '</a></li>');
            }

        }
        $("#paginacion").find(".pagination").removeClass("d-none");
    }
}
function recortar(texto, size) {
    if (texto.length > size) {
        texto = texto.substring(0, size);
        texto = texto + "...";
    }
    return texto;
}

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function(item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

function parsearParrafos(parrafos) {
    return parrafos.replaceAll("\n", "<br/>");
}

function parsearYoutubeID(enlace) {
    var result = null,
        tmp = [];
    enlace
        .replaceAll("https://www.youtube.com/watch?", '')
        .split("&")
        .forEach(function(item) {
            tmp = item.split("=");
            if (tmp[0] === "v") result = decodeURIComponent(tmp[1]);
        });
    return result;
}

function completarNoticia(noticia, indice) {
    $("#noticia-titulo-" + indice).html(noticia["titulo"]);
    if (noticia["subtitulo"].length>0){
        $("#noticia-subtitulo-" + indice).html(noticia["subtitulo"]);
    }else{
        $("#noticia-subtitulo-" + indice).html("");
    }
    if (noticia["boton"].length>0){
        $("#noticia-boton-" + indice).html(noticia["boton"]);
    }
    $("#noticia-imagen-" + indice).attr("src", noticia["url_imagen"]);
    $("#noticia-boton-" + indice).attr("onclick", "irAPaginaInterna('noticias/obtener.php?id=" + noticia["noticia_id"] + "')");

    $("#carrusel-"+indice).css("display", "");
}