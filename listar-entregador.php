<h1>Lista de Entregadores</h1>

<?php
    // Seleciona todos os dados da tabela 'entregador'
    $sql = "SELECT * FROM entregador"; 

    $res = $conn->query($sql);

    $qtd = $res->num_rows;

    if($qtd > 0){
        print "<p>Encontrou <b>$qtd</b> resultado(s)</p>";
        
        print "<table class='table table-bordered table-striped table-hover'>";
        
        // Cabeçalho
        print "<thead>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Nome</th>";
        print "<th>CPF</th>";   // Adicionado
        print "<th>Placa</th>"; // Adicionado (Importante para logística)
        print "<th>Telefone</th>";
        print "<th>E-mail</th>"; 
        print "<th>Ações</th>";
        print "</tr>";
        print "</thead>";

        // Corpo da Tabela
        print "<tbody>";
        while( $row = $res->fetch_object() ){
            print "<tr>";
            
            print "<td>".$row->id_entregador."</td>";
            print "<td>".$row->nome_entregador."</td>";
            print "<td>".$row->cpf_entregador."</td>";     // Exibe o CPF
            print "<td>".$row->placa_veiculo."</td>";      // Exibe a Placa
            print "<td>".$row->telefone_entregador."</td>";
            print "<td>".$row->email_entregador."</td>";
            
            // Botões de Ação
            print "<td>
                    <button class='btn btn-success' onclick=\"location.href='?page=editar-entregador&id_entregador={$row->id_entregador}';\">Editar</button>

                    <button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir? Isso removerá o Entregador do sistema!')){location.href='?page=salvar-entregador&acao=excluir&id_entregador={$row->id_entregador}';}else{false;}\">Excluir</button>
                   </td>";

            print "</tr>";
        }
        print "</tbody>";
        
        print "</table>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }else{
        print "<div class='alert alert-info' role='alert'>Nenhum entregador encontrado.</div>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }
?>