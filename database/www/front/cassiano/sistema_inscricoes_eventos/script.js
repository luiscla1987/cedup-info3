document.addEventListener('DOMContentLoaded', function() {
    carregarEventos();
    carregarInscricoes();
    
    // Configurar o formulário
    const form = document.getElementById('inscricaoForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        processarInscricao();
    });
});

function carregarEventos() {
    fetch('get_eventos.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('evento');
            select.innerHTML = '<option value="">Selecione um evento</option>';
            
            if (data.success && data.eventos.length > 0) {
                data.eventos.forEach(evento => {
                    const option = document.createElement('option');
                    option.value = evento.id_eventos;
                    option.textContent = `${evento.nome_eventos} - ${formatarData(evento.data_eventos)}`;
                    select.appendChild(option);
                });
            } else {
                select.innerHTML = '<option value="">Nenhum evento encontrado</option>';
            }
        })
        .catch(error => {
            console.error('Erro ao carregar eventos:', error);
            document.getElementById('evento').innerHTML = '<option value="">Erro ao carregar eventos</option>';
        });
}

function carregarInscricoes() {
    fetch('get_inscricoes.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('listaInscricoes');
            
            if (data.success && data.inscricoes.length > 0) {
                let html = '';
                data.inscricoes.forEach(inscricao => {
                    html += `
                        <div class="inscricao-item ${inscricao.status_inscricao}">
                            <div class="inscricao-info">
                                <div>
                                    <div class="inscricao-nome">${inscricao.nome_participante}</div>
                                    <div class="inscricao-evento">${inscricao.nome_eventos} - ${formatarData(inscricao.data_eventos)}</div>
                                </div>
                                <span class="inscricao-status status-${inscricao.status_inscricao}">
                                    ${inscricao.status_inscricao}
                                </span>
                            </div>
                        </div>
                    `;
                });
                container.innerHTML = html;
            } else {
                container.innerHTML = '<p>Nenhuma inscrição encontrada.</p>';
            }
        })
        .catch(error => {
            console.error('Erro ao carregar inscrições:', error);
            document.getElementById('listaInscricoes').innerHTML = '<p>Erro ao carregar inscrições.</p>';
        });
}

function processarInscricao() {
    const formData = new FormData(document.getElementById('inscricaoForm'));
    
    fetch('processa_inscricao.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        mostrarMensagem(data.message, data.success ? 'sucesso' : 'erro');
        
        if (data.success) {
            document.getElementById('inscricaoForm').reset();
            carregarInscricoes();
        }
    })
    .catch(error => {
        console.error('Erro ao processar inscrição:', error);
        mostrarMensagem('Erro ao processar a solicitação.', 'erro');
    });
}

function mostrarMensagem(texto, tipo) {
    const mensagem = document.getElementById('mensagem');
    mensagem.textContent = texto;
    mensagem.className = `mensagem ${tipo}`;
    mensagem.classList.add('show');
    
    setTimeout(() => {
        mensagem.classList.remove('show');
    }, 5000);
}

function formatarData(data) {
    const date = new Date(data);
    return date.toLocaleDateString('pt-BR');
}

