<?
require "./php/authentication.php";
if(!check_sessao()){
      header("location: login.html");
      exit();
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meus Agendamentos</title>

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
      <li class="nav-item"><a class="nav-link" href=""><b>Meus Agendamentos</b></a></li>
      <li class="nav-item"><a class="nav-link" href="cadastro-funcionario.php">Novo Funcionário</a></li>
      <li class="nav-item"><a class="nav-link" href="cadastro-paciente.php">Novo Paciente</a></li>
      <li class="nav-item"><a class="nav-link" href="listar-funcionarios.php">Listar Funcionários</a></li>
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
        <th>Nome</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Sexo</th>
        <th>Email</th>
      </tr>

    </table>
</main>
    <footer class="fixed-bottom">
      05 de Março de 2022. Projeto de Programaçao para internet <strong>UFU</strong>.
  </footer>
</body>

<script>
   function envia() {
      let xhr = new XMLHttpRequest();
      xhr.open("GET","./php/agendamentos-medi.php");
      xhr.onload = function () {
        if (xhr.status != 200) {
          console.error("Falha inesperada: " + xhr.responseText);
          return;
        }
        try {
          var response = JSON.parse(xhr.responseText);
        }
        catch (e) {
          console.error("String JSON inválida: " + xhr.responseText);
          return;
        }
        let table = document.querySelector("table");
        for(let i=0;i<response.length;i++){
          let row =  response[i];
          let tablerow = document.createElement("tr");
            item = document.createElement("td");
            item.textContent = row["nome"];
            tablerow.appendChild(item);
            item = document.createElement("td");
            item.textContent = row["data"];
            tablerow.appendChild(item);
            item = document.createElement("td");
            item.textContent = row["horario"];
            tablerow.appendChild(item);
            item = document.createElement("td");
            item.textContent = row["sexo"];
            tablerow.appendChild(item);
            item = document.createElement("td");
            item.textContent = row["email"];
            tablerow.appendChild(item);
          table.appendChild(tablerow);
        }
      }
      xhr.onerror = function () {
        console.error("Erro de rede - requisição não finalizada");
      };
      xhr.send();
    }

    window.addEventListener("DOMContentLoaded",envia);
</script>
</html>
