<h1>Cardápio de Pizzas</h1>
<?php
    // A consulta SQL busca os dados da pizza e concatena os nomes dos ingredientes
    $sql = "SELECT 
                p.id_pizza,
                p.nome_pizza,
                p.preco_base,
                p.tamanho_pizza,
                p.categoria_pizza,
                
                -- Agrupa os nomes dos ingredientes em uma única string separada por vírgula
                GROUP_CONCAT(i.nome_ingrediente SEPARATOR ', ') AS lista_ingredientes
            FROM 
                pizza AS p
            LEFT JOIN 
                pizza_ingrediente AS pi ON p.id_pizza = pi.pizza_id
            LEFT JOIN 
                ingrediente AS i ON pi.ingrediente_id = i.id_ingrediente
            GROUP BY
                p.id_pizza, p.nome_pizza, p.preco_base, p.tamanho_pizza, p.categoria_pizza
            ORDER BY
                p.nome_pizza ASC";

    $res = $conn->query($sql);
    
    $qtd = $res->num_rows;
    
    if($qtd > 0){
        print "<p>Encontrou <b>$qtd</b> pizza(s) no cardápio</p>";
        
        print "<table class='table table-bordered table-striped table-hover'>";
        
        // Cabeçalho
        print "<thead>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Sabor</th>";
        print "<th>Categoria</th>";
        print "<th>Tamanho</th>";
        print "<th>Preço Base</th>";
        print "<th>Ingredientes (Receita)</th>";
        print "<th>Ação</th>";
        print "</tr>";
        print "</thead>";
        
        // Corpo
        print "<tbody>";
        while($row = $res->fetch_object()){
            print "<tr>";
            
            print "<td>".$row->id_pizza."</td>";
            print "<td>".$row->nome_pizza."</td>";
            print "<td>".$row->categoria_pizza."</td>";
            print "<td>".$row->tamanho_pizza."</td>"; 
            
            // Formata o preço como moeda (R$)
            print "<td>R$ ".number_format($row->preco_base, 2, ',', '.')."</td>";
            
            // Exibe a lista de ingredientes ou uma mensagem se não tiver nenhum
            $ingredientes = $row->lista_ingredientes ? $row->lista_ingredientes : "<span class='text-muted'>Sem ingredientes cadastrados</span>";
            print "<td>".$ingredientes."</td>";

            // Botões de Ação
            print "<td>
                    <button class='btn btn-success' onclick=\"location.href='?page=editar-pizza&id_pizza={$row->id_pizza}';\">Editar</button>
                    
                    <button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir? Isso removerá a pizza e seus ingredientes da receita!')){location.href='?page=salvar-pizza&acao=excluir&id_pizza={$row->id_pizza}';}else{false;}\">Excluir</button>
                   </td>";

            print "</tr>";
        }
        print "</tbody>";
        
        print "</table>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }else{
        print "<div class='alert alert-info' role='alert'>Nenhuma pizza cadastrada no cardápio.</div>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }
?>