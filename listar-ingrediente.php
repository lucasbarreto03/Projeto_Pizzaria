<h1>Lista de Ingredientes</h1>
<?php
    // Seleciona todos os campos da tabela 'ingrediente'
    $sql = "SELECT * FROM ingrediente";

    $res = $conn->query($sql);

    $qtd = $res->num_rows;

    if($qtd > 0){
        print "<p>Encontrou <b>$qtd</b> resultado(s)</p>";

        print "<table class='table table-bordered table-striped table-hover'>";

        // Cabeçalho da Tabela
        print "<thead>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Nome do Ingrediente</th>";
        print "<th>Unidade de Medida</th>";
        print "<th>Ação</th>";
        print "</tr>";
        print "</thead>";

        // Corpo da Tabela
        print "<tbody>";
        while( $row = $res->fetch_object() ){
            print "<tr>";
            
            print "<td>".$row->id_ingrediente."</td>";
            print "<td>".$row->nome_ingrediente."</td>";
            print "<td>".$row->unidade_medida."</td>"; 

            // Botões de Ação
            print "<td>
                    <button class='btn btn-success' onclick=\"location.href='?page=editar-ingrediente&id_ingrediente={$row->id_ingrediente}';\">Editar</button>

                    <button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir? Isso pode afetar receitas de pizzas!')){location.href='?page=salvar-ingrediente&acao=excluir&id_ingrediente={$row->id_ingrediente}';}else{false;}\">Excluir</button>
                   </td>";

            print "</tr>";
        }
        print "</tbody>";

        print "</table>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }else{
        print "<div class='alert alert-info' role='alert'>Nenhum ingrediente encontrado no estoque.</div>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }
?>