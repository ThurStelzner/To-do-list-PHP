<?php
    require_once __DIR__ . "/../../config/conexao.php";   
    require_once __DIR__ . "/../models/tarefa.php";

    date_default_timezone_set('America/Sao_Paulo');

    class TarefaDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = Conexao::getConexao();
        }

        public function cadastrarTarefa(Tarefa $tarefa) {
            try {
                $tipo = $tarefa->getTipo();
                switch($tipo) {
                    case 0:
                        $tipo = 'básico';
                        break;
                    case 1:
                        $tipo = 'mediano';
                        break;
                    case 2:
                        $tipo = 'urgente';
                        break;
                    default:
                        $tipo = null;
                }
                $sql = "INSERT INTO 
                        tb_tarefas(nm_nome, ds_descricao, ds_tipo, dt_termino, dt_criacao)
                        VALUES (?,?,?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    $tarefa->getNome(),
                    $tarefa->getDescricao(),
                    $tipo,
                    $tarefa->getDataTermino(),
                    date("Y-m-d H:i:s")
                ]);
                $id = $this->pdo->lastInsertId();
                $tarefa->setId($id);
            }
            catch (Exception $e) {
                error_log("Erro: " . $e->getMessage());
                throw $e;
            }
        }

        public function lerTodasTarefas() {
            try {
                $sql = "SELECT * FROM tb_tarefas ORDER BY ds_tipo";
                $stmt = $this->pdo->query($sql);

                $tarefas = [];

                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $tarefa = new Tarefa(
                        $dados['nm_nome'],
                        $dados['ds_descricao'],
                        $dados['ds_tipo'],
                        $dados['dt_termino'],
                        $dados['dt_criacao']
                    );
                    $tarefa->setId($dados['id']);
                    $tarefas[] = $tarefa;
                }
                return $tarefas;
            }
            catch (Exception $e) {
                throw $e;
            }
        }

        public function lerTarefaId($id) {
            $sql = "SELECT * FROM tb_tarefas WHERE id=?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            $tarefa = new Tarefa($dados['nm_nome'], $dados['ds_descricao'], $dados['ds_tipo'], $dados['dt_termino'], $dados['dt_criacao']);
            $tarefa->setId($dados['id']);
            return $tarefa;
        }

        public function editarTarefa(Tarefa $t) {
            $tipo = $t->getTipo();
            switch($tipo) {
                case 0:
                    $tipo = 'básico';
                    break;
                case 1:
                    $tipo = 'mediano';
                    break;
                case 2:
                    $tipo = 'urgente';
                    break;
                default:
                    $tipo = null;
            }
            $sql = "UPDATE tb_tarefas SET nm_nome = ?, ds_descricao = ?, ds_tipo = ?, dt_termino = ?, dt_criacao = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $t->getNome(),
                $t->getDescricao(),
                $tipo,
                $t->getDataTermino(),
                date("Y-m-d H:i:s"),
                $t->getId()
            ]);
            return $t;
        }

        public function deletarTarefa($id) {
            try{
                $sql = "DELETE FROM tb_tarefas WHERE id = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id]);
            }
            catch (Exception $e) {
                throw $e;          
            }
        }
    };