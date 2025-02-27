<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\controllers\LoginController;
use App\services\AuthService;
use App\models\Usuario;

$usuarioModel = new Usuario();
$authService = new AuthService($usuarioModel);
$loginController = new LoginController($authService);

$loginController->logout();
