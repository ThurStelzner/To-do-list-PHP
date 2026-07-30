<?php
    require_once __DIR__ . "/models/tarefa.php";
    require_once __DIR__ . "/models/tarefaDAO.php";

    $asd = new TarefaDAO;
    $asd->cadastrarTarefa(new Tarefa('asd', 'asd', 'basico', '2000-01-10', '9000-01-10'));