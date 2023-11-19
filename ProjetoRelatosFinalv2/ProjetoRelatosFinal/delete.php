<?php
    require_once './conection/conexao.php';

    session_start();

    $data = $_POST;

    if($data["type"] === "delete") {
        $id = $_SESSION["id"];

        $query = "DELETE FROM tb_usuario WHERE id_usuario = :id_usuario";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id_usuario", $id);
        $stmt->execute();

        try {
            $stmt->execute();
            header("Location: index.php");
            session_destroy();

        }catch(PDOException $e) {
            // erro na conexão
            $error = $e->getMessage();
            echo "Error: $error";
        }
    }

?>