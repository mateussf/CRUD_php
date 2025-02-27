<?php

    namespace App\controllers;

    use App\models\Cliente;
    use App\models\Endereco;
    use Exception;

    class ClienteController
    {
        public function all()
        {
            $cliente = new Cliente();

            echo json_encode($cliente->all());
        }

        public function save($post)
        {

            try {

                $acao =  ($post['codigo'] ? "U" : "I");

                $cliente = new Cliente();
                $cliente->setCodigo($post['codigo']);
                $cliente->setNome($post['nome']);
                $cliente->setDataNascimento($post['data_nascimento']);
                $cliente->setCpf($post['cpf']);
                $cliente->setRg($post['rg']);
                $cliente->setTelefone($post['telefone']);

                $codigoCliente = $cliente->getCodigo();

                $cliente->save();

                $mensagem = $acao == "I" ? "Cliente criado com sucesso!" : "Cliente atualizado com sucesso!";
                if (!isset($post['endereco']) && empty($post['endereco'])) {
                    echo json_encode(['message' => $mensagem]);
                    exit;
                }

                $this->insertEndereco($post, $codigoCliente);


                echo json_encode(['message' => $mensagem]);
            } catch (Exception $e) {
                return json_encode(['message' => 'Erro ao realizar o cadastro']);
            }
        }

        public function insertEndereco($post, $codigoCliente)
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

        public function delete($post)
        {
            try {
                $cliente = new Cliente();
                $cliente->delete($post['codigo']);

                return json_encode(['message' => 'Cliente deletado com sucesso!']);
            } catch (Exception $e) {
                return json_encode(['message' => 'Erro ao deletar o cliente']);
            }
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