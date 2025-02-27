<?php

namespace App\services;

use App\models\Usuario;

class AuthService
{
    private $usuarioModel;

    public function __construct(Usuario $usuarioModel)
    {
        $this->usuarioModel = $usuarioModel;
    }

    public function authenticate($usuario, $senha)
    {
        return $this->usuarioModel->where('usuario', $usuario)->where('senha', $senha)->first();
    }
}