<?php
    class Conexao {
        private static $instancia = null;

        public function getConexao() {
            if(self::$instancia === null) {
                try {
                    self::$instancia = new PDO(
                        "mysql:host=root;dbname=crud_php;charset=utf-8",
                        "crud_php",
                        "",
                    );
                    self::$instancia->setAttribute(
                        PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION,
                    );
                    self::$instancia->exec("SET time_zone = 'America/Sao_Paulo'");
                }
                catch (PDOException $e){
                    error_log("Erro de conexao: " . $e->getMessage());
                    die("Erro ao conectar no banco de dados");
                }
            }
            return self::$instancia; 
        }
    }