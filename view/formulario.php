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
            <option value="0">Básico</option>
            <option value="1">Mediano</option>
            <option value="2">Urgente</option>
        </select>
        <label for="dataTermino">Tarefa a ser realisada até</label>
        <input type="datetime-local" id="dataTermino" name="dataTermino" require>
        <button type="submit">Enviar</button>
    </form>
    <script src="js/index.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async () => {

            const urlAtual = window.location.href;
            const url = new URL(urlAtual);
            const id = url.searchParams.get("id");

            if(id) {
                const tarefaIdInput = document.getElementById("tarefaId");
                const nomeTarefa = document.getElementById("nome");
                const descricaoTarefa = document.getElementById("descricao");
                const tipoTarefa = document.getElementById("tipo");
                const dataTarefaTermino = document.getElementById("dataTermino");

                const response = await fetch(`/api/tarefas/${id}`);
                if(!response.ok) throw new error("Tarefa não encontrada.");
                const tarefa = await response.json();
                tarefaIdInput.value = tarefa.id;
                nomeTarefa.value = tarefa.nome;
                descricaoTarefa.value = tarefa.descricao;
                switch(tarefa.tipo) {
                    case "básico":
                        tipoTarefa.value = 0;
                        break;
                    case "mediano":
                        tipoTarefa.value = 1;
                        break;
                    case "urgente":
                        tipoTarefa.value = 2;
                        break;
                };
                dataTarefaTermino.value = tarefa.dataTermino;
            };
        });
    </script>
<?php require __DIR__ . "/footer.html" ?>