<h1>Cadastrar Ingrediente</h1>
<form action="?page=salvar-ingrediente" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="mb-3">
        <label>Nome do Ingrediente
            <input type="text" name="nome_ingrediente" class="form-control" required>
        </label>
    </div> 
    
    <div class="mb-3">
        <label>Unidade de Medida
            <select name="unidade_medida" class="form-control" required>
                <option value="">Selecione a Unidade</option>
                <option value="g">Gramas (g)</option>
                <option value="kg">Kilogramas (kg)</option>
                <option value="ml">Mililitros (ml)</option>
                <option value="L">Litros (L)</option>
                <option value="un">Unidade (un)</option>
            </select>
        </label>
    </div>
    
    <div>
        <button type="submit" class="btn btn-primary">
            Cadastrar Ingrediente
        </button>
        <a href="?page=index.php" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>