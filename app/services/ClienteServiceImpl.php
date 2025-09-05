<?php

namespace App\services;

use App\models\Cliente;
use App\models\Endereco;

use Exception;

use App\services\IClienteService;

class ClienteServiceImpl implements IClienteService
{
    private $clienteModel;

    public function criar($dados)
    {
        try {

            $acao =  ($dados['codigo'] ? "U" : "I");

            if ($this->cpfJaCadastrado($dados['cpf']) && $acao == "I") {
                return json_encode(['message' => 'CPF já cadastrado no sistema!', 'error'=>true]);
            }

            $cliente = new Cliente();
            $cliente->setCodigo(!empty($dados['codigo']) ? $dados['codigo']: null);
            $cliente->setNome($dados['nome']);
            $cliente->setDataNascimento($dados['data_nascimento']);
            $cliente->setCpf($dados['cpf']);
            $cliente->setRg($dados['rg']);
            $cliente->setTelefone($dados['telefone']);
            $cliente->setAtivo('S');
            $cliente->save();
            $codigoCliente = $cliente->getCodigo();

            $mensagem = $acao == "I" ? "Cliente criado com sucesso!" : "Cliente atualizado com sucesso!";
            if (!isset($dados['endereco']) && empty($dados['endereco'])) {
                return json_encode(['message' => $mensagem, 'error'=>true]);
            }

            $this->insertEndereco($dados, $codigoCliente);


            return json_encode(['message' => $mensagem, 'error'=>false]);
        } catch (Exception $e) {
            return json_encode(['message' => 'Erro ao realizar o cadastro', 'error'=>true]);
        }
    }

    private function cpfJaCadastrado($cpf)
    {
        $cliente = new Cliente;
        return $cliente->where('cpf', $cpf)->where('ativo', 'S')->first();
    }

    private function insertEndereco($post, $codigoCliente)
    {
        $arrayKeys = array_keys($post['endereco']);
        $maxKey = end($arrayKeys) ?? 0;

        if ($codigoCliente) {
            $endereco = new Endereco();
            $endereco->delete('codigo_cliente', $codigoCliente);
        }

        for ($x = 0; $x <= $maxKey; $x++) {
            $descendereco = isset($post['endereco'][$x]) ? $post['endereco'][$x] : null;
            $numero = isset($post['numero'][$x]) ? $post['numero'][$x] : null;
            $bairro = isset($post['bairro'][$x]) ? $post['bairro'][$x] : null;
            $cidade = isset($post['cidade'][$x]) ? $post['cidade'][$x] : null;
            $estado = isset($post['estado'][$x]) ? $post['estado'][$x] : null;
            $complemento = isset($post['complemento'][$x]) ? $post['complemento'][$x] : null;

            $endereco = new Endereco();
            $endereco->setCodigoCliente($codigoCliente);
            $endereco->setEndereco($descendereco);
            $endereco->setNumero($numero);
            $endereco->setBairro($bairro);
            $endereco->setCidade($cidade);
            $endereco->setEstado($estado);
            $endereco->setComplemento($complemento);
            $endereco->save();

        }
    }

    public function atualizar($id, $dados)
    {
        // Implementar lógica para atualizar um cliente
    }

    public function deletar($codigo)
    {
        try {
            $cliente = new Cliente();
            $clienteArr = $cliente->where('codigo', $codigo)->first();

            if (!$cliente) {
                return json_encode(['message' => 'Cliente não encontrado!']);
            }

            $cliente = new Cliente();
            $cliente->fillFromArray($clienteArr);

            $cliente->setAtivo('N');
            $cliente->save();

            return json_encode(['message' => 'Cliente deletado com sucesso!', 'error'=>false]);
        } catch (Exception $e) {
            return json_encode(['message' => 'Erro ao inativar o cliente', 'error'=>true]);
        }
    }

    public function listar()
    {
        $cliente = new Cliente();
        echo json_encode($cliente->ativo()->all());
    }

    public function get($codigo)
    {
        $cliente = new Cliente();
        $cliente = $cliente->where('codigo', $codigo)->first();

        $endereco = new Endereco();
        $endereco = $endereco->where('codigo_cliente', $codigo)->get();

        $cliente['enderecos'] = $endereco;

        echo json_encode($cliente);
    }

}
