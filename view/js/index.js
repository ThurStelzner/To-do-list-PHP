document.addEventListener("DOMContentLoaded", () => {

    const URL_BASE_API = "/api/tarefas";

    const listaTarefas = document.getElementById("listaTarefas");

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
});