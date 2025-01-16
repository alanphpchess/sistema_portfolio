let autoScrollInterval;

function addTask(column) {
    const input = document.getElementById(`taskInput${column.charAt(0).toUpperCase() + column.slice(1)}`);
    const taskText = input.value.trim();

    if (taskText) {
        const task = document.createElement('div');
        task.className = 'task';
        task.textContent = taskText;
        task.draggable = true;

        task.addEventListener('dragstart', () => {
            task.classList.add('dragging');
            startAutoScroll(event); // Passa o evento aqui para usar a posição do mouse
        });

        task.addEventListener('dragend', () => {
            task.classList.remove('dragging');
            stopAutoScroll();
        });

        document.getElementById(`tasks-${column}`).appendChild(task);
        input.value = '';

        setupDropZones(); // Reconfigura as zonas de arraste após adicionar a tarefa
    }
}

function addColumn() {
    const newColumnName = document.getElementById('newColumnInput').value.trim();
    if (newColumnName) {
        const newColumn = document.createElement('div');
        newColumn.className = 'column';
        newColumn.innerHTML = `
            <div class="column-title">${newColumnName}</div>
            <div class="tasks" id="tasks-${newColumnName.toLowerCase().replace(/\s+/g, '-')}" ></div>
        `;
        document.querySelector('.kanban').appendChild(newColumn);
        document.getElementById('newColumnInput').value = '';

        setupDropZones(); // Reconfigura as zonas de arraste após adicionar a coluna
    }
}

function setupDropZones() {
    document.querySelectorAll('.tasks').forEach(column => {
        column.addEventListener('dragover', (e) => {
            e.preventDefault();
            column.classList.add('drag-over');

            // Detecta a tarefa onde a tarefa está sendo arrastada
            const dragging = document.querySelector('.dragging');
            const afterElement = getDragAfterElement(column, e.clientY);

            if (afterElement == null) {
                column.appendChild(dragging);
            } else {
                column.insertBefore(dragging, afterElement);
            }
        });

        column.addEventListener('dragleave', () => {
            column.classList.remove('drag-over');
        });


        column.addEventListener('drop', (e) => {
            e.preventDefault();
            column.classList.remove('drag-over');
            
            const dragging = document.querySelector('.dragging');
            if (dragging) {

                const afterElement = getDragAfterElement(column, e.clientY);
                if (afterElement == null) {
                    column.appendChild(dragging);
                } else {
                    column.insertBefore(dragging, afterElement);
                }
        
                const columnIdTask = column.getAttribute('data-id_task');
                console.log('A tarefa foi solta na coluna com data-id_task:', columnIdTask);
                
    
                    const tasksInColumn = column.querySelectorAll('.task'); 
        
                    const ordemKanbanList = Array.from(tasksInColumn).map(task => task.getAttribute('data-ordem_kanban'));
                    console.log('Todos os data-ordem_kanban na coluna:', ordemKanbanList);
        
                    const id_kanban_solto = dragging.getAttribute('data-ordem_kanban');
                    console.log('A tarefa solta tem o data-ordem_kanban:', id_kanban_solto);
        
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') // CSRF token para segurança
                        },
                        method: 'POST',
                        url: '/admin/clientes/kanban/atualizar', 
                        contentType: 'application/json', 
                        data: JSON.stringify({
                            id_status: columnIdTask,         // ID da coluna onde a tarefa foi solta
                            clienteIds: ordemKanbanList,   // Clientes da Coluna Kanban
                            id_cliente: id_kanban_solto    // ID do Kanban da tarefa que foi solta
                        }),
                        dataType: 'json',
                        beforeSend: function () {
                           
                        },
                        success: function (data) {

                            // $('#title_' + data.cliente_id).text(data.titulo_status);
                            $('#title_card_' + data.cliente_id).attr('style', 'background: ' + data.cor + ' !important;');
                            $('#tabelaClientes').DataTable().ajax.reload(); 
                        },
                        error: function (xhr, status, error) {
                        
                            console.error('Erro ao atualizar o Kanban:', error);
                        },
                        complete: function () {
                      
                        }
                    });
   
            }
        });
        
    });

    // Configura os eventos de dragstart e dragend para tarefas já presentes
    document.querySelectorAll('.task').forEach(task => {
        task.addEventListener('dragstart', (event) => {
            task.classList.add('dragging');
            startAutoScroll(event); // Passa o evento aqui para usar a posição do mouse
        });

        task.addEventListener('dragend', () => {
            task.classList.remove('dragging');
            stopAutoScroll();
        });
    });
}


// Função para determinar o elemento após o qual o item arrastado deve ser inserido
function getDragAfterElement(column, y) {
    const draggableElements = [...column.querySelectorAll('.task:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}



function startAutoScroll(event) {
    clearInterval(autoScrollInterval);
    autoScrollInterval = setInterval(() => {
        document.querySelectorAll('.column').forEach(column => {
            const rect = column.getBoundingClientRect();
            const dragger = document.querySelector('.dragging');

            if (dragger) {
                const mouseY = event.clientY; // Posição Y do mouse
                const mouseX = event.clientX; // Posição X do mouse

                // **Rolagem Vertical**
                // Calcula o deslocamento em relação ao centro da tela
                const offsetY = rect.top + rect.height / 2 - window.innerHeight / 2;

                // Se a tarefa estiver muito abaixo da tela (desce)
                if (offsetY > 100) {
                    column.scrollTop += 10; // Rola para baixo
                }
                // Se a tarefa estiver muito acima da tela (sobe)
                else if (offsetY < -100) {
                    column.scrollTop -= 10; // Rola para cima
                }

                // **Rolagem Horizontal**
                const container = document.querySelector('.kanban-container');
                const containerRect = container.getBoundingClientRect();

                // Rolagem para a esquerda (quando o mouse está muito à esquerda da área visível)
                if (mouseX < containerRect.left + 50) { // 50px da borda esquerda
                    container.scrollLeft -= 10; // Rola para a esquerda
                }
                // Rolagem para a direita (quando o mouse está muito à direita da área visível)
                else if (mouseX > containerRect.right - 50) { // 50px da borda direita
                    container.scrollLeft += 10; // Rola para a direita
                }
            }
        });
    }, 100);
}

function stopAutoScroll() {
    clearInterval(autoScrollInterval);
}

// Configuração inicial das zonas de arraste
document.addEventListener('DOMContentLoaded', () => {
    setupDropZones();
});

