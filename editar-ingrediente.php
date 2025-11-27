<h1>Editar Ingrediente</h1>
<?php
    // CORREÇÃO: O nome do parâmetro deve ser id_ingrediente (igual ao listar-ingrediente.php)
    $id_ingrediente = $_REQUEST['id_ingrediente'];
    
    $sql = "SELECT * FROM ingrediente WHERE id_ingrediente=".$id_ingrediente;
    
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>
<form action="?page=salvar-ingrediente" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_ingrediente" value="<?php echo $row->id_ingrediente; ?>">
    
    <div class="mb-3">
        <label>Nome do Ingrediente
            <input type="text" name="nome_ingrediente" class="form-control" value="<?php echo $row->nome_ingrediente; ?>" required>
        </label>
    </div>
    
    <div class="mb-3">
        <label>Unidade de Medida
            <select name="unidade_medida" class="form-control" required>
                <option value="">Selecione a Unidade</option>
                <?php
                    $unidade_atual = $row->unidade_medida;
                    // Define as opções de unidade padrão para padronizar o cadastro
                    $opcoes_unidade = ["g", "kg", "ml", "L", "un"]; 
                    
                    foreach ($opcoes_unidade as $unidade) {
                        // Verifica se essa é a unidade atual do ingrediente para marcá-la como selecionada
                        $selected = ($unidade == $unidade_atual) ? 'selected' : '';
                        
                        // Melhora a exibição visual (ex: 'un' vira 'Unidade (un)')
                        $nome_exibicao = ($unidade == 'un') ? 'Unidade (un)' : strtoupper($unidade);
                        
                        print "<option value='{$unidade}' {$selected}>{$nome_exibicao}</option>";
                    }
                ?>
            </select>
        </label>
    </div>
    
    <div>
        <button type="submit" class="btn btn-primary">
            Salvar Edição do Ingrediente
        </button>
        <a href="?page=listar-ingrediente" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>