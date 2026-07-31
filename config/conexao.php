<?php
    date_default_timezone_set('America/Sao_paulo');

    class Conexao {
        private static $instancia = null;

        public static function getConexao() {
            if(self::$instancia === null) {
                try {
                    self::$instancia = new PDO(
                        "mysql:host=localhost;dbname=crud_php;charset=utf8",
                        "root",
                        "",
                    );
                    self::$instancia->setAttribute(
                        PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION,
                    );
                }
                catch (PDOException $e){
                    error_log("Erro de conexao: " . $e->getMessage());
                    die("Erro ao conectar no banco de dados");
                }
            }
            // Retorna a conexão PDO
            return self::$instancia; 
        }
    }