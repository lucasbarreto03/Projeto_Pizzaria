<h1>Lista de Pedidos</h1>
<?php
    // CONSULTA SQL COMPLEXA: Reúne Cliente, Entregador e lista de Pizzas (Itens do Pedido)
    $sql = "SELECT 
                p.id_pedido, 
                p.data_pedido,
                p.status_pedido,
                p.valor_total,
                c.nome_cliente, 
                e.nome_entregador,
                
                /* Agrupa os nomes das pizzas e quantidades em uma string separada por quebra de linha */
                GROUP_CONCAT(ip.quantidade, 'x ', pi.nome_pizza SEPARATOR '<br>') AS itens_do_pedido 
            FROM 
                pedido AS p 
            INNER JOIN 
                cliente AS c ON p.cliente_id_cliente = c.id_cliente 
            LEFT JOIN 
                entregador AS e ON p.entregador_id_entregador = e.id_entregador 
            INNER JOIN 
                item_pedido AS ip ON p.id_pedido = ip.pedido_id 
            INNER JOIN
                pizza AS pi ON ip.pizza_id = pi.id_pizza 
            
            GROUP BY 
                p.id_pedido, p.data_pedido, p.status_pedido, p.valor_total, c.nome_cliente, e.nome_entregador
            ORDER BY
                p.data_pedido DESC"; 
                
    $res = $conn->query($sql);
    $qtd = $res->num_rows;
    
    if($qtd > 0){
        print "<p>Encontrou <b>$qtd</b> resultado(s)</p>";
        
        print "<table class='table table-bordered table-striped table-hover'>";
        
        // Cabeçalho
        print "<thead>";
        print "<tr>";
        print "<th>#</th>";
        print "<th>Data/Hora</th>";
        print "<th>Cliente</th>";
        print "<th>Itens do Pedido</th>";
        print "<th>Total</th>";
        print "<th>Entregador</th>";
        print "<th>Status</th>";
        print "<th>Ação</th>";
        print "</tr>";
        print "</thead>";
        
        // Corpo
        print "<tbody>";
        while($row = $res->fetch_object()){
            print "<tr>";
            print "<td>".$row->id_pedido."</td>";
            
            // Formata Data/Hora
            $dt_formatada = date('d/m/Y H:i', strtotime($row->data_pedido)); 
            print "<td>" . $dt_formatada . "</td>"; 
            
            print "<td>".$row->nome_cliente."</td>";
            
            // Exibe a lista de pizzas (o <br> do SQL fará a quebra de linha visual)
            print "<td>".$row->itens_do_pedido."</td>"; 
            
            // Formata o valor como moeda
            print "<td>R$ ".number_format($row->valor_total, 2, ',', '.')."</td>";
            
            // Exibe o Entregador ou "Não Atribuído" se for NULL
            $entregador = $row->nome_entregador ? $row->nome_entregador : "<span class='text-muted'>Não Atribuído</span>";
            print "<td>".$entregador."</td>";
            
            // Exibe o status
            print "<td>".$row->status_pedido."</td>"; 
            
            // Botões de Ação
            print "<td>
                    <button class='btn btn-success btn-sm' onclick=\"location.href='?page=editar-pedido&id_pedido={$row->id_pedido}';\">Detalhes/Editar</button> 
                    
                    <button class='btn btn-danger btn-sm' onclick=\"if(confirm('Tem certeza que deseja cancelar/excluir o pedido?')){location.href='?page=salvar-pedido&acao=excluir&id_pedido={$row->id_pedido}';}else{false;}\">Excluir</button> 
                   </td>";

            print "</tr>";
        }
        print "</tbody>";
        
        print "</table>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }else{
        print "<div class='alert alert-info' role='alert'>Nenhum pedido encontrado.</div>";
        print "<a href='?page=index.php' class='btn btn-secondary'> Voltar </a>";
    }
?>