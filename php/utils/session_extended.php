<?php

session_start();

$now = time();
if (isset($_SESSION) && $now < $_SESSION['expire']) {
      //Agregar 30 minutos más
      $_SESSION['expire'] = $_SESSION['expire'] + (30 * 60);
} 