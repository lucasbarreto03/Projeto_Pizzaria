<?php 
    // O arquivo config.php já é carregado pelo index.php

    switch ($_REQUEST['acao']) {
        
        // =========================================================
        // AÇÃO: CADASTRAR CLIENTE
        // =========================================================
        case 'cadastrar':
            // 1. Receber dados
            $nome        = $_POST['nome_cliente'];
            $email       = $_POST['email_cliente'];
            $telefone    = $_POST['telefone_cliente'];
            $cpf         = $_POST['cpf_cliente'];
            $endereco    = $_POST['endereco_cliente'];
            $complemento = $_POST['complemento_endereco']; // Novo campo
            $dt_nasc     = $_POST['dt_nasc_cliente'];

            // 2. SQL de INSERÇÃO
            $sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, telefone_cliente, endereco_cliente, complemento_endereco, dt_nasc_cliente)
                    VALUES ('{$nome}', '{$cpf}', '{$email}', '{$telefone}', '{$endereco}', '{$complemento}', '{$dt_nasc}')";
            
            $res = $conn->query($sql);

            if($res == true){
                print "<script>alert('Cliente cadastrado com sucesso!');</script>";
                print "<script>location.href='?page=listar-cliente';</script>"; 
            }else{
                print "<script>alert('Não foi possível cadastrar! Erro: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-cliente';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EDITAR CLIENTE
        // =========================================================
        case 'editar':
            // 1. Receber dados
            $nome        = $_POST['nome_cliente'];
            $email       = $_POST['email_cliente'];
            $telefone    = $_POST['telefone_cliente'];
            $cpf         = $_POST['cpf_cliente'];
            $endereco    = $_POST['endereco_cliente'];
            $complemento = $_POST['complemento_endereco']; // Novo campo
            $dt_nasc     = $_POST['dt_nasc_cliente'];
            $id_cliente  = $_REQUEST['id_cliente'];
            
            // 2. SQL de EDIÇÃO
            $sql = "UPDATE cliente SET 
                    nome_cliente='{$nome}', 
                    email_cliente='{$email}', 
                    telefone_cliente='{$telefone}', 
                    cpf_cliente='{$cpf}', 
                    endereco_cliente='{$endereco}', 
                    complemento_endereco='{$complemento}',
                    dt_nasc_cliente='{$dt_nasc}' 
                    WHERE id_cliente=".$id_cliente;
                    
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Cliente editado com sucesso!');</script>";
                print "<script>location.href='?page=listar-cliente';</script>";
            } else {
                print "<script>alert('Não foi possível editar! Erro: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-cliente';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EXCLUIR CLIENTE
        // =========================================================
        case 'excluir':
            $id_cliente = $_REQUEST['id_cliente'];

            // Tenta excluir (se tiver pedidos, o banco bloqueará automaticamente)
            $sql = "DELETE FROM cliente WHERE id_cliente=".$id_cliente;
            
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Cliente excluído com sucesso!');</script>";
                print "<script>location.href='?page=listar-cliente';</script>";
            } else {
                print "<script>alert('Não foi possível excluir! O cliente possui pedidos registrados.');</script>";
                print "<script>location.href='?page=listar-cliente';</script>";
            }
            break;
    }
?>