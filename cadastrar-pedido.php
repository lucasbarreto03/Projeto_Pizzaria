<h1>Cadastrar Novo Pedido</h1>
<form action="?page=salvar-pedido" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="row">
        <div class="col-md-5">
            <h3>Dados do Pedido</h3>
            
            <div class="mb-3">
                <label>Cliente
                    <select name="cliente_id_cliente" class="form-control" required>
                        <option value="">Selecione o cliente</option>
                        <?php
                            $sql = "SELECT * FROM cliente ORDER BY nome_cliente ASC";
                            $res = $conn->query($sql);
                            if($res->num_rows > 0){
                                while($row = $res->fetch_object()){
                                    print "<option value='{$row->id_cliente}'>{$row->nome_cliente} - ({$row->endereco_cliente})</option>";
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
                <label>Entregador (Opcional)
                    <select name="entregador_id_entregador" class="form-control"> 
                        <option value="">Selecione se já houver um designado</option>
                        <?php
                            $sql = "SELECT * FROM entregador ORDER BY nome_entregador ASC";
                            $res = $conn->query($sql);
                            if($res->num_rows > 0){
                                while($row = $res->fetch_object()){
                                    print "<option value='{$row->id_entregador}'>{$row->nome_entregador}</option>";
                                }
                            }
                        ?>
                    </select>
                </label>
            </div>

            <div class="mb-3">
                <label>Status Inicial
                    <select name="status_pedido" class="form-control" required>
                        <option value="Pendente">Pendente</option>
                        <option value="Em Preparo">Em Preparo</option>
                        <option value="Saiu para Entrega">Saiu para Entrega</option>
                        <option value="Entregue">Entregue</option>
                    </select>
                </label>
            </div>
            
            <div class="mb-3">
                <label>Data e Hora do Pedido
                    <input type="datetime-local" name="data_pedido" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>" required> 
                </label>
            </div>

            <div class="card bg-light mt-4">
                <div class="card-body text-center">
                    <h4>Total Estimado</h4>
                    <h2 class="text-success" id="valorTotalDisplay">R$ 0,00</h2>
                </div>
            </div>
            
        </div>
        
        <div class="col-md-7">
            <h3>Cardápio (Selecione os Itens)</h3>
            
            <div style="height: 500px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                <table class="table table-sm table-hover">
                    <thead class="table-light" style="position: sticky; top: 0;">
                        <tr>
                            <th>Selecionar</th>
                            <th>Preço Unit.</th>
                            <th style="width: 100px;">Qtd.</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT id_pizza, nome_pizza, tamanho_pizza, preco_base FROM pizza ORDER BY nome_pizza ASC"; 
                        $res = $conn->query($sql);
                        
                        if($res->num_rows > 0){
                            while($row = $res->fetch_object()){
                                print "<tr>";
                                print "<td>
                                            <div class='form-check'>
                                                <input class='form-check-input item-checkbox' type='checkbox' 
                                                       name='pizzas_selecionadas[]' 
                                                       value='{$row->id_pizza}' 
                                                       data-price='{$row->preco_base}' 
                                                       id='pizza_{$row->id_pizza}'
                                                       onchange='calcularTotal()'>
                                                <label class='form-check-label' for='pizza_{$row->id_pizza}'>
                                                    <strong>{$row->nome_pizza}</strong> <br>
                                                    <small class='text-muted'>{$row->tamanho_pizza}</small>
                                                </label>
                                            </div>
                                       </td>";
                                
                                print "<td>R$ ".number_format($row->preco_base, 2, ',', '.')."</td>";
                                
                                print "<td>
                                            <input type='number' 
                                                   name='quantidade_{$row->id_pizza}' 
                                                   min='1' value='1' 
                                                   class='form-control form-control-sm item-quantity' 
                                                   onchange='calcularTotal()' 
                                                   onkeyup='calcularTotal()'>
                                       </td>";
                                print "</tr>";
                            }
                        }
                        else{
                            print "<tr><td colspan='3' class='text-center'>Nenhuma pizza cadastrada.</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <hr>
    
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            Finalizar Pedido
        </button>
        <a href="?page=index.php" class="btn btn-secondary">
            Cancelar
        </a>
    </div>
</form>

<script>
    function calcularTotal() {
        let total = 0;
        const checkboxes = document.querySelectorAll('.item-checkbox');
        
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.getAttribute('data-price'));
                // Encontra o input de quantidade na mesma linha (tr)
                const row = checkbox.closest('tr');
                const quantityInput = row.querySelector('.item-quantity');
                const quantity = parseInt(quantityInput.value) || 1;
                
                total += price * quantity;
            }
        });
        
        // Formata para Real Brasileiro
        const formattedTotal = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        document.getElementById('valorTotalDisplay').innerText = formattedTotal;
    }
</script>