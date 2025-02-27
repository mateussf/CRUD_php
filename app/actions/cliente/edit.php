<?php

namespace App\actions\cliente;

use App\controllers\ClienteController;


$controller = new ClienteController();
$retorno = $controller->get($_POST['codigo']);

return $retorno;
