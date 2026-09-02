<?php

    namespace Core;

    use PDO;
    use PDOException;

    class dataBase {

        private PDO $pdo;
        private static $instancia = null;
        private $conexao;

        public function __construct(){
            $app = require(__DIR__ . "/config.php");
            $db  = $app['db'];            
            try{
                $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']};charset=utf8mb4";
                $this->conexao = new PDO($dsn, $db['user'], $db['pass'],);
            } catch (PDOException $e){
                echo "Erro" . $e->getMessage();
            }
        }

        public static function conectar(){
            if (self::$instancia === null) {
                self::$instancia = new self;
            }
            return self::$instancia->conexao;
        }
    }
?>