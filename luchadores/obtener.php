<?php
//including the database connection file
include_once("../php/config/configbd.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$stmt = mysqli_prepare($mysqli, "SELECT * FROM luchadores WHERE luchadores_id = ?");
mysqli_stmt_bind_param($stmt, 's', $_GET['id']);

/* execute query */
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<html class="desktop mbr-site-loaded">

<head>
<title>Coordinación de Luchadores</title>

<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="Páginas de los Comités de Lucha de Colombia">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!--  Essential META Tags -->
    <meta property="og:title" content="Comités de Lucha. <? echo $row["titulo"]?>" />
    <meta property="og:image" itemprop="image"
        content="<? echo $row["url_imagen"]?>" />
    <meta property="og:type" content="website" />
    <meta property="og:video:type" content="text/html">
    
    <meta name="twitter:card" content="summary_large_image" />

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

<body class="clickup-chrome-ext_installed" cz-shortcut-listen="true">
    
<header id="header" class="navbar navbar-default affix-top" data-spy="affix" data-offset-top="400">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand site-logo vertical-align" href="/">
                    <img class="img-responsive img-circle pull-left mt-20" src="/assets/images/icono.png" width="80px" />
                    <h2 class="pull-left">Comités de Lucha</h2>
                </a>
            </div>
            <nav role="navigation" id="nav-main" class="okayNav">
                <ul class="nav navbar-nav">
                    <li class="active">
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
                        <a class="nav-link" href="#" type="button" aria-haspopup="true" aria-expanded="true">Próximos
                            Eventos</a>
                    </li>
                    <li class="dropdown sub-menu">
                        <a a class="dropdown-toggle nav-link" href="#" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actualidad</a>
                        <div class="dropdown-menu sub-menu-panel" aria-labelledby="dropdownMenu2">
                            <a class="sub-menu-item" href="#">Situación actual nacional</a>
                            <a class="sub-menu-item" href="#">Situación actual internacional</a>
                        </div>
                    </li>
                    <li class="dropdown sub-menu">
                        <a class=" dropdown-toggle nav-link" href="#" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Coordinación de
                            Luchadores</a>
                        <div class="dropdown-menu sub-menu-panel" aria-labelledby="dropdownMenu1">
                            <a class="sub-menu-item" href="#">Arte para el pueblo</a>
                            <a class="sub-menu-item" href="#">Asambleas Populares</a>
                            <a class="sub-menu-item" href="#">Coordinación por regiones</a>
<a class="sub-menu-item" href="#">Primera Línea</a>
                            <a class="sub-menu-item" href="#">Mujeres</a>
                            <a class="sub-menu-item" href="#">Campesinos, Indígenas y etnias</a>                        </div>
                    </li>

                </ul>
                <ul class="wpb-mobile-menu">
                    <li>
                        <a class="active" href="/">
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
                        <a href="#">
                            Próximos Eventos
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Actualidad
                        </a>
                        <ul class="dropdown">
                            <li>
                                <a href="#">Situación actual nacional</a>
                            </li>
                            <li>
                                <a href="#">Situación actual internacional</a>
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
                                <a href="#">Arte para el pueblo</a>
                            </li>
                            <li>
                                <a href="#">Asambleas Populares</a>
                            </li>
                            <li>
                                <a href="#">Coordinación por regiones</a>
                            </li>
                            <li>
                                <a href="#">Mujeres</a>
                            </li>
                            <li>
                                <a href="#">Campesinos, Indígenas y etnias</a>
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
                            <h2 class="page-tagline">Coordinación de Luchadores</h2>
                            <h1 class="page-title"><? echo $row["titulo"]?></h1>
                            <h5 class="page-title"><? echo $row["subtitulo"]?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mea-blog-post-page section-padding">
        <div class="container">
            <div class="row">

                <div class="single-blog-page col-md-12">
                    <article class="single-post wow fadeInUp animated" data-wow-delay=".2s">
                    <? echo $row["descripcion"]?>
                    </article>
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
                            <a id="login" class="btn btn-common" href="#">
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
</body>

</html>