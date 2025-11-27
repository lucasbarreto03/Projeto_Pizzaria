<h1>Cadastrar Nova Pizza</h1>
<form action="?page=salvar-pizza" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="mb-3">
        <label>Nome da Pizza
            <input type="text" name="nome_pizza" class="form-control" required>
        </label>
    </div>

    <div class="mb-3">
        <label>Preço Base (R$)
            <input type="number" name="preco_base" class="form-control" step="0.01" required>
        </label>
    </div>

    <div class="mb-3">
        <label>Tamanho Padrão
            <select name="tamanho_pizza" class="form-control" required>
                <option value="">Selecione o tamanho</option>
                <option value="Pequena">Pequena</option>
                <option value="Média">Média</option>
                <option value="Grande">Grande</option>
                <option value="Família">Família</option>
            </select>
        </label>
    </div>

    <div class="mb-3">
        <label>Categoria
            <select name="categoria_pizza" class="form-control" required>
                <option value="">Selecione a categoria</option>
                <option value="Salgada">Salgada</option>
                <option value="Doce">Doce</option>
                <option value="Vegetariana">Vegetariana</option>
                <option value="Especial">Especial</option>
            </select>
        </label>
    </div>

    <hr>
    
    <div class="mb-3">
        <label>Ingredientes (Selecione a Receita)</label>
        <div class="form-control" style="height: 150px; overflow-y: scroll;">
            <?php
                $sql = "SELECT * FROM ingrediente ORDER BY nome_ingrediente ASC";
                $res = $conn->query($sql);
                
                if($res->num_rows > 0){
                    while($row = $res->fetch_object()){
                        print "
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='ingredientes_selecionados[]' value='{$row->id_ingrediente}' id='ingrediente_{$row->id_ingrediente}'>
                            <label class='form-check-label' for='ingrediente_{$row->id_ingrediente}'>
                                {$row->nome_ingrediente} ({$row->unidade_medida})
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
            Cadastrar Pizza
        </button>
        <a href="?page=index.php" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>