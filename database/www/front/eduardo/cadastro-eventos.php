<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">*Novo Evento</h3>
        <hr> 
        <form name="cadastro" method="post" action="cadastrar">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <small><b>*Título do Evento</b></small>
                    <input class="form-control" type="text" name="nome_evento" placeholder="Digite o título do evento" autocomplete="off" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <small><b>*Local</b></small>
                    <input class="form-control" type="text" name="local_evento" placeholder="Digite o local do evento" autocomplete="off" required>
                </div>
                <div class="col-sm-4 mb-3">
                    <small><b>*Capacidade (número de pessoas)</b></small>
                    <input class="form-control" type="number" name="capacidade" placeholder="Digite a capacidade" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">*Descrição do Evento</label>
                    <textarea class="form-control" id="descricao" name="descricao_evento" rows="3" placeholder="Descreva o evento" required></textarea>
                </div>
                <div class="col-sm-3 mb-3">
                    <small><b>*Data do Evento</b></small>
                    <input class="form-control" type="date" name="data_evento" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <small><b>*Hora do Evento</b></small>
                    <input class="form-control" type="time" name="hora_evento" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Evento</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
