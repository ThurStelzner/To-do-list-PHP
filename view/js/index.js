document.addEventListener("DOMContentLoaded", () => {
    const URL_BASE_API = "/api/tarefas";

    const listaTarefas = document.getElementById("listaTarefas");
    const formTarefas = document.getElementById("formTarefas");
    const nomeTarefa = document.getElementById("nome");
    const descricaoTarefa = document.getElementById("descricao");
    const tipoTarefa = document.getElementById("tipo");
    const dataTarefaTermino = document.getElementById("dataTermino");
    const hoje =  new Date();

    async function lerTodasTarefas() {
        try {
            const response = await fetch(URL_BASE_API);

            if(!response.ok) {
                throw new Error("Erro ao buscar lista.");
            };
            
            const tarefas = await response.json();
            console.log(tarefas)

            // Limpo a tabela antes de inserir algo
            if(listaTarefas){
                listaTarefas.innerHTML = '';
                tarefas.forEach(tarefa => {
                    const card = document.createElement('div');
                    card.classList.add('card');
                    card.innerHTML = `
                        <h3>${tarefa.nome}</h3>
                        <span>${tarefa.descricao}</span>
                        <strong>${tarefa.tipo}</strong>
                        <p>${tarefa.dataTermino}</p>
                        <p>Criado em: ${tarefa.dataCriado}</p>
                        <button>...</button>
                    `
                    listaTarefas.appendChild(card)
                });
            }
        }
        catch(error) {
            console.error("Erro: ", error);
        };
    };
    lerTodasTarefas()
    if(formTarefas) {
        formTarefas.addEventListener("submit", async (e) => {
            e.preventDefault();
            const tarefa = {
                nome: nomeTarefa.value,
                descricao: descricaoTarefa.value,
                tipo: tipoTarefa.value,
                dataTermino: dataTarefaTermino.value
            };

            console.log(JSON.stringify(tarefa))

            const url = URL_BASE_API;
            const method = 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(tarefa)
                })

                const resultado = await response.json();

                if(response.ok) {
                    alert("Tarefa cadastrada com sucesso!");
                } else {
                    alert("Ocorreu um erro na requisição: ", resultado)
                }
            }
            catch(error) {
                console.error("Erro de requisição: ", error);
                alert("Erro crítico");
            }
        })
    }
});