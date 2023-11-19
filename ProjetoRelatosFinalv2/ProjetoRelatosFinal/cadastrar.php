<?php

include_once './conection/conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$dados_nome = $dados['cadnome'] . ' ' . $dados['cadsobrenome'];

if (empty($dados['cadnome'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
} elseif (empty($dados['cadsobrenome'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo sobrenome!</div>"];
} elseif (empty($dados['cademail'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo e-mail!</div>"];
} elseif (empty($dados['cadsenha'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>"];
} else {

    $query_usuario_pes = "SELECT id_usuario FROM tb_usuario WHERE nm_email=:nm_email LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario_pes);
    $result_usuario->bindParam(':nm_email', $dados['cademail'], PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: O e-mail já está cadastrado!</div>"];
    }else{
        $query_usuario = "INSERT INTO tb_usuario (nm_usuario, nm_email, nm_senha) VALUES (:nm_usuario, :nm_email, :nm_senha)";
        $cad_usuario = $conn->prepare($query_usuario);
        $cad_usuario->bindParam(':nm_usuario', $dados_nome, PDO::PARAM_STR);
       // $cad_usuario->bindParam(':sobrenome', $dados['cadsobrenome'], PDO::PARAM_STR);
        $cad_usuario->bindParam(':nm_email', $dados['cademail'], PDO::PARAM_STR);
        $senha_cript = password_hash($dados['cadsenha'], PASSWORD_DEFAULT);
        $cad_usuario->bindParam(':nm_senha', $senha_cript, PDO::PARAM_STR);

        $cad_usuario->execute();

        if ($cad_usuario->rowCount()) {
            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>"];
        } else {
            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];
        }
    }
}

echo json_encode($retorna);
