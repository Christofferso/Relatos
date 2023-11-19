<?php
    include_once './layouts/header.php';
    require_once  './conection/conexao.php';

    $id = $_SESSION['id'];

    if((!isset($_SESSION['id']) == TRUE)) {

        unset($_SESSIOn['id']);
        unset($_SESSION['nome']);
        unset($_SESSION['sobrenome']);
        header('Location: index.php');

    }

    $query = "SELECT m.name as `descricao`, m.address as `endereco`, r.nm_problema as `problema`
              FROM tb_usuario u
              INNER JOIN markers m ON u.id_usuario = user_id
              INNER JOIN tb_relato r ON m.id = r.id_marker_relato
              WHERE u.id_usuario = :id
              GROUP BY m.id ASC;";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $exibicao = $stmt->fetchAll();

    $n = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
     <!-- BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">

        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Endereço</th>
                <th scope="col">Problema</th>
            </thead>
            <tbody>
                    <?php 
                    
                        if($exibicao != 0) {
                            foreach($exibicao as $row => $data) {
                                $n++;
                                echo 
                                    "<tr>" . 
                                        '<td scope="row">' . $n . "</td>" .
                                        '<td scope="row">' . $data['descricao'] . "</td>" .
                                        '<td scope="row">' . $data['endereco'] . "</td>" .
                                        '<td scope="row">' . $data['problema'] . "</td>" .
                                    "</tr>";
                            }
                        }else {

                            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Você ainda não relatou nada!</div>"];

                        } 
                    ?>
            </tbody>
        </table>
        <a href="index.php">Voltar</a>
    </div>

<?php
    include_once './layouts/footer.php';
?>