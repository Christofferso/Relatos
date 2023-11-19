<input type="checkbox" id="menu-toggle" />
<label for="menu-toggle" class="menu-icon"><i class="fa fa-bars"></i></label>

<div class="slideout-sidebar">
    <div class="brand-logo">
        <img src="./assets/logo.png" width="80px">
    </div>
    <ul class="ul">
        <li>&nbsp;<span><a href="mapa.php" class="menu-link">Ocorrências</a></span> </li>
        <li>&nbsp;<span><a href="estatisticas.php" class="menu-link">Estatísticas</a> </span> </li>
        <li>&nbsp;<span><a href="#abrirModal" class="menu-link">Perfil</a> </span> </li>
        <li>&nbsp;<span><a href="dashboard.php" class="menu-link">Meus relatos</a></span></li>
    </ul>

        <div id='exit'>
            <a href='sair.php'>Sair</a>
        </div>
        <?php require './leyouts/footer.php'; ?>
</div>



<div id="abrirModal" class="modal">
  <a href="#fechar" title="Fechar" class="fechar">X</a>

  <?php
        session_start();
        ob_start();

          require_once './conection/conexao.php';

          $id = $_SESSION["id"];

            if (isset($_SESSION['id']) && (isset($_SESSION['nome']))) {

                $user = "SELECT id_usuario, nm_usuario, nm_email FROM tb_usuario WHERE id_usuario = :id_usuario";
                $stmt = $conn->prepare($user);
                $stmt->bindParam(":id_usuario", $_SESSION['id'], PDO::PARAM_INT);
                $stmt->execute();

                    if($stmt->rowCount() != 0) {
                        $data = $stmt->fetch(PDO::FETCH_ASSOC);

                        $id = $data['id_usuario'];
                        $nome = $data['nm_usuario'];
                        $email = $data['nm_email'];

                    }else {

                        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário realizar o login para acessar a página!</div>";
                        
                    }

                try {

                    $stmt->execute();
            
                }catch(PDOException $e) {
                    // erro na conexão
                    $error = $e->getMessage();
                    echo "Error: $error";
                }

            }   
            
        ?>
  
        <section class="perfil">
            <h3>Dados do Perfil</h3>
            <img id="user" src="assets/usuario.png"alt="">
            <table class="perfil">
                <thead>
                    <tr>
                        <th scope="col">Usuário</th> 
                        <th scope="col">E-mail</th>
                    </tr> 
                </thead> 
                
                <tbody> 
                    <tr> 
                        <td scope="row"><?php echo $nome ?></td>  
                        <td scope="row"><?php echo $email ?></td>
                    </tr>
                </tbody>
            </table>
            
            <form action="delete.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>">
                <button id="deletar" type="submit" >DELETAR PERFIL</button>
            </form>
        </section>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="js/custom.js"></script>
</div>
