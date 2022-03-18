<?
require "./php/authentication.php";
if(!check_sessao()){
      header("location: login.html");
      exit();
}

$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT p.nome, p.sexo, p.email, p.telefone, p.cep, p.logradouro, p.cidade, p.estado,
         pc.peso, pc.altura, pc.tipo_sanguineo
    FROM p_paciente pc
      INNER JOIN p_pessoa p ON pc.codigo = p.codigo
SQL;
  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pacientes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <header>
      <img src="images/coqueiro.png" alt="" id="logo">
  <div id="h1">Cliníca São Domingos</div>
</header>

<nav class="navbar navbar-expand-sm bg-ligh custom-navbar">
    <div class="container-fluid">
<?php
$nome =  htmlspecialchars($_SESSION["nome"]);
echo <<<HTML
        <a class="navbar-brand" href="#">
            Olá, $nome
          </a>
HTML;
?>
  <ul class="navbar-nav" id="navbar">
      <li class="nav-item"><a class="nav-link" href="cadastro-funcionario.php">Novo Funcionário</a></li>
      <li class="nav-item"><a class="nav-link" href="cadastro-paciente.php">Novo Paciente</a></li>
      <li class="nav-item"><a class="nav-link" href="listar-funcionarios.php">Listar Funcionários</a></li>
      <li class="nav-item"><a class="nav-link" href="listar-pacientes.php"><b>Listar Pacientes</b></a></li>
      <li class="nav-item"><a class="nav-link" href="listar-todos-agendamentos.php">Listar Agendamentos</a></li>
      <li class="nav-item"><a class="nav-link" href="listar-enderecos.php">Listar Endereços</a></li> 
  </ul>
  <a class="btn btn-danger navbar-btn" href="php/logout.php">Logout</a>
  <span></span>
    </div>
</nav>
<main class="container">
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Peso</th>
        <th>Altura</th>
        <th>Tipo Sanguineo</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>CEP</th>
        <th>Logradouro</th>
        <th>Cidade</th>
        <th>Estado</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $peso = htmlspecialchars($row['peso']);
        $altura = htmlspecialchars($row['altura']);
        $tipo_sanguineo = htmlspecialchars($row['tipo_sanguineo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $cep = htmlspecialchars($row['cep']);
        $logradouro = htmlspecialchars($row['logradouro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);

        echo <<<HTML
          <tr>
            <td>$nome</td>
            <td>$sexo</td>
            <td>$peso</td>
            <td>$altura</td>
            <td>$tipo_sanguineo</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$cidade</td>
            <td>$estado</td>
          </tr>      
HTML;

      }
      ?>

    </table>
</main>
    <footer class="fixed-bottom">
      05 de Março de 2022. Projeto de Programaçao para internet <strong>UFU</strong>.
  </footer>
  <script src="priv-navbar.js"></script>
</body>
</html>
