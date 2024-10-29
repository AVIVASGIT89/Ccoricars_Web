<?php

require_once "controladores/plantilla.controlador.php";

require_once "controladores/usuarios.controlador.php";
require_once "controladores/servicio.controlador.php";
require_once "controladores/marca.controlador.php";
require_once "controladores/modelo.controlador.php";
require_once "controladores/vehiculo.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/servicio.modelo.php";
require_once "modelos/marca.modelo.php";
require_once "modelos/modelo.modelo.php";
require_once "modelos/vehiculo.modelo.php";

$plantila = new ControladorPlantilla();
$plantila -> crtPlantilla();