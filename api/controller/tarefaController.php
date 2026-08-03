<?php
    require_once __DIR__ . "/../models/tarefaDAO.php";

    class TarefaController {
        private $dao;

        public function __construct() {
            $this->dao = new TarefaDAO;
        }

        public function lerTodasTarefas() {
            $dados = $this->dao->lerTodasTarefas();
            echo json_encode($dados);
        }

        public function cadastrarTarefa() {
            try {
                $dados = json_decode(file_get_contents('php://input', true));
                if(!$dados) {
                    throw new Exception("Dados de requisição inválidos.");
                }

                $tarefa = new Tarefa(
                    $dados['nome'],
                    $dados['descricao'],
                    $dados['tipo'],
                    $dados['dataTermino'],
                    date("c")
                );

                $novaTarefa = $this->dao->cadastrarTarefa($tarefa);
                http_response_code(201);
                echo json_encode($novaTarefa);
            } catch (Exception $e) {
                throw $e;
            }
        }
    }