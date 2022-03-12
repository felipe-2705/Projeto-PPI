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
  <title>Cadastro de Funcionario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="css/cadastro-funcionario.css" rel="stylesheet">
  <link href="css/navbar.css" rel="stylesheet">
</head>

<body>
<header>
    <img src="images/coqueiro.png" alt="" id="foto">
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
                <li class="nav-item active"><a  class="nav-link"  href="cadastro-funcionario.php">Novo funcionario</a></li>
                <li  class="nav-item"><a class="nav-link"  href="cadastro-paciente.php">Novo paciente</a></li>
                <li  class="nav-item"><a  class="nav-link" href="listar-funcionarios.php">Listar Funcionários</a></li>
                <li  class="nav-item"><a  class="nav-link" href="listar-pacientes.php">Listar Pacientes</a></li>
                <li  class="nav-item"><a  class="nav-link" href="listar-enderecos.php">Listar Endereços</a></li> 
                <li  class="nav-item"><a  class="nav-link" href="listar-todos-agendamentos.php">Listar todos agendamentos</a></li>
            </ul>
            <span></span>
    </div>
</nav>
  <div class="container">
    <main>
      <h1>Cadastro de Funcionario</h1>
      <form class="row g-3">

        <!-- Nome e Sexo -->
        <div class="col-sm-6">
          <label for="nome" class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control" id="nome">
        </div>
        <div class="col-sm-3">
          <label for="sexo" class="form-label">Sexo</label>
          <select name="sexo" class="form-select" id="sexo">
            <option selected>Selecione</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="O">Outros</option>
          </select>
        </div>

        <div class="col-sm-3">
        <input type="checkbox" class="form-check-input" name="medico" id="medico">
        <label for="medico" class="form-check-label">Medico</label>
        </div>

         <!-- Telefone CEP LOGRADOURO CIDADE BAIRRO ESTADO-->

         <div class="col-sm-6">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="tel" name="telefone" class="form-control" id="telefone">
        </div>
        
        <div class="col-sm-3">
          <label for="cep" class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control" id="cep">
        </div>

        <div class="col-sm-3">
          <label for="estado" class="form-label">Estado</label>
          <select name="estado" class="form-select" id="estado">
            <option selected>Selecione</option>
            <option value="MG">MG</option>
            <option value="RJ">RJ</option>
            <option value="SP">SP</option>
            <option value="ES">ES</option>
            <option value="SC">SC</option>
            <option value="RS">RS</option>
            <option value="PR">PR</option>
            <option value="MT">MT</option>
            <option value="MS">MS</option>
            <option value="GO">GO</option>
            <option value="TO">TO</option>
            <option value="BA">BA</option>
            <option value="PE">PE</option>
            <option value="AL">AL</option>
            <option value="PB">PB</option>
            <option value="SE">SE</option>
            <option value="PI">PI</option>
            <option value="MA">MA</option>
            <option value="PA">PA</option>
            <option value="CE">CE</option>
            <option value="RN">RN</option>
            <option value="AP">AP</option>
            <option value="RO">RO</option>
            <option value="RR">RR</option>
            <option value="AM">AM</option>
            <option value="AC">AC</option>
          </select>
        </div>


        <div class="col-sm-6">
          <label for="logradouro" class="form-label">Logradouro</label>
          <input type="text" name="logradouro" class="form-control" id="logradouro">
        </div>

        <div class="col-sm-6">
          <label for="cidade" class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control" id="cidade">
        </div>

        <!-- Data de contrato  salario dados medicos-->
        <div class="col-sm">
          <label for="data-contrato" class="form-label">Data de Contrato</label>
          <input type="date" name="data-contrato" class="form-control" id="data-contrato">
        </div>
        <div class="col-sm">
          <label for="salario" class="form-label">Salario</label>
          <input type="text" name="salario" class="form-control" id="salario">
        </div>
        <div class="col-sm med-camp " style:"display: none;">
        <label for="crm" class="form-label">CRM</label>
          <input type="text" name="crm" class="form-control" id="crm">
        </div>
        <div class="col-sm med-camp" style:"display: none;">
        <label for="especialidade" class="form-label">Especialidade</label>
          <input type="text" name="especialidade" class="form-control" id="especialidade">
        </div>
<!-- E-mail e senha -->
        <div class="col-sm-9">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="col-sm-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" id="senha">
        </div>


        <div class="col-12">
          <button type="button" class="btn btn-primary" id="btncadastro">Cadastrar</button>
        </div>
      </form>
      <div class="alert alert-warning alert-dismissible" role="alert" id="loginFailMsg" style="display: none;">
          <strong>Dados Cadastrados com Sucesso</strong>
          <button type="button" class="btn-close" data-dismiss="alert"></button>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
    crossorigin="anonymous"></script>

    <script>
      function closeAlert(){
        const msg  = document.querySelector("#loginFailMsg");
        msg.style.display = "none";
    }


        function revelMedico(s){
            const camps =  document.querySelectorAll(".med-camp"); // seleciona todos os med-camps 
            for(let i= 0; i<camps.length;i++){
                camps[i].style.display = s;
            }
        }
        
      function enviaForm() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./php/cadastro-func.php");
        xhr.onload = function () {
          if (xhr.status != 200) {
            console.error("Falha inesperada: " + xhr.responseText);
            return;
          }else{
            const msg  = document.querySelector("#loginFailMsg");
            msg.style.display = "block";
          }
        }
        xhr.onerror = function () {
          console.error("Erro de rede - requisição não finalizada");
        };
        const form = document.querySelector("form");
        xhr.send(new FormData(form));
    }

    function complete_endereco(cep){
      if (cep.length != 9) return;      
      let form = document.querySelector("form");
      fetch("./php/busca-endereco.php?cep="+cep)
      .then(response => {
          if (!response.ok) {
            throw new Error(response.status);
          }
          return response.json();
        })
        .then(endereco => {
          form.logradouro.value = endereco.logradouro;
          form.cidade.value = endereco.cidade;
          form.estado.value = endereco.estado;
        })
        .catch(error => {
          console.error('Falha inesperada: ' + error);
        });
    }

        window.onload = function (){
            revelMedico("none");
            const checkbox =  document.querySelector("#medico");
           checkbox.addEventListener("change",function(){
               if (this.checked){
                   revelMedico("inline-block");
               }else{
                revelMedico("none");
               }
           })
           const btncadastro = document.querySelector("#btncadastro");
          btncadastro.onclick = enviaForm;
          const btnAlert  = document.querySelector(".btn-close");
          btnAlert.onclick = closeAlert;

          const input_cep = document.querySelector("#cep");
          input_cep.onkeyup = ()=> complete_endereco(input_cep.value);
        }
    </script>

    <script src="priv-navbar.js"></script>
    <footer class="fixed-bottom">
      05 de Março de 2022. Projeto de Programaçao para internet <strong>UFU</strong>.
  </footer>
</body>
</html>