<?php
//including the database connection file
include_once("../php/config/configbd.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$stmt = mysqli_prepare($mysqli, "SELECT categoria, count(*) as conteo FROM actualidad WHERE activo=true group by categoria");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row_array["nacional"] =0;
$row_array["internacional"] =0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $categorias = explode(" ",$row['categoria']);
    foreach ($categorias as $categoria) {
        $row_array[$categoria] = $row_array[$categoria]+ $row['conteo'];
    }
    
}

$stmt = mysqli_prepare($mysqli, "SELECT count(*) as conteo FROM actualidad WHERE activo=true");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = $result->fetch_assoc();
$row_array["todos"] = $row['conteo'];

?>
<!doctype html>
<html class="no-js" lang="">

<head>

    <title>Coordinación de luchadores - Comités de Lucha</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Páginas de los Comités de Lucha de Colombia">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/material.min.css">
    <link rel="stylesheet" href="/assets/css/ripples.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/assets/css/settings.css">
    <link rel="stylesheet" href="/assets/css/slicknav.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="stylesheet" href="/assets/css/colors/red.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/css/estilosCL.css">
</head>

<body>

    <header id="header" class="navbar navbar-default affix-top" data-spy="affix" data-offset-top="400">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand site-logo vertical-align" href="/">
                    <img class="img-responsive img-circle pull-left mt-20" src="/assets/images/icono.png"
                        width="80px" />
                    <h2 class="pull-left">Comités de Lucha</h2>
                </a>
            </div>
            <nav role="navigation" id="nav-main" class="okayNav">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="nav-link" href="/" type="button" aria-haspopup="true" aria-expanded="true">Inicio</a>
                    </li>
                    <li class="dropdown sub-menu">
                        <a class="dropdown-toggle nav-link" href="#" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Acerca de nosotros</a>
                        <div class="dropdown-menu sub-menu-panel" aria-labelledby="dropdownMenu1">
                            <a class="sub-menu-item" href="/info/quienes_somos.html">¿Quiénes somos?</a>
                            <a class="sub-menu-item" href="/info/plataforma_lucha.html">Plataforma de Lucha</a>
                            <a class="sub-menu-item" href="/info/que_sociedad_queremos.html">¿Qué sociedad queremos?</a>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link" href="/noticias/index.php" type="button" aria-haspopup="true" aria-expanded="true">Próximos
                            Eventos</a>
                    </li>
                    <li class="dropdown sub-menu active">
                        <a a class="dropdown-toggle nav-link" href="#" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actualidad</a>
                        <div class="dropdown-menu sub-menu-panel" aria-labelledby="dropdownMenu2">
                            <a class="sub-menu-item" href="/actualidad/index.php?categoria=nacional">Situación actual nacional</a>
                            <a class="sub-menu-item" href="/actualidad/index.php?categoria=internacional">Situación actual internacional</a>
                        </div>
                    </li>
                    <li class="dropdown sub-menu">
                        <a class=" dropdown-toggle nav-link" href="#" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Coordinación de
                            Luchadores</a>
                        <div class="dropdown-menu sub-menu-panel" aria-labelledby="dropdownMenu1">
                            <a class="sub-menu-item" href="/luchadores/index.php?categoria=arte">Arte para el pueblo</a>
                            <a class="sub-menu-item" href="/luchadores/index.php?categoria=asambleas">Asambleas Populares</a>
                            <a class="sub-menu-item" href="/luchadores/index.php?categoria=regiones">Coordinación por regiones</a>
                            <a class="sub-menu-item" href="/luchadores/index.php?categoria=primera_linea">Primera Línea</a>
                            <a class="sub-menu-item" href="/luchadores/index.php?categoria=mujeres">Mujeres</a>
                            <a class="sub-menu-item" href="/luchadores/index.php?categoria=etnias">Campesinos, Indígenas y etnias</a>
                        </div>
                    </li>

                </ul>
                <ul class="wpb-mobile-menu">
                    <li>
                        <a href="/">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Acerca de nosotros
                        </a>
                        <ul class="dropdown">
                            <li>
                                <a href="/info/quienes_somos.html">¿Quiénes somos?</a>
                            </li>
                            <li>
                                <a href="/info/plataforma_lucha.html">Plataforma de Lucha</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/noticias/index.php">
                            Próximos Eventos
                        </a>
                    </li>
                    <li>
                        <a class="active" href="#">
                            Actualidad
                        </a>
                        <ul class="dropdown">
                            <li>
                                <a href="/actualidad/index.php?categoria=nacional">Situación actual nacional</a>
                            </li>
                            <li>
                                <a href="/actualidad/index.php?categoria=internacional">Situación actual internacional</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            Coordinación de
                            Luchadores
                        </a>
                        <ul class="dropdown">
                            <li>
                                <a href="/luchadores/index.php?categoria=arte">Arte para el pueblo</a>
                            </li>
                            <li>
                                <a href="/luchadores/index.php?categoria=asambleas">Asambleas Populares</a>
                            </li>
                            <li>
                                <a href="/luchadores/index.php?categoria=regiones">Coordinación por regiones</a>
                            </li>
                            <li>
                                <a href="/luchadores/index.php?categoria=primera_linea">Primera Línea</a>
                            </li>
                            <li>
                                <a href="/luchadores/index.php?categoria=mujeres">Mujeres</a>
                            </li>
                            <li>
                                <a href="/luchadores/index.php?categoria=etnias">Campesinos, Indígenas y etnias</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </nav>
        </div>
    </header>


    <section class="page-title-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-center">
                        <div class="title-middle">
                            <h1 class="page-title">Situación actual</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="mea-blog-post-page section-padding">
        <div class="container">
            <div class="row">

                <div class="col-md-8 blog-post-column">

                    <div id="noticias_columna1" class="col-md-4 no-padding">

                        <div id="ejemplo_noticia" class="col-md-12" data-wow-delay=".2s" style="display:none">
                            <article class="single-blog-post">

                                <div class="featured-image">
                                    <a class="url_noticia" href="#">
                                        <img class="imagen_noticia" onerror="this.src='/assets/images/default/noticias.jpeg'" src="/assets/images/default/noticias.jpeg" alt="" style="height:300px;">
                                    </a>
                                </div>

                                <div class="post-meta">

                                    <div class="read-more-icon">
                                        <a class="btn btn-round btn-fab url_noticia" href="blog-single.html"><i class="material-icons">&#xE5C8;</i><div class="ripple-container"></div></a>
                                    </div>

                                    <a href="blog-single.html">
                                        <h2 class="subtitle titulo_noticia">Lorem ipsum do lor sit amet, cosectetur adipisicing</h2>
                                    </a>
                                    <p>Por <b class="subtitulo_noticia"></b></p>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div  id="noticias_columna2" class="col-md-4 no-padding">
                    </div>

                    <div  id="noticias_columna3" class="col-md-4 no-padding">
                    </div>

                    <div id="cargarMas" class="col-md-12 text-center mt-30 blog-pagination" style="display:none;">
                        <a onClick="cargarMasNoticias(this);" offset="12"  href="javascript:void(0)" class="btn btn-common"><i class="material-icons">&#xE028;</i> Cargar más noticias<div class="ripple-container"></div></a>
                    </div>

                </div>

                <div class="col-md-4 blog-sidebar-column">

                    <aside class="col-md-12 single-sidebar-widget subscribe-widget no-padding  wow animated fadeInUp" data-wow-delay=".3s">
                        <div class="sidebar-widget-title">
                            <h2>Categorías</h2>
                        </div>
                        <div class="social-profiles clearfix  wow animated slideInLeft" data-wow-delay=".2s">
                        <a class="animated4 btn btn-common col-md-12 col-sm-12" href="/actualidad/index.php">Todas <span id="null_noticias" class="badge"><? echo $row_array["todos"]?></span></a>
                            <a class="animated4 btn btn-common btn-sm col-md-12 col-sm-12" href="/actualidad/index.php?categoria=nacional">Nacional<span id="nacional_noticias"  class="badge"><? echo $row_array["nacional"]?></span></a>
                            <a class="animated4 btn btn-common btn-sm col-md-12 col-sm-12" href="/actualidad/index.php?categoria=internacional">Internacional <span id="internacional_noticias"  class="badge"><? echo $row_array["internacional"]?></span></a>
                            </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>


    <footer class="mea-footer-section">

        <div class="footer-widget-container">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 single-footer-widget wow animated fadeInUp mx-auto" data-wow-delay=".2s">
                        <div class="text-center">
                            <img src="/assets/images/icono.png" width="200px" />
                            <a id="login" class="btn btn-common" href="/admon/index.html">
                                <i class="material-icons">login</i>Administrar</a>
                        </div>
                    </div>

                    <div class="col-md-6 single-footer-widget recent-work-widget wow animated fadeInUp"
                        data-wow-delay=".4s">
                        <h3 class="footer-title">Movimientos afines</h3>
                        <ul>
                            <li>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="/assets/images/work/footer-work1.png" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="">
                                            <h4>Cosol</h4>
                                        </a>
                                        <span>Lorem ipsum dolor sit amet</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="/assets/images/work/footer-work2.png" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="">
                                            <h4>Otra organización</h4>
                                        </a>
                                        <span>Lorem ipsum dolor sit amet</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 single-footer-widget footer-contact-widget wow animated fadeInUp"
                        data-wow-delay=".5s">
                        <h3 class="footer-title">Contáctanos</h3>
                        <p><span>Teléfono:</span> 879-890-9767</p>
                        <p><span>Correo:</span> <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="90e3e5e0e0ffe2e4d0fdf5f1bef3fffd">[email&#160;protected]</a></p>
                        <p><span>Twitter:</span> @mea</p>
                        <h3 class="footer-title mt-50">Síguenos en nuestras redes</h3>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-github"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <p>&copy; 2022 Comités de Lucha. Todos los derechos reservados.</p>
                    </div>

                </div>
            </div>
        </div>
    </footer>


    <a href="#" class="back-to-top">
        <div class="ripple-container"></div>
        <i class="fa fa-angle-up">
        </i>
    </a>

    <div id="loader">
        <div class="square-spin">
            <img src="/assets/images/Preloader.gif" alt="MEA Proloader">
        </div>
    </div>


    <script data-cfasync="false" src="/assets/js/email-decode.min.js"></script>
    <script src="/assets/js/jquery-min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.mixitup.min.js"></script>
    <script src="/assets/js/jquery.inview.js"></script>
    <script src="/assets/js/jquery.counterup.min.js"></script>
    <script src="/assets/js/scroll-top.js"></script>
    <script src="/assets/js/material.min.js"></script>
    <script src="/assets/js/ripples.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>

    <script src="/assets/js/form-validator.min.js"></script>
    <script src="/assets/js/contact-form-script.min.js"></script>
    <script src="/assets/js/wow.js"></script>
    <script src="/assets/js/jquery.slicknav.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/scriptCL.js"></script>
    <script>
        $(document).ready(function () {
            categoriaSeleccionada(findGetParameter("categoria") );
            $.ajax({
                url: '/php/actualidad/list.php',
                data: { limit: 12, categoria: findGetParameter("categoria") },
                success: function (data) {
                    var json = $.parseJSON(data);
                    completarActualidades(json);
                    if (json.total>12){
                        $("#cargarMas").css("display", "")
                    }
                },
                error: function () {
                    console.log('There was some error performing the news AJAX call!');
                }
            });
        });
</script>
</body>
</html>