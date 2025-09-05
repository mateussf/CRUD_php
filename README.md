
# Projeto de CRUD de cliente com PHP puro

Projeto que visa demonstrar algumas técnicas conhecidas por mim para o desenvolvimento de software, como orientação a objetos, clean code, SOLID dentre outros conceitos de desenvolvimento de software.

#Instalação

Desenvolvido com PHP 7.4 e banco de dados instalado através do wampServer e composer para gerenciamento do autoload das páginas. No front-end foi utilziado Bootstrap 5, FontAwesome e jQuery com instalação via CDN

-> Clonar o projeto:

```bash
git clone https://github.com/mateussf/CRUD_php.git
```

- iniciar o composer, na raiz do projeto

```bash
cd CRUD_php
compser install
```

- Para fazer a crição do banco de dados e as respectivas tabelas, rodar o script estrutura.sql que pode ser encontrado na raiz do projeto.
```bash
Usuário: admin
Senha: senha123
```


- Configurar as credenciais do banco de dados em app/db/Database.php
- Criar as variaveis de ambiente por segurança
```bash
DB_USERNAME
DB_PASSWORD
```


- Iniciar o servidor do PHP embutido
```bash
php -S localhost:8000 -t public
```

