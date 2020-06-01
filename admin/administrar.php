<?php
session_abort();
session_start();
error_reporting(E_ALL ^ E_NOTICE);

/* Si esta autenticado como administrador redirigimos al dashboard; si no va al login */
if(isset($_SESSION['usuario']) and $_SESSION['estado'] == 'Autenticado') {
	include('dashboard.php');
	die();
} else {
	include('login.php');
	die();
};
