<?php

    namespace App\controllers;

    use App\models\Cliente;
    use App\models\Endereco;
    use App\services\ClienteServiceImpl;

    use Exception;

    class ClienteController
    {
        public function all()
        {
            $clienteController = new ClienteServiceImpl();
            echo $clienteController->listar();
        }

        public function save($post)
        {
            $clienteService = new ClienteServiceImpl();
            echo $clienteService->criar($post);
        }

        public function delete($post)
        {
            $clienteService = new ClienteServiceImpl();
            echo $clienteService->deletar($post['codigo']);
        }

        public function get($codigo)
        {
            $clienteService = new ClienteServiceImpl();
            echo $clienteService->get($codigo);
        }
    }