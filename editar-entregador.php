<h1>Editar Entregador</h1>
<?php
    // CORREÇÃO IMPORTANTE: O nome do parâmetro deve ser igual ao enviado no listar-entregador.php
    $id_entregador = $_REQUEST['id_entregador']; 
    
    $sql = "SELECT * FROM entregador WHERE id_entregador=".$id_entregador;

    $res = $conn->query($sql);

    $row = $res->fetch_object();
?>
<form action="?page=salvar-entregador" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_entregador" value="<?php print $row->id_entregador; ?>">
    
    <div class="mb-3">
        <label>Nome
            <input type="text" name="nome_entregador" class="form-control" value="<?php print $row->nome_entregador; ?>" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>CPF
            <input type="text" name="cpf_entregador" class="form-control" value="<?php print $row->cpf_entregador; ?>" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>E-mail
            <input type="email" name="email_entregador" class="form-control" value="<?php print $row->email_entregador; ?>">
        </label>
    </div>
    
    <div class="mb-3">
        <label>Telefone
            <input type="text" name="telefone_entregador" class="form-control" value="<?php print $row->telefone_entregador; ?>" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Placa do Veículo
            <input type="text" name="placa_veiculo" class="form-control" value="<?php print $row->placa_veiculo; ?>">
        </label>
    </div>
    
    <div>
        <button type="submit" class="btn btn-primary">
            Salvar Edição do Entregador
        </button>
        <a href="?page=listar-entregador" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>