<?php
    require_once __DIR__ . "/../models/tarefaDAO.php";

    class TarefaController {
        private $dao;

        public function __construct() {
            $this->dao = new TarefaDAO;
        }

        public function lerTodasTarefas() {
            $tarefas = $this->dao->lerTodasTarefas();
            echo json_encode($tarefas);
        }
    }