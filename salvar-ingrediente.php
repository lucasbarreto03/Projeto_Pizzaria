<?php 
    // O arquivo config.php já é carregado pelo index.php

    switch ($_REQUEST['acao']) {
        
        // =========================================================
        // AÇÃO: CADASTRAR INGREDIENTE
        // =========================================================
        case 'cadastrar':
            // 1. Receber dados
            $nome = $_POST['nome_ingrediente'];
            $unidade_medida = $_POST['unidade_medida'];
            
            // 2. SQL de INSERÇÃO
            $sql = "INSERT INTO ingrediente (nome_ingrediente, unidade_medida)
                    VALUES ('{$nome}', '{$unidade_medida}')";

            $res = $conn->query($sql);

            if($res == true){
                print "<script>alert('Ingrediente cadastrado com sucesso!');</script>";
                print "<script>location.href='?page=listar-ingrediente';</script>";
            }else{
                print "<script>alert('Não foi possível cadastrar! Erro: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-ingrediente';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EDITAR INGREDIENTE
        // =========================================================
        case 'editar':
            // 1. Receber dados
            $nome = $_POST['nome_ingrediente'];
            $unidade_medida = $_POST['unidade_medida'];
            $id_ingrediente = $_REQUEST['id_ingrediente'];
            
            // 2. SQL de EDIÇÃO
            $sql = "UPDATE ingrediente SET 
                    nome_ingrediente='{$nome}', 
                    unidade_medida='{$unidade_medida}' 
                    WHERE id_ingrediente=".$id_ingrediente;
                    
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Ingrediente editado com sucesso!');</script>";
                print "<script>location.href='?page=listar-ingrediente';</script>";
            } else {
                print "<script>alert('Não foi possível editar! Erro: " . $conn->error . "');</script>";
                print "<script>location.href='?page=listar-ingrediente';</script>";
            }
            break;
            
        // =========================================================
        // AÇÃO: EXCLUIR INGREDIENTE
        // =========================================================
        case 'excluir':
            $id_ingrediente = $_REQUEST['id_ingrediente'];
            
            // Tenta excluir
            $sql = "DELETE FROM ingrediente WHERE id_ingrediente=".$id_ingrediente;
            
            $res = $conn->query($sql);
            
            if ($res == true) {
                print "<script>alert('Ingrediente excluído com sucesso!');</script>";
                print "<script>location.href='?page=listar-ingrediente';</script>";
            } else {
                print "<script>alert('Não foi possível excluir! Ele pode estar sendo usado em uma receita.');</script>";
                print "<script>location.href='?page=listar-ingrediente';</script>";
            }
            break;
    }
?>