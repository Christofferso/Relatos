<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Relatos</title>

    <!--Icon-->
    <link rel="icon" href="assets/logo.png">

    <link href="./styles/index.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>

    <div class="banner">   
        <div class="communication">

                <div class="communicationItem">
                    <img src="./assets/logo.png" width="200px"/>    
		        </div>
                
                <div class="communicationItem">
				    <i class="fas fa-search fa-2x mr-3"></i>
				        Averiguação de fatos.
		        </div>

                <div class="communicationItem">
			        <i class="far fa-comment fa-2x mr-3"></i>
				        Reporte um problema.
                </div>
			</div>
        </div>

        <div class="form">
            <div class="forms">
                <?php 
                    if(isset($_SESSION['id']) and (isset($_SESSION['nome']))){
                    header("Location: mapa.php");
                }
                ?>

                <div id='dados-usuario'>
                    <button type="button" class="btn btn-outline-primary m-4 btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#loginModal">Acessar</button>
                </div>

                <div class="m-5">
                    <span id="msgAlert"></span>
                </div>

                <div class="row pt-5 pl-5 pr-5">
			        <div class="subscriptions">
				       
				        <h1 class="title">Relate e veja o que está acontecendo em sua cidade agora!</h1>

				        <h2 class="subtitle">Participe hoje da comunidade Relatos:</h2>

                        <div class="cadastro">
				            <button type="button" class="btn btn-outline-success btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastre-se</button>
                        </div>
                    </div>	
		        </div>
            </div>
        </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Log In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-usuario-form" method="POST">
                        <span id="msgAlertErroLogin"></span>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Digite o e-mail">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="col-form-label">Senha:</label>
                            <input type="password" name="senha" class="form-control" id="senha" autocomplete="on" placeholder="Digite a senha">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-primary bt-sm" id="login-usuario-btn" value="Acessar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-usuario-form" method="POST">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="Digite seu nome">
                        </div>

                        <div class="mb-3">
                            <label for="cadsobrenome" class="col-form-label">Sobrenome:</label>
                            <input type="text" name="cadsobrenome" class="form-control" id="cadsobrenome" placeholder="Digite seu sobrenome">
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">E-mail:</label>
                            <input type="email" name="cademail" class="form-control" id="cademail" placeholder="Digite um e-mail válido">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Senha:</label>
                            <input type="password" name="cadsenha" class="form-control" id="cadsenha" autocomplete="on" placeholder="Digite a senha">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>