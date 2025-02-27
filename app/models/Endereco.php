<?php
namespace App\models;

use App\models\Model;

class Endereco extends Model {

    protected $table = "enderecos";
    protected $primaryKey = "codigo";

    protected $fields = [
        'codigo' => null,
        'codigo_cliente' => null,
        'endereco' => null,
        'numero' => null,
        'bairro' => null,
        'cidade' => null,
        'estado' => null,
        'complemento' => null,
    ];

    public function getCodigo()
    {
        return $this->fields['codigo'];
    }

    public function setCodigo($codigo)
    {
        $this->fields['codigo'] = $codigo;
    }

    public function getCodigoCliente()
    {
        return $this->fields['codigo_cliente'];
    }

    public function setCodigoCliente($codigo_cliente)
    {
        $this->fields['codigo_cliente'] = $codigo_cliente;
    }

    public function getEndereco()
    {
        return $this->fields['endereco'];
    }

    public function setEndereco($endereco)
    {
        $this->fields['endereco'] = $endereco;
    }

    public function getNumero()
    {
        return $this->fields['numero'];
    }

    public function setNumero($numero)
    {
        $this->fields['numero'] = $numero;
    }

    public function getBairro()
    {
        return $this->fields['bairro'];
    }

    public function setBairro($bairro)
    {
        $this->fields['bairro'] = $bairro;
    }

    public function getCidade()
    {
        return $this->fields['cidade'];
    }

    public function setCidade($cidade)
    {
        $this->fields['cidade'] = $cidade;
    }

    public function getEstado()
    {
        return $this->fields['estado'];
    }

    public function setEstado($estado)
    {
        $this->fields['estado'] = $estado;
    }

    public function getComplemento()
    {
        return $this->fields['complemento'];
    }

    public function setComplemento($complemento)
    {
        $this->fields['complemento'] = $complemento;
    }
}
