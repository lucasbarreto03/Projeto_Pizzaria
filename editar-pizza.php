<h1>Editar Pizza</h1>
<?php
    // 1. QUERY PRINCIPAL: Carrega os dados da pizza atual
    $id_pizza = $_REQUEST['id_pizza']; // CORREÇÃO: Deve ser id_pizza
    
    $sql_pizza = "SELECT * FROM pizza WHERE id_pizza={$id_pizza}";
    $res_pizza = $conn->query($sql_pizza);
    $row_pizza = $res_pizza->fetch_object();
    
    // Verificação de segurança
    if(!$row_pizza) {
        print "<div class='alert alert-danger'>Pizza não encontrada!</div>";
        exit;
    }

    // 2. QUERY N:M: Carrega os ingredientes já associados a esta pizza
    $sql_ingredientes_atuais = "SELECT ingrediente_id FROM pizza_ingrediente WHERE pizza_id={$id_pizza}";
    $res_atuais = $conn->query($sql_ingredientes_atuais);
    
    // Cria um array para verificação rápida dos ingredientes atuais
    $ingredientes_atuais = [];
    if($res_atuais->num_rows > 0){
        while($row_atual = $res_atuais->fetch_object()){
            $ingredientes_atuais[$row_atual->ingrediente_id] = true;
        }
    }

    // 3. QUERY SECUNDÁRIA: Carrega TODOS os ingredientes disponíveis
    $sql_todos_ingredientes = "SELECT * FROM ingrediente ORDER BY nome_ingrediente ASC";
    $res_todos = $conn->query($sql_todos_ingredientes);
?>

<form action="?page=salvar-pizza" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_pizza" value="<?php echo $row_pizza->id_pizza; ?>">
    
    <div class="mb-3">
        <label>Nome da Pizza
            <input type="text" name="nome_pizza" value="<?php echo $row_pizza->nome_pizza; ?>" class="form-control" required>
        </label>
    </div> 

    <div class="mb-3">
        <label>Preço Base (R$)
            <input type="number" name="preco_base" value="<?php echo $row_pizza->preco_base; ?>" class="form-control" step="0.01" required>
        </label>
    </div>

    <div class="mb-3">
        <label>Tamanho Padrão 
            <select name="tamanho_pizza" class="form-control" required>
                <option value="">Selecione o tamanho</option>
                <?php
                    $opcoes_tamanho = ["Pequena", "Média", "Grande", "Família"];
                    $tamanho_atual = $row_pizza->tamanho_pizza;
                    
                    foreach ($opcoes_tamanho as $tamanho) {
                        $selected = ($tamanho == $tamanho_atual) ? 'selected' : '';
                        print "<option value='{$tamanho}' {$selected}>{$tamanho}</option>";
                    }
                ?>
            </select>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Categoria 
            <select name="categoria_pizza" class="form-control" required>
                <option value="">Selecione a categoria</option>
                <?php
                    $opcoes_categoria = ["Salgada", "Doce", "Vegetariana", "Especial"];
                    $categoria_atual = $row_pizza->categoria_pizza;
                    
                    foreach ($opcoes_categoria as $categoria) {
                        $selected = ($categoria == $categoria_atual) ? 'selected' : '';
                        print "<option value='{$categoria}' {$selected}>{$categoria}</option>";
                    }
                ?>
            </select>
        </label>
    </div>

    <hr>
    
    <div class="mb-3">
        <label>Ingredientes</label>
        <div class="form-control" style="height: 150px; overflow-y: scroll;">
            <?php
                if($res_todos->num_rows > 0){
                    while($row_todo = $res_todos->fetch_object()){
                        
                        // Verifica se este ingrediente já faz parte da receita
                        $checked = isset($ingredientes_atuais[$row_todo->id_ingrediente]) ? 'checked' : '';
                        
                        print "
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='ingredientes_selecionados[]' value='{$row_todo->id_ingrediente}' {$checked} id='ingrediente_{$row_todo->id_ingrediente}'>
                            <label class='form-check-label' for='ingrediente_{$row_todo->id_ingrediente}'>
                                {$row_todo->nome_ingrediente} ({$row_todo->unidade_medida})
                            </label>
                        </div>";
                    }
                }
                else{
                    print "<p class='text-danger'>Nenhum ingrediente encontrado! Cadastre ingredientes primeiro.</p>";
                }
            ?>
        </div>
    </div>
    
    <hr>
    
    <div>
        <button type="submit" class="btn btn-primary">
            Salvar Edição
        </button>
        <a href="?page=listar-pizza" class="btn btn-secondary">
            Cancelar
        </a>
    </div>
</form>