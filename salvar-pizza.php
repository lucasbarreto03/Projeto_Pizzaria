<?php 
    // O arquivo config.php já é carregado pelo index.php
    
    switch ($_REQUEST['acao']) {
        
        // =========================================================
        // AÇÃO: CADASTRAR PIZZA
        // =========================================================
        case 'cadastrar':
            // 1. Receber dados da Pizza
            $nome        = $_POST['nome_pizza'];
            $preco       = $_POST['preco_base'];
            $tamanho     = $_POST['tamanho_pizza'];
            $categoria   = $_POST['categoria_pizza'];
            
            // Recebe o array de ingredientes (pode ser vazio se nada for marcado)
            $ingredientes = isset($_POST['ingredientes_selecionados']) ? $_POST['ingredientes_selecionados'] : [];

            // 2. INSERÇÃO NA TABELA `pizza`
            $sql_pizza = "INSERT INTO pizza (nome_pizza, preco_base, tamanho_pizza, categoria_pizza)
                          VALUES ('{$nome}', '{$preco}', '{$tamanho}', '{$categoria}')";
            
            $res_pizza = $conn->query($sql_pizza);

            if ($res_pizza) {
                // 3. Capturar o ID da Pizza recém-criada
                $id_pizza_nova = $conn->insert_id; 

                // 4. INSERÇÃO NA TABELA `pizza_ingrediente`
                if (!empty($ingredientes)) {
                    $values_ingredientes = [];
                    foreach ($ingredientes as $id_ingrediente) {
                        // Adiciona a relação (Pizza ID, Ingrediente ID, Quantidade Padrão 1)
                        $values_ingredientes[] = "('{$id_pizza_nova}', '{$id_ingrediente}', 1)"; 
                    }
                    
                    $sql_ingredientes = "INSERT INTO pizza_ingrediente (pizza_id, ingrediente_id, quantidade_necessaria) 
                                         VALUES " . implode(', ', $values_ingredientes);
                                         
                    $conn->query($sql_ingredientes);
                }
                
                print "<script>alert('Pizza cadastrada com sucesso!');</script>";
                print "<script>location.href='?page=listar-pizza';</script>";
            } else {
                print "<script>alert('Falha ao cadastrar a Pizza: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-pizza';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EDITAR PIZZA
        // =========================================================
        case 'editar':
            $id_pizza    = $_REQUEST['id_pizza'];
            $nome        = $_POST['nome_pizza'];
            $preco       = $_POST['preco_base'];
            $tamanho     = $_POST['tamanho_pizza'];
            $categoria   = $_POST['categoria_pizza'];
            
            $ingredientes = isset($_POST['ingredientes_selecionados']) ? $_POST['ingredientes_selecionados'] : [];
            
            // 1. UPDATE NA TABELA `pizza`
            $sql_pizza = "UPDATE pizza SET 
                          nome_pizza='{$nome}', 
                          preco_base='{$preco}', 
                          tamanho_pizza='{$tamanho}', 
                          categoria_pizza='{$categoria}' 
                          WHERE id_pizza=".$id_pizza;
                          
            $res_pizza = $conn->query($sql_pizza);

            if ($res_pizza) {
                
                // 2. LIMPEZA: Deleta todos os ingredientes antigos desta pizza
                // Isso é necessário para evitar duplicações e remover os desmarcados
                $sql_delete_antigos = "DELETE FROM pizza_ingrediente WHERE pizza_id = ".$id_pizza;
                $conn->query($sql_delete_antigos);
                
                // 3. REINSERÇÃO: Insere os ingredientes marcados no formulário
                if (!empty($ingredientes)) {
                    $values_ingredientes = [];
                    foreach ($ingredientes as $id_ingrediente) {
                        $values_ingredientes[] = "('{$id_pizza}', '{$id_ingrediente}', 1)"; 
                    }
                    
                    $sql_ingredientes = "INSERT INTO pizza_ingrediente (pizza_id, ingrediente_id, quantidade_necessaria) 
                                         VALUES " . implode(', ', $values_ingredientes);
                                         
                    $conn->query($sql_ingredientes);
                }
                
                print "<script>alert('Pizza editada com sucesso!');</script>";
                print "<script>location.href='?page=listar-pizza';</script>";
            } else {
                print "<script>alert('Não foi possível editar a Pizza: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-pizza';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EXCLUIR PIZZA
        // =========================================================
        case 'excluir':
            $id_pizza = $_REQUEST['id_pizza'];
            
            // Graças à configuração "ON DELETE CASCADE" no banco de dados,
            // ao deletar a pizza, os ingredientes vinculados (tabela pizza_ingrediente)
            // serão apagados automaticamente.
            $sql = "DELETE FROM pizza WHERE id_pizza=".$id_pizza;
            
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Pizza excluída com sucesso!');</script>";
                print "<script>location.href='?page=listar-pizza';</script>";
            } else {
                print "<script>alert('Não foi possível excluir a Pizza! Ela pode estar vinculada a um Pedido.');</script>";
                print "<script>location.href='?page=listar-pizza';</script>";
            }
            break;
    }
?>
            if ($res == true) {
                print "<script>alert('Pedido excluído com sucesso!');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            } else {
                print "<script>alert('Erro ao excluir pedido: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-pedido';</script>";
            }
            break;
    