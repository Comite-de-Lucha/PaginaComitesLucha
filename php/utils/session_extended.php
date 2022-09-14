<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$now = time();
if (isset($_SESSION) && $now < $_SESSION['expire']) {
      //Agregar 1 hora más
      $_SESSION['expire'] = $_SESSION['expire'] + (60 * 60);
} 