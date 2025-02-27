<?php

use PHPUnit\Framework\TestCase;
use App\controllers\LoginController;
use App\services\AuthService;

class LoginControllerTest extends TestCase
{
    private $authServiceMock;
    private $loginController;

    protected function setUp(): void
    {
        $this->authServiceMock = $this->createMock(AuthService::class);
        $this->loginController = new LoginController($this->authServiceMock);
    }

    public function testLoginComCredenciaisInvalidas()
    {
        $this->authServiceMock->method('authenticate')
            ->willReturn(false);

        ob_start();
        $this->loginController->login(['usuario' => 'teste', 'senha' => 'senhaerrada']);
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['message' => 'Usuário ou senha inválidos!']),
            $output
        );
    }

}
