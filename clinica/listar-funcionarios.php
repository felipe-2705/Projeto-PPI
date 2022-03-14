<?
require "./php/authentication.php";
if(!check_sessao()){
      header("location: login.html");
      exit();
}
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT p.codigo, p.nome, p.sexo, p.email, p.telefone, p.cep, p.logradouro, p.cidade, p.estado,
         f.data_contrato, f.salario,
         m.crm, m.especialidade
    FROM p_funcionario f
      LEFT JOIN p_pessoa p ON f.codigo = p.codigo
      LEFT JOIN p_medico m ON f.codigo = m.codigo
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
  <title>Funcionários</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <header>
      <img width="220" height="100" class="header_logo header-logo" src="images/coqueiro.png"  alt="" >
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
      <li class="nav-item"><a class="nav-link" href="listar-funcionarios.php"><b>Listar Funcionários</b></a></li>
      <li class="nav-item"><a class="nav-link" href="listar-pacientes.php">Listar Pacientes</a></li>
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
        <th>Codigo</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>CEP</th>
        <th>Logradouro</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Data Contrato</th>
        <th>Salário</th>
        <th>CRM</th>
        <th>Especialidade</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {
        $codigo = htmlspecialchars($row['codigo']);
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $cep = htmlspecialchars($row['cep']);
        $logradouro = htmlspecialchars($row['logradouro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);
        $data_contrato = htmlspecialchars($row['data_contrato']);
        $salario = htmlspecialchars($row['salario']);
        $crm = htmlspecialchars($row['crm']);
        $especialidade = htmlspecialchars($row['especialidade']);

        echo <<<HTML
          <tr>
            <td>$codigo</td> 
            <td>$nome</td>
            <td>$sexo</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$cidade</td>
            <td>$estado</td>
            <td>$data_contrato</td>
            <td>$salario</td>
            <td>$crm</td>
            <td>$especialidade</td>
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
