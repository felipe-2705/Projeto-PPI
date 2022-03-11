<!-- <?
//require "./php/authentication.php";
//if(!check_sessao()){
//    header("location: login.html");
//    exit();
//}
?>  -->
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Funcionario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <link href="css/cadastro-funcionario.css" rel="stylesheet">

</head>

<body>
<header>
    <img src="images/coqueiro.png" alt="" id="foto">
<div id="h1">Cliníca São Domingos</div>
</header>

<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
          </a>
            <ul class="navbar-nav">
                <li class="nav-item active"><a  class="nav-link"  href="index.html">Home</a></li>
                <li  class="nav-item"><a class="nav-link"  href="endereco.html">Endereço</a></li>
                <li  class="nav-item"><a  class="nav-link" href="galeria.html">Galeria</a></li>
            </ul>
            <span></span>
    </div>
</nav>

  <div class="container">

    <main>
      <h1>Cadastro de Funcionario</h1>
      <form action="cadastro-func.php" method="POST" class="row g-3">

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
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy"
    crossorigin="anonymous"></script>

    <script>
        function revelMedico(s){
            const camps =  document.querySelectorAll(".med-camp"); // seleciona todos os med-camps 
            for(let i= 0; i<camps.length;i++){
                camps[i].style.display = s;
            }
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
        }
    </script>

    <footer class="fixed-bottom">
      05 de Março de 2022. Projeto de Programaçao para internet <strong>UFU</strong>.
  </footer>
</body>
</html>