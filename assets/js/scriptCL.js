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

function completarActualidad(noticia, indice) {
    $("#actualidad-titulo-" + indice).html(noticia["titulo"]);
    $("#actualidad-autor-" + indice).html(noticia["autor"]);
    $("#actualidad-imagen-" + indice).attr("src", ""+noticia["url_imagen"]);
    $("#actualidad-urlaux-" + indice).attr("href", "actualidad/obtener.php?id=" + noticia["actualidad_id"]);
    $("#actualidad-url-" + indice).attr("href", "actualidad/obtener.php?id=" + noticia["actualidad_id"]);
}

function cargarInformacionLuchadores(info){
    var html = '<div class="col-md-3 col-sm-6 col-xs-12 no-padding mix '+info["categoria"]+'">'+
    '<figure class="single-portfolio">'+
        '<img class="img-responsive" style="height: 300px;" src="'+info["url_imagen"]+'" alt="">'+
        '<figcaption class="hover-content">'+
            '<a class="btn btn-round btn-fab btn-xs" href="luchadores/obtener.php?id='+info["luchadores_id"]+'">'+
            '<i class="material-icons">&#xE5C8;</i>'+
                '<div class="ripple-container"></div>'+
           '</a>'+
            '<a href="luchadores/obtener.php?id='+info["luchadores_id"]+'">'+
                '<h2 class="subtitle">'+info["titulo"]+'</h2>'+
            '</a>'+
            '<p>'+info["subtitulo"]+'</p>'+
        '</figcaption>'+
   '</figure>'+
    '</div>';
    return html;

}