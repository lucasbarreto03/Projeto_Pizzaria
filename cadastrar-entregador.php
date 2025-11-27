<h1>Cadastrar Entregador</h1>
<form action="?page=salvar-entregador" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="mb-3">
        <label>Nome
            <input type="text" name="nome_entregador" class="form-control" required>
        </label>
    </div> 
    
    <div class="mb-3">
        <label>CPF
            <input type="text" name="cpf_entregador" class="form-control" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>E-mail
            <input type="email" name="email_entregador" class="form-control">
        </label>
    </div>
    
    <div class="mb-3">
        <label>Telefone
            <input type="text" name="telefone_entregador" class="form-control" required>
        </label>
    </div>
    
    <hr>
    
    <div class="mb-3">
        <label>Placa do Veículo
            <input type="text" name="placa_veiculo" class="form-control" placeholder="Ex: ABC-1234">
        </label>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">
            Cadastrar Entregador
        </button>
        <a href="?page=index.php" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>