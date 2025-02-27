<?php

use PHPUnit\Framework\TestCase;
use App\controllers\ClienteController;
use App\models\Cliente;
use App\models\Endereco;

class ClienteControllerTest extends TestCase
{
    protected $clienteController;
    protected $clienteMock;
    protected $enderecoMock;

    protected function setUp(): void
    {
        $this->clienteMock = $this->createMock(Cliente::class);
        $this->enderecoMock = $this->createMock(Endereco::class);
        $this->clienteController = new ClienteController($this->clienteMock, $this->enderecoMock);

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = [];
    }

    public function testAll()
    {
        $this->clienteMock->method('all')->willReturn([
            ['codigo' => 1, 'nome' => 'Cliente 1'],
            ['codigo' => 2, 'nome' => 'Cliente 2']
        ]);

        ob_start();
        $this->clienteController->all();
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                ['codigo' => 1, 'nome' => 'Cliente 1'],
                ['codigo' => 2, 'nome' => 'Cliente 2']
            ]),
            $output
        );
    }

    public function testSave()
    {
        $post = [
            'codigo' => null,
            'nome' => 'Cliente Teste',
            'data_nascimento' => '2000-01-01',
            'cpf' => '123.456.789-00',
            'rg' => '12.345.678-9',
            'telefone' => '123456789',
            'endereco' => [
                [
                    'endereco' => 'Rua Teste',
                    'numero' => '123',
                    'bairro' => 'Bairro Teste',
                    'cidade' => 'Cidade Teste',
                    'estado' => 'Estado Teste',
                    'complemento' => 'Complemento Teste'
                ]
            ]
        ];

        $this->clienteMock->method('save')->willReturn(true);
        $this->enderecoMock->method('save')->willReturn(true);

        ob_start();
        $this->clienteController->save($post);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['message' => 'Cliente criado com sucesso!']),
            $output
        );
    }

    public function testDelete()
    {
        $post = ['codigo' => 1];

        $this->clienteMock->method('delete')->willReturn(true);

        ob_start();
        $this->clienteController->delete($post);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['message' => 'Cliente deletado com sucesso!']),
            $output
        );
    }

    public function testGet()
    {
        $codigo = 1;

        $this->clienteMock->method('where')->willReturnSelf();
        $this->clienteMock->method('first')->willReturn([
            'codigo' => 1,
            'nome' => 'Cliente Teste',
            'data_nascimento' => '2000-01-01',
            'cpf' => '123.456.789-00',
            'rg' => '12.345.678-9',
            'telefone' => '123456789'
        ]);

        $this->enderecoMock->method('where')->willReturnSelf();
        $this->enderecoMock->method('get')->willReturn([
            [
                'codigo' => 1,
                'codigo_cliente' => 1,
                'endereco' => 'Rua Teste',
                'numero' => '123',
                'bairro' => 'Bairro Teste',
                'cidade' => 'Cidade Teste',
                'estado' => 'Estado Teste',
                'complemento' => 'Complemento Teste'
            ]
        ]);

        ob_start();
        $this->clienteController->get($codigo);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'codigo' => 1,
                'nome' => 'Cliente Teste',
                'data_nascimento' => '2000-01-01',
                'cpf' => '123.456.789-00',
                'rg' => '12.345.678-9',
                'telefone' => '123456789',
                'enderecos' => [
                    [
                        'codigo' => 1,
                        'codigo_cliente' => 1,
                        'endereco' => 'Rua Teste',
                        'numero' => '123',
                        'bairro' => 'Bairro Teste',
                        'cidade' => 'Cidade Teste',
                        'estado' => 'Estado Teste',
                        'complemento' => 'Complemento Teste'
                    ]
                ]
            ]),
            $output
        );
    }
}