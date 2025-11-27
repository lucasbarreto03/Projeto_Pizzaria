<h1>Cadastrar Cliente</h1>
<form action="?page=salvar-cliente" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="mb-3">
        <label>Nome
            <input type="text" name="nome_cliente" class="form-control" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>CPF
            <input type="text" name="cpf_cliente" class="form-control">
        </label>
    </div>
    
    <div class="mb-3">
        <label>E-mail
            <input type="email" name="email_cliente" class="form-control">
        </label>
    </div>
    
    <div class="mb-3">
        <label>Telefone (Contato/WhatsApp)
            <input type="text" name="telefone_cliente" class="form-control" required>
        </label>
    </div>
    
    <hr>
    <h3>Endereço para Entrega</h3>
    
    <div class="mb-3">
        <label>Endereço (Rua, Av, Bairro)
            <input type="text" name="endereco_cliente" class="form-control" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Complemento (Número, Apto, Bloco)
            <input type="text" name="complemento_endereco" class="form-control" required> 
        </label>
    </div>
    
    <hr>

    <div class="mb-3">
        <label>Data de Nascimento
            <input type="date" name="dt_nasc_cliente" class="form-control">
        </label>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">
            Cadastrar Cliente
        </button>
        <a href="?page=index.php" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>