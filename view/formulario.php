<?php
    require __DIR__ . "/header.html";
?>

    <form id="formTarefas">
        <input type="hidden" id="tarefaId">
        <label for="nome">Nome da tarefa</label>
        <input type="text" name="nome" id="nome" require>
        <label for="descricao">Descreva a tarefa</label>
        <textarea id="descricao" name="descricao"></textarea>
        <label for="tipo">Qual o tipo da tarefa?</label>
        <select name="tipo" id="tipo">
            <option value="0">Básica</option>
            <option value="1">Mediana</option>
            <option value="2">Urgente</option>
        </select>
        <label for="dataTermino">Tarefa a ser realisada até</label>
        <input type="datetime-local" id="dataTermino" name="dataTermino" require>
        <button type="submit">Cadastrar</button>
    </form>
    <script src="js/index.js"></script>

<?php require __DIR__ . "/footer.html" ?>