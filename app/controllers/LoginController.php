<?php

namespace App\controllers;

use App\models\Usuario;
use App\services\AuthService;

class LoginController
{
    private $authService;

    public function __construct($authService)
    {
        $this->authService = $authService;
    }

    public function login($post)
    {
        $usuario = $this->authService->authenticate($post['usuario'], $post['senha']);

        if (!$usuario) {
            echo json_encode(['message' => 'Usuário ou senha inválidos!']);
            return;
        }

        $this->iniciarSessao();
        $_SESSION['usuario'] = $usuario['codigo'];
        $_SESSION['nome'] = $usuario['nome'];

        echo json_encode(['success' => true]);
    }

    public function logout()
    {
        $this->iniciarSessao();
        session_destroy();
        header('Location: /login.php');
        exit;
    }

    private function iniciarSessao()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}

