<?php 
    // O arquivo config.php já é carregado pelo index.php

    switch ($_REQUEST['acao']) {
        
        // =========================================================
        // AÇÃO: CADASTRAR PEDIDO
        // =========================================================
        case 'cadastrar':
            
            // 1. Receber dados do cabeçalho
            $cliente_id    = $_POST['cliente_id_cliente'];
            // Se entregador for vazio, salva como NULL
            $entregador_id = !empty($_POST['entregador_id_entregador']) ? $_POST['entregador_id_entregador'] : NULL;
            $status_pedido = $_POST['status_pedido'];
            $data_pedido   = $_POST['data_pedido'];

            // 2. Receber pizzas e quantidades
            // Se não houver array, define como vazio para evitar erro
            $pizzas_selecionadas = isset($_POST['pizzas_selecionadas']) ? $_POST['pizzas_selecionadas'] : [];
            
            $valor_total = 0; 
            $itens_para_inserir = [];
            
            // 3. Lógica de Cálculo
            if (!empty($pizzas_selecionadas)) {
                // Transforma array em string para o SQL (ex: "1, 2, 5")
                $lista_ids = implode(',', array_map('intval', $pizzas_selecionadas));
                
                // Busca preços
                $sql_precos = "SELECT id_pizza, preco_base FROM pizza WHERE id_pizza IN ({$lista_ids})";
                $res_precos = $conn->query($sql_precos);
                
                $precos_pizzas = [];
                if($res_precos){
                    while ($row = $res_precos->fetch_assoc()) {
                        $precos_pizzas[$row['id_pizza']] = (float)$row['preco_base'];
                    }
                }

                // Prepara itens
                foreach ($pizzas_selecionadas as $id_pizza) {
                    $id_pizza = (int)$id_pizza;
                    
                    // Pega quantidade dinâmica
                    $quantidade_campo = 'quantidade_' . $id_pizza;
                    $quantidade = isset($_POST[$quantidade_campo]) ? (int)$_POST[$quantidade_campo] : 1;
                    
                    $preco_unitario = $precos_pizzas[$id_pizza] ?? 0.00;
                    
                    if ($quantidade > 0 && $preco_unitario > 0) {
                        $subtotal = $quantidade * $preco_unitario;
                        $valor_total += $subtotal;
                        
                        $itens_para_inserir[] = [
                            'pizza_id' => $id_pizza,
                            'quantidade' => $quantidade,
                            'preco_unitario' => $preco_unitario,
                        ];
                    }
                }
            } else {
                print "<script>alert('Erro: Nenhuma pizza selecionada!');</script>";
                print "<script>location.href='?page=cadastrar-pedido';</script>";
                exit;
            }

            // 4. Inserir Pedido (Cabeçalho)
            // Trata o NULL do entregador corretamente no SQL
            $entregador_sql = $entregador_id ? "'$entregador_id'" : "NULL";

            $sql_pedido = "INSERT INTO pedido (cliente_id_cliente, entregador_id_entregador, data_pedido, valor_total, status_pedido)
                           VALUES ('{$cliente_id}', {$entregador_sql}, '{$data_pedido}', '{$valor_total}', '{$status_pedido}')";

            $res_pedido = $conn->query($sql_pedido);

            if ($res_pedido) {
                $id_pedido_novo = $conn->insert_id; // Pega o ID gerado

                // 5. Inserir Itens
                if(!empty($itens_para_inserir)){
                    $values_itens = [];
                    foreach ($itens_para_inserir as $item) {
                        $values_itens[] = "('{$id_pedido_novo}', '{$item['pizza_id']}', '{$item['quantidade']}', '{$item['preco_unitario']}')";
                    }
                    
                    $sql_itens = "INSERT INTO item_pedido (pedido_id, pizza_id, quantidade, preco_unitario) 
                                  VALUES " . implode(', ', $values_itens);
                                         
                    $res_itens = $conn->query($sql_itens);
                }
                
                print "<script>alert('Pedido cadastrado com sucesso! Total: R$ " . number_format($valor_total, 2, ',', '.') . "');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            } else {
                print "<script>alert('Erro ao cadastrar pedido: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            }
            break;

        // =========================================================
        // AÇÃO: EDITAR PEDIDO (Apenas Cabeçalho)
        // =========================================================
        case 'editar':
            $id_pedido     = $_REQUEST['id_pedido'];
            $cliente_id    = $_POST['cliente_id_cliente'];
            $entregador_id = !empty($_POST['entregador_id_entregador']) ? $_POST['entregador_id_entregador'] : NULL;
            $status_pedido = $_POST['status_pedido'];
            // Valor total não é editado aqui, mantém o que estava ou recebe via hidden se necessário.
            // Para simplificar, não alteramos o valor no UPDATE abaixo, apenas quem e status.

            $entregador_sql = $entregador_id ? "'$entregador_id'" : "NULL";
            
            $sql = "UPDATE pedido SET 
                    cliente_id_cliente='{$cliente_id}', 
                    entregador_id_entregador={$entregador_sql}, 
                    status_pedido='{$status_pedido}' 
                    WHERE id_pedido=".$id_pedido;
                    
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Pedido atualizado com sucesso!');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            } else {
                print "<script>alert('Erro ao editar: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            }
            break;

        // =========================================================
        // AÇÃO: EXCLUIR PEDIDO
        // =========================================================
        case 'excluir':
            $id_pedido = $_REQUEST['id_pedido'];
            
            // O DELETE CASCADE configurado no banco apaga os itens automaticamente
            $sql = "DELETE FROM pedido WHERE id_pedido=".$id_pedido;
            
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Pedido excluído com sucesso!');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            } else {
                print "<script>alert('Erro ao excluir pedido: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            }
            break;
    }
?>