<?php
namespace App\models;

use App\models\Model;

class Usuario extends Model {

    protected $table = "usuarios";
    protected $primaryKey = "codigo";

    protected $fields = [
        'codigo' => null,
        'nome' => null,
        'usuario' => null,
        'senha' => null,
    ];

    public function getCodigo()
    {
        return $this->fields['codigo'];
    }

    public function setCodigo($codigo)
    {
        $this->fields['codigo'] = $codigo;
    }

    public function getNome()
    {
        return $this->fields['nome'];
    }

    public function setNome($nome)
    {
        $this->fields['nome'] = $nome;
    }

    public function getUsuario()
    {
        return $this->fields['usuario'];
    }

    public function setUsuario($usuario)
    {
        $this->fields['usuario'] = $usuario;
    }

    public function getSenha()
    {
        return $this->fields['senha'];
    }

    public function setSenha($senha)
    {
        $this->fields['senha'] = $senha;
    }

}