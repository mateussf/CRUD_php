<?php

namespace App\actions\cliente;

use App\controllers\ClienteController;


$controller = new ClienteController();
$retorno = $controller->delete($_POST);
return $retorno;
