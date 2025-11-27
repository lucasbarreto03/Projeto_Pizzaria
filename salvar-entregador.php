<?php 
    // O arquivo config.php já é carregado pelo index.php, então não precisamos incluí-lo aqui novamente.
    
    switch ($_REQUEST['acao']) {
        
        // =========================================================
        // AÇÃO: CADASTRAR ENTREGADOR
        // =========================================================
        case 'cadastrar':
            // 1. Receber dados
            $nome     = $_POST['nome_entregador'];
            $email    = $_POST['email_entregador'];
            $telefone = $_POST['telefone_entregador'];
            $cpf      = $_POST['cpf_entregador'];
            $placa    = $_POST['placa_veiculo'];

            // 2. SQL de INSERÇÃO
            $sql = "INSERT INTO entregador (nome_entregador, email_entregador, telefone_entregador, cpf_entregador, placa_veiculo)
                    VALUES ('{$nome}', '{$email}', '{$telefone}', '{$cpf}', '{$placa}')";

            $res = $conn->query($sql);

            if($res == true){
                print "<script>alert('Entregador cadastrado com sucesso!');</script>";
                print "<script>location.href='?page=listar-entregador';</script>";
            }else{
                print "<script>alert('Não foi possível cadastrar! Erro: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-entregador';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EDITAR ENTREGADOR
        // =========================================================
        case 'editar':
            // 1. Receber dados
            $nome          = $_POST['nome_entregador'];
            $email         = $_POST['email_entregador'];
            $telefone      = $_POST['telefone_entregador'];
            $cpf           = $_POST['cpf_entregador'];
            $placa         = $_POST['placa_veiculo'];
            $id_entregador = $_REQUEST['id_entregador'];

            // 2. SQL de EDIÇÃO
            $sql = "UPDATE entregador SET 
                    nome_entregador='{$nome}', 
                    email_entregador='{$email}', 
                    telefone_entregador='{$telefone}',
                    cpf_entregador='{$cpf}',
                    placa_veiculo='{$placa}'
                    WHERE id_entregador=".$id_entregador;
                    
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Dados editados com sucesso!');</script>";
                print "<script>location.href='?page=listar-entregador';</script>";
            } else {
                print "<script>alert('Não foi possível editar! Erro: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-entregador';</script>";
            }
            break;

        // =========================================================
        // AÇÃO: EXCLUIR ENTREGADOR
        // =========================================================
        case 'excluir':
            $id_entregador = $_REQUEST['id_entregador'];
            
            // 1. SQL de EXCLUSÃO
            $sql = "DELETE FROM entregador WHERE id_entregador=".$id_entregador;
            
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Entregador excluído com sucesso!');</script>";
                print "<script>location.href='?page=listar-entregador';</script>";
            } else {
                print "<script>alert('Não foi possível excluir! Verifique se há pedidos vinculados.');</script>";
                print "<script>location.href='?page=listar-entregador';</script>";
            }
            break;

    } // Fim do switch
?>