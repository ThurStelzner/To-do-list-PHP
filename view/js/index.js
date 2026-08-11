document.addEventListener("DOMContentLoaded", () => {
    const URL_BASE_API = "/api/tarefas";
    
    const tarefaIdInput = document.getElementById("tarefaId");
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

            if(listaTarefas){
                // Limpo a tabela antes de inserir algo
                listaTarefas.innerHTML = '';
                tarefas.forEach(tarefa => {
                    const card = document.createElement('div');
                    card.classList.add('card');
                    card.innerHTML = `
                        <h3>${tarefa.nome}</h3>
                        <span>${tarefa.descricao}</span>
                        <strong>${tarefa.tipo}</strong>
                        <p>Até: ${tarefa.dataTermino}</p>
                        <p>Criado em: ${tarefa.dataCriado}</p>
                        <button commandFor='${tarefa.id}' command='show-modal'>...</button>
                    `
                    listaTarefas.appendChild(card);
                });
                tarefas.forEach(tarefa => {
                    const modal = document.createElement('dialog');
                    modal.classList.add('modal');
                    modal.id = (tarefa.id);
                    modal.innerHTML = `
                        <button commandFor='${tarefa.id}' command='close'>X</button>
                        <button onclick="window.location.href = 'view/formulario.php?id=${tarefa.id}'">Editar Tarefa</button>
                        Adicionar exclusão
                    `;
                    listaTarefas.appendChild(modal);
                })
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

            const tarefaId = tarefaIdInput.value;
            const url = tarefaId ? `${URL_BASE_API}/${tarefaId}` : URL_BASE_API;
            const method = tarefaId ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(tarefa)
                })

                const resultado = await response.json();

                if(response.ok) {
                    alert(tarefaId ? "Tarefa editada com sucesso!" : "Tarefa cadastrada com sucesso!");
                    window.location.href = "/"
                } else {
                    alert("Ocorreu um erro na requisição: ", resultado)
                }
            }
            catch(error) {
                console.error("Erro de requisição: ", error);
                alert("Erro crítico");
            }
        })
    };
});

