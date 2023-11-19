<script type="text/javascript">
window.history.go(1);
</script>

<?php 
include './conection/conexao.php';

// Usuarios
$query_usuarios = $conn->query("SELECT COUNT(id_usuario) AS total_usuarios FROM tb_usuario")->fetch(PDO::FETCH_ASSOC);
$dados_usuarios = $query_usuarios['total_usuarios'];

// Marcações no mapa
$sql1 = $conn->query("SELECT COUNT(id) AS total_marcacao FROM markers;")->fetch(PDO::FETCH_ASSOC);
$dados_mapa = $sql1['total_marcacao'];

//Total relatos
$query_relato = $conn->query("SELECT COUNT(id_relato) as `total_relato` FROM tb_relato;")->fetch(PDO::FETCH_ASSOC);
$dados_relato = $query_relato['total_relato'];

// Gráfico
    $enchente = $conn->query("SELECT nm_problema as `problema`, fn_totalEnchente(1)/100 * (SELECT fn_totalRelato(1) * 100)
                     as `%` 
                     FROM tb_relato WHERE nm_problema like '%enchente%' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);

    $poluicao = $conn->query("SELECT nm_problema as `problema`, fn_totalPoluicao(1)/100 * (SELECT fn_totalRelato(1) * 100)
                     as `%` 
                     FROM tb_relato WHERE nm_problema like '%poluicao%' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);

    $iluminacao = $conn->query("SELECT nm_problema as `problema`, fn_totalIluminacao(1)/100 * (SELECT fn_totalRelato(1) * 100)
                     as `%` 
                     FROM tb_relato WHERE nm_problema like '%iluminacao%' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);


    $buraco = $conn->query("SELECT nm_problema as `problema`, fn_totalBuraco(1)/100 * (SELECT fn_totalRelato(1) * 100)
                     as `%` 
                     FROM tb_relato WHERE nm_problema like '%buraco%' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);


    $engarrafamento = $conn->query("SELECT nm_problema as `problema`, fn_totalEngarrafamento(1)/100 * (SELECT fn_totalRelato(1) * 100)
                     as `%` 
                     FROM tb_relato WHERE nm_problema like '%engarrafamento%' LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);


    foreach($enchente as $data) {
        $enchente_per[] = $data['%'];
        $enchente_rep[] = $data['problema'];
    }
    foreach($poluicao as $data) {
        $poluicao_per[] = $data['%'];
        $poluicao_rep[] = $data['problema'];
    }
    foreach($iluminacao as $data) {
        $iluminacao_per[] = $data['%'];
        $iluminacao_rep[] = $data['problema'];
    }
    foreach($buraco as $data) {
        $buraco_per[] = $data['%'];
        $buraco_rep[] = $data['problema'];
    }
    foreach($engarrafamento as $data) {
        $engarrafamento_per[] = $data['%'];
        $engarrafamento_rep[] = $data['problema'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas</title>
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./styles/style.css">

    <!--Icon-->
    <link rel="icon" href="assets/logo.png">

     <!-- FONT AWESOME -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

     <!-- CHARTJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
</head>
<body style="background:#FFE3E3">

   <?php require './leyouts/side_menu.php'; ?>

    <div class="container" >
        <?php require './leyouts/header.php'; ?>

        <div class="content">

            <div class="content-2">
                    <div class="recent-payments">
                        <div class="title">
                            <h2>MÉDIA DE CASOS (%)</h2>
                        </div>
                        <div>
                            <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            
        </div>
    
        <div class="informations">
            <h3>Mais Informações</h3>
        </div>

    <div class="content-3">

        <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1><?php echo $dados_usuarios; ?></h1>
                        <h3>Usuarios<br> Cadastrados</h3>
                    </div> 
                    <div class="icon-case">
                        <i class="fa-solid fa-user-group fa-3x"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo $dados_relato; ?></h1>
                        <h3>Relatos <br>Realizados</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-comments fa-3x"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo $dados_mapa; ?></h1>
                        <h3>
                            Ocorrências <br>
                            Validadas
                        </h3>
                    </div>
                    <div class="icon-case">
                        <i class="fa-solid fa-location-dot fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
            <br><br><br><br><br>
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

    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [  
                 <?php echo json_encode($enchente_rep); ?>,
                 <?php echo json_encode($poluicao_rep); ?>,
                 <?php echo json_encode($iluminacao_rep); ?>,
                 <?php echo json_encode($engarrafamento_rep); ?>,   
                 <?php echo json_encode($buraco_rep); ?>
                ],
                
        datasets: [{
            label: '#Média calculada com base nas ocorrências validadas em nossa plataforma.',
            data: [  
                   <?php echo json_encode($enchente_per);?>,
                   <?php echo json_encode($poluicao_per);?>,
                   <?php echo json_encode($iluminacao_per); ?>,
                   <?php echo json_encode($engarrafamento_per); ?>,
                   <?php echo json_encode($buraco_per); ?>
                  ],
                  
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
                'rgba(255, 159, 64)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>