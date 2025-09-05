<?php

namespace App\services;

interface IClienteService
{
    public function criar(array $dados);
    public function atualizar($id, array $dados);
    public function deletar($id);
    public function listar();
    public function get($id);
}

