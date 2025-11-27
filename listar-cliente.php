<h1>Lista de Clientes</h1>

<?php
    // Seleciona todos os clientes
    $sql = "SELECT * FROM cliente";

    $res = $conn->query($sql);

    $qtd = $res->num_rows;

    if ($qtd > 0) {
        print "<p>Encontrou <b>$qtd</b> resultado(s)</p>";
        
        // Inicia a Tabela
        print "<table class='table table-bordered table-striped table-hover'>";
        
        // Cabeçalho da Tabela (<thead>)
        print "<thead>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Nome</th>";
        print "<th>CPF</th>";
        print "<th>Telefone</th>";
        print "<th>Endereço Principal</th>"; 
        print "<th>Complemento</th>"; // Campo Novo
        print "<th>Ações</th>";           
        print "</tr>";
        print "</thead>";

        // Corpo da Tabela 
        print "<tbody>";
        
        while ($row = $res->fetch_object()) {
            print "<tr>";
            print "<td>" . $row->id_cliente . "</td>";
            print "<td>" . $row->nome_cliente . "</td>";
            print "<td>" . $row->cpf_cliente . "</td>";
            print "<td>" . $row->telefone_cliente . "</td>";
            print "<td>" . $row->endereco_cliente . "</td>"; 
            print "<td>" . $row->complemento_endereco . "</td>";
            
            // Botões de Ação
            print "<td>
                    <button class='btn btn-success' onclick=\"location.href='?page=editar-cliente&id_cliente={$row->id_cliente}';\">Editar</button>
                    
                    <button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir? Isso removerá o histórico de pedidos deste cliente!')){location.href='?page=salvar-cliente&acao=excluir&id_cliente={$row->id_cliente}';}else{false;}\">Excluir</button>
                   </td>";
            print "</tr>";
        }
        print "</tbody>";
        
        print "</table>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    } else {
        print "<div class='alert alert-info' role='alert'>Nenhum cliente cadastrado.</div>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }
?>