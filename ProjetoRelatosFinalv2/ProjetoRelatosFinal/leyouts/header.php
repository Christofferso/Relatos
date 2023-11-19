<?php
// Inicia sessões

// Verifica se existe os dados da sessão de login
if(!isset($_SESSION["id"]) || !isset($_SESSION["nome"]))
{
// Usuário não logado! Redireciona para a página de login
header("Location: index.php");
exit;
}
  echo "<div id='BoasVindas'>";
  echo "Bem-Vindo " . $_SESSION["nome"] . "!";
  echo "</div>";

?>