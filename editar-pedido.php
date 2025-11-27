<h1>Detalhes e Edição do Pedido</h1>
<?php
    $id_pedido = $_REQUEST['id_pedido']; // Usando 'id_pedido' conforme listagem
    
    // Consulta na tabela 'pedido'
    $sql = "SELECT * FROM pedido WHERE id_pedido=".$id_pedido;
    $res = $conn->query($sql);
    $row_pedido = $res->fetch_object();
    
    // Verificação de segurança
    if (!$row_pedido) {
        print "<div class='alert alert-danger'>Pedido não encontrado.</div>";
        exit;
    }
?>
<form action="?page=salvar-pedido" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_pedido" value="<?php print $row_pedido->id_pedido; ?>">
    <input type="hidden" name="valor_total" value="<?php print $row_pedido->valor_total; ?>"> 

    <div class="mb-3">
        <label>Valor Total do Pedido (R$)
            <input type="text" class="form-control" value="<?php print number_format($row_pedido->valor_total, 2, ',', '.'); ?>" readonly>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Cliente
            <select name="cliente_id_cliente" class="form-control" required>
                <option value="">Selecione o cliente</option>
                <?php
                    $sql = "SELECT * FROM cliente ORDER BY nome_cliente ASC";
                    $res = $conn->query($sql);
                    if($res->num_rows > 0){
                        while($row = $res->fetch_object()){
                            $selected = ($row->id_cliente == $row_pedido->cliente_id_cliente) ? 'selected' : '';
                            print "<option value='{$row->id_cliente}' {$selected}>{$row->nome_cliente}</option>";
                        }
                    }
                    else{
                        print "<option value=''>Nenhum cliente encontrado</option>";
                    }
                ?>
            </select>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Entregador Designado
            <select name="entregador_id_entregador" class="form-control">
                <option value="">Nenhum (Retirada ou A Designar)</option>
                <?php
                    $sql = "SELECT * FROM entregador ORDER BY nome_entregador ASC";
                    $res = $conn->query($sql);
                    if($res->num_rows > 0){
                        while($row = $res->fetch_object()){
                            $selected = ($row->id_entregador == $row_pedido->entregador_id_entregador) ? 'selected' : '';
                            print "<option value='{$row->id_entregador}' {$selected}>{$row->nome_entregador}</option>";
                        }
                    }
                ?>
            </select>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Status do Pedido
            <select name="status_pedido" class="form-control" required>
                <?php
                    $status_atual = $row_pedido->status_pedido;
                    $opcoes_status = ["Pendente", "Em Preparo", "Saiu para Entrega", "Entregue", "Cancelado"];
                    
                    foreach ($opcoes_status as $status) {
                        $selected = ($status == $status_atual) ? 'selected' : '';
                        print "<option value='{$status}' {$selected}>{$status}</option>";
                    }
                ?>
            </select>
        </label>
    </div>

    <div class="mb-3">
        <label>Data e Hora do Pedido
            <?php $dt_local = date('Y-m-d\TH:i', strtotime($row_pedido->data_pedido)); ?>
            <input type="datetime-local" name="data_pedido" class="form-control" value="<?php print $dt_local; ?>" readonly>
        </label>
    </div>
    
    <div>
        <button type="submit" class="btn btn-primary">
            Atualizar Cabeçalho do Pedido
        </button>
        <a href="?page=listar-pedido" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>