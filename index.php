<?php
    require_once __DIR__ . "/controller/tarefaController.php";

    session_start();

    // Define quais os "sites" que a minha API pode ser usada
    header("Access-Control-Allow-Origin: *");
    // Define os metodos que minha API aceita para o navegador
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    // Define os tipos de header que minha API aceita para o navegador
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // Define para o navegador que as respostas serão enviadas em JSON
    header("Content-Type: application/json");
    
    $rotaBase = "/tarefas";