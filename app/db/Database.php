<?php

    namespace App\db;

    use PDO;

    class Database {
        private static $pdo;
        private static $usuario;
        private static $senha;

        private static function init() {
            try {
                self::$usuario = getenv('DB_USERNAME') ?: 'root';
                self::$senha = getenv('DB_PASSWORD') ?: '';
            } catch (\Exception $e) {
                echo "Erro ao carregar variáveis de ambiente: " . $e->getMessage();
                exit;
            }
        }

        public static function connect() {
            if (!isset(self::$pdo)) {
                self::init();
                self::$pdo = new PDO("mysql:host=localhost;dbname=teste_crud", self::$usuario, self::$senha);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$pdo;
        }
    }
