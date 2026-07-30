<?php
    require_once __DIR__ . "/../config/conexao.php";   
    require_once __DIR__ . "/../models/tarefa.php";

    class TarefaDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = Conexao::getConexao();
        }

        public function cadastrarTarefa(Tarefa $tarefa) {
            try {
                $sql = "INSERT INTO 
                        tb_tarefas(nm_nome, ds_descricao, ds_tipo, dt_termino, dt_criacao)
                        VALUES (?,?,?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    $tarefa->getNome(),
                    $tarefa->getDescricao(),
                    $tarefa->getTipo(),
                    $tarefa->getDataTermino(),
                    $tarefa->getDataCriado()
                ]);
                $id = $this->pdo->lastInsertId();
                $tarefa->setId($id);
            }
            catch (Exception $e) {
                error_log("Erro: " . $e->getMessage());
                throw $e;
            }
        }
    };