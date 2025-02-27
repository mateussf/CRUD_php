<?php

namespace App\actions\login;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\controllers\LoginController;
use App\services\AuthService;
use App\models\Usuario;

$usuarioModel = new Usuario();
$authService = new AuthService($usuarioModel);
$controller = new LoginController($authService);

$retorno = $controller->login($_POST);
return $retorno;
