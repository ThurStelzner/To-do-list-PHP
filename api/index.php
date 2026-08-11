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

    $controller = new TarefaController;
    
    $rotaBase = "/api/tarefas";
    $metodo = $_SERVER['REQUEST_METHOD'];

    // Fatia a URL para que reste apenas os caminhos
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Comparo para saber se a rotaBase foi achada
    if(strpos($uri, $rotaBase) === 0) {
         // Extrai o ID da URL se existir
        $partes = explode("/", trim(str_replace($rotaBase, "", $uri), "/"));
        $id = !empty($partes[0]) ? $partes[0] : null;
        if($metodo === "GET") {
            if($id) {
                $controller->lerTarefaId($id);
            } else {
                $controller->lerTodasTarefas();
            }
        }
        if($metodo === "POST") {
            $controller->cadastrarTarefa();
        }
        if($metodo === "PUT") {
            $controller->editarTarefa($id);
        }
        if($metodo === "DELETE") {
            $controller->deletarTarefa($id);
        }
    };