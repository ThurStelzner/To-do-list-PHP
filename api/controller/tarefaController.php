<?php
    require_once __DIR__ . "/../models/tarefaDAO.php";

    class TarefaController {
        private $dao;

        public function __construct() {
            $this->dao = new TarefaDAO;
        }

        public function lerTodasTarefas() {
            try {
                $dados = $this->dao->lerTodasTarefas();
                echo json_encode($dados);
            }
            catch (Exception $e) {
                throw $e;
            }
        }

        public function lerTarefaId($id) {
            try {
                $tarefa = $this->dao->lerTarefaId($id);
                echo json_encode($tarefa);
            }
            catch (Exception $e) {
                throw $e;
            }
        }

        public function cadastrarTarefa() {
            try {
                $dados = json_decode(file_get_contents('php://input'), true);
                if(!$dados) {
                    throw new Exception("Dados de requisição inválidos.");
                }

                $tarefa = new Tarefa(
                    $dados['nome'] ?? "",
                    $dados['descricao'] ?? "",
                    $dados['tipo'] ?? "",
                    $dados['dataTermino'] ?? "",
                    $dados['dataCriado'] ?? ""
                );

                $novaTarefa = $this->dao->cadastrarTarefa($tarefa);
                http_response_code(201);
                echo json_encode($novaTarefa);
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function editarTarefa($id) {
            try {
                $dados = json_decode(file_get_contents('php://input'), true);
                if(!$dados) {
                    throw new Exception("Dados de requisição inválidos.");
                }

                $tarefa = new Tarefa(
                    $dados['nome'] ?? "",
                    $dados['descricao'] ?? "",
                    $dados['tipo'] ?? 0,
                    $dados['dataTermino'] ?? "",
                    $dados['dataCriado'] ?? ""
                );

                $tarefa->setId($id);

                $tarefaEditada = $this->dao->editarTarefa($tarefa);
                echo json_encode($tarefaEditada);
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function deletarTarefa($id) {
            try {
                $dados = $this->dao->deletarTarefa($id);
                http_response_code(204);
            }
            catch (Exception $e) {
                throw $e;
            }
        }
    }