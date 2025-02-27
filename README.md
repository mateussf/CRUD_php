
# Projeto de CRUD de cliente com PHP puro

Projeto que visa demonstrar algumas técnicas conhecidas por mim para o desenvolvimento de software, como orientação a objetos, clean code, SOLID dentre outros conceitos de desenvolvimento de software.

#Instalação

Desenvolvido com PHP 7.4 e banco de dados instalado através do wampServer e composer para gerenciamento do autoload das páginas. No front-end foi utilziado Bootstrap 5, FontAwesome e jQuery com instalação via CDN

-> Clonar o projeto:

```bash
git clone https://github.com/mateussf/testeKabum.git
```

- Na raiz do projeto, iniciar o composer

```bash
compser install
```

- Para fazer a crição do banco de dados e as respectivas tabelas, rodar o script estrutura.sql que pode ser encontrado na raiz do projeto.


- Iniciar o servidor do PHP embutido
```bash
php -S localhost:8000 -t public
```

- Configurar as credenciais do banco de dados em app/db/Database.php



## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  php vendor/bin/phpunit tests/LoginControllerTest.php
  php vendor/bin/phpunit tests/ClienteControllerTest.php
```

### O teste de Cliente, infelizmente não está funcionando devido ao curto prazo para realização, mas acabei deixando no projeto para ilustrar.

Pretendo utilizar o projeto para futuros testes para aprendizado contínuo.