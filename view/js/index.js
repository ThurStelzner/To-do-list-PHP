document.addEventListener("DOMContentLoaded", () => {

    const URL_BASE_API = "/api/tarefas";

    const listaTarefas = document.getElementById("listaTarefas");
    const formTarefas = document.getElementById("formTarefas");
    const nomeTarefa = document.getElementById("nome");
    const descricaoTarefa = document.getElementById("descricao");
    const tipoTarefa = document.getElementById("tipo");
    const dataTarefaTermino = document.getElementById("dataTermino");

    async function lerTodasTarefas() {
        try {
            const response = await fetch(URL_BASE_API);

            if(!response.ok) {
                throw new Error("Erro ao buscar lista.");
            };
            
            const tarefas = await response.json();
            console.log(tarefas)

            // Limpo a tabela antes de inserir algo
            listaTarefas.innerHTML = '';
            tarefas.forEach(tarefa => {
                const card = document.createElement('div');
                card.classList.add('card');
                card.innerHTML = `
                    <h3>${tarefa.nome}</h3>
                    <span>${tarefa.descricao}</span>
                    <strong>${tarefa.tipo}</strong>
                    <p>${tarefa.dataTermino}</p>
                    <p>${tarefa.dataCriado}</p>
                    <button>...</button>
                `
                listaTarefas.appendChild(card)
            });
        }
        catch(error) {
            console.error("Erro: ", error);
        };
    };
    lerTodasTarefas()

    formTarefas.addEventListener("submit", async (e) => {
        e.preventDefault();
        const tarefa = {
            nome: nomeTarefa.value,
            descricao: descricaoTarefa.value,
            tipo: tipoTarefa.value,
            dataTermino: dataTarefaTermino.value
        };

        const url = URL_BASE_API;
        const method = "POST";

        try {
            const response = await fetch(url, {
                method: method,
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(tarefa)
            })

            if(response.ok) {
                alert("Tarefa cadastrada com sucesso!");
                window.location.href("/");
            } else {
                alert("Ocorreu um erro na requisição.")
            }
        }
        catch(error) {
            console.error("Erro de requisição: ", error);
            alert("Erro crítico");
        }
    })
});