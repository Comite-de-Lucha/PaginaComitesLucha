<?php
//including the database connection file
include_once("../php/config/configbd.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$stmt = mysqli_prepare($mysqli, "SELECT YEAR(fecha) as anho, MONTH(fecha) as mes, count(*) as conteo FROM noticias WHERE activo=true group by YEAR(fecha), MONTH(fecha) order by YEAR(fecha) desc, MONTH(fecha) asc");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row_mes[1]="Enero";
$row_mes[2]="Febrero";
$row_mes[3]="Marzo";
$row_mes[4]="Abril";
$row_mes[5]="Mayo";
$row_mes[6]="Junio";
$row_mes[7]="Julio";
$row_mes[8]="Agosto";
$row_mes[9]="Septiembre";
$row_mes[10]="Octubre";
$row_mes[11]="Noviembre";
$row_mes[12]="Diciembre";
$row_mes_viz["Enero"]=1;
$row_mes_viz["Febrero"]=2;
$row_mes_viz["Marzo"]=3;
$row_mes_viz["Abril"]=4;
$row_mes_viz["Mayo"]=5;
$row_mes_viz["Junio"]=6;
$row_mes_viz["Julio"]=7;
$row_mes_viz["Agosto"]=8;
$row_mes_viz["Septiembre"]=9;
$row_mes_viz["Octubre"]=10;
$row_mes_viz["Noviembre"]=11;
$row_mes_viz["Diciembre"]=12;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $row_array[$row['anho']][$row_mes[$row['mes']]] = $row['conteo'];
}

$stmt = mysqli_prepare($mysqli, "SELECT count(*) as conteo FROM noticias WHERE activo=true");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = $result->fetch_assoc();
$row_todos["todos"] = $row['conteo'];

?>

<!doctype html>
<html class="no-js" lang="">

<head>

    <title>Próximos eventos - Comités de Lucha</title>

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
                    <li class="active">
                        <a class="nav-link" href="/noticias/index.php" type="button" aria-haspopup="true" aria-expanded="true">Próximos
                            Eventos</a>
                    </li>
                    <li class="dropdown sub-menu">
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
                        <a class="active" href="/noticias/index.php">
                            Próximos Eventos
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
                            <h1 class="page-title">Próximos eventos</h1>
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

                    <div id="noticias_columna1" class="col-md-6 no-padding">

                        <div id="ejemplo_noticia" class="col-md-12" data-wow-delay=".2s" style="display:none">
                            <article class="single-blog-post">

                                <div class="featured-image">
                                    <a class="url_noticia" href="#">
                                        <img class="imagen_noticia"  onerror="this.src='/assets/images/default/Banner_proximos.png'" src="/assets/images/default/Banner_proximos.png" alt="">
                                    </a>
                                </div>

                                <div class="post-meta">

                                    <div class="read-more-icon">
                                        <a class="btn btn-round btn-fab url_noticia" href="blog-single.html"><i class="material-icons">&#xE5C8;</i><div class="ripple-container"></div></a>
                                    </div>

                                    <a href="blog-single.html">
                                        <h2 class="subtitle titulo_noticia">Lorem ipsum do lor sit amet, cosectetur adipisicing</h2>
                                    </a>
                                    <p><b class="subtitulo_noticia"></b></p>
                                </div>
                            </article>
                        </div>
                    </div>

                    <div  id="noticias_columna2" class="col-md-6 no-padding">
                    </div>

                    <div id="cargarMas" class="col-md-12 text-center mt-30 blog-pagination" style="display:none;">
                        <a onClick="cargarMasNoticias(this);" offset="12"  href="javascript:void(0)" class="btn btn-common"><i class="material-icons">&#xE028;</i> Cargar más noticias<div class="ripple-container"></div></a>
                    </div>

                </div>

                <div class="col-md-4 blog-sidebar-column">

                <aside class="col-md-12 single-sidebar-widget subscribe-widget no-padding  wow animated fadeInUp" data-wow-delay=".3s">
                        <div class="sidebar-widget-title">
                            <h2>Fecha</h2>
                        </div>
                        <div class="social-profiles clearfix  wow animated slideInLeft" data-wow-delay=".2s">
                            <a class="animated4 btn btn-common col-md-12 col-sm-12 col-xs-12" href="/noticias/index.php">Todas <span id="null_noticias" class="badge"><? echo $row_todos["todos"]?></span></a>
                            <div class="panel-group mea-default-accordion" id="mea-accordion" role="tablist" aria-multiselectable="true">
                            <?php
                            foreach ($row_array as $anho => $row_mes) {
                                echo '<div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading'.$anho.'">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#mea-accordion" href="#collapse'.$anho.'" aria-expanded="true" aria-controls="collapse'.$anho.'">
                                        '.$anho.'</a>
                                    </h4>
                                </div>
                                <div id="collapse'.$anho.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$anho.'">
                                <div class="panel-body">';
                                foreach ($row_mes as $mes => $value) {
                                echo '<a id="'.$anho.'-'.$row_mes_viz[$mes].'" class="animated4 btn btn-raised btn-default col-md-12 col-sm-12 col-xs-12" href="/noticias/index.php?anho='.$anho.'&mes='. $row_mes_viz[$mes]. '">'. $mes. ' <span class="badge">'.$value.'</span></a>';
                                }
                                echo '</div></div></div>';
                            }
                            ?>
                            </div>
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
            MesAnhoSeleccionado(findGetParameter("anho")+"-"+findGetParameter("mes"));
            $.ajax({
                url: '/php/noticias/list.php',
                data: { limit: 12, mes: findGetParameter("mes"), anho: findGetParameter("anho") },
                success: function (data) {
                    var json = $.parseJSON(data);
                    completarNoticias(json);
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