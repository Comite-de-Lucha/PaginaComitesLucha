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

function completarNoticias($json){
    var indice=0
    var tiempos=1;
    $($json.resultados).each(
        function() {
            var idDiv="#noticias_columna";
            if (indice%2===0){
                idDiv=idDiv+"1";
            }else{
                idDiv=idDiv+"2";
            }
            var noticia=$("#ejemplo_noticia").clone();
            noticia.find(".url_noticia").attr("href", "/noticias/obtener.php?id=" + this.noticia_id );
            noticia.find(".imagen_noticia").attr("src", this.url_imagen);
            noticia.find(".titulo_noticia").html(this.titulo);
            noticia.find(".subtitulo_noticia").html(this.subtitulo);
            noticia.addClass("wow animated fadeInUp");
            noticia.attr("data-wow-delay", "."+tiempos+"s");
            noticia.css("display", "");
            noticia.attr("id", "noticia"+this.noticia_id)
            $(idDiv).append(noticia);
            indice = indice+1;
            tiempos = tiempos+1;
            $("#ejemplo_noticia").css("display", "none");
        });
}

function cargarMasNoticias($this){
    var offset= parseInt($($this).attr("offset"));
    $.ajax({
        url: '/php/noticias/list.php',
        data: { limit: 12, offset: offset },
        success: function (data) {
            var json = $.parseJSON(data);
            completarNoticias(json);
            offset = offset+12;
            if (json.total>offset){
                $("#cargarMas").css("display", "")
                $($this).attr("offset", offset);
            }else{
                $("#cargarMas").css("display", "none");
            }
        },
        error: function () {
            console.log('There was some error performing the news AJAX call!');
        }
    });
}

function completarLuchadores($json){
    var indice=0
    var tiempos=1;
    $($json.resultados).each(
        function() {
            var idDiv="#noticias_columna";
            if (indice%3===0){
                idDiv=idDiv+"1";
            }else if (indice%3===1){
                idDiv=idDiv+"2";
            }else{
                idDiv=idDiv+"3";
            }
            var noticia=$("#ejemplo_noticia").clone();
            noticia.find(".url_noticia").attr("href", "/luchadores/obtener.php?id=" + this.noticia_id );
            noticia.find(".imagen_noticia").attr("src", this.url_imagen);
            noticia.find(".titulo_noticia").html(this.titulo);
            noticia.find(".subtitulo_noticia").html(this.subtitulo);
            noticia.addClass("wow animated fadeInUp");
            noticia.attr("data-wow-delay", "."+tiempos+"s");
            noticia.css("display", "");
            noticia.attr("id", "noticia"+this.noticia_id)
            $(idDiv).append(noticia);
            indice = indice+1;
            tiempos = tiempos+1;
            $("#ejemplo_noticia").css("display", "none");
        });
}

function categoriaSeleccionada(categoria){
    $("#"+categoria+"_noticias").closest(".btn").removeClass("animated4 btn-common");
    $("#"+categoria+"_noticias").closest(".btn").addClass("btn-raised btn-primary");
}