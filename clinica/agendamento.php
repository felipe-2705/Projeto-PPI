<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agendamento de Consulta</title>

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
        
        <nav class="navbar navbar-expand-sm bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item"><a  class="nav-link"  href="index.html">Home</a></li>
                    <li  class="nav-item"><a class="nav-link"  href="endereco.html">Endereço</a></li>
                    <li  class="nav-item active"><a  class="nav-link" href="galeria.html">Galeria</a></li>
                </ul>
                <a class="btn btn-success navbar-btn" href="login.html">Login</a>
            </div>
        </nav>
        
        <div id="h1">Agendamento</div>
        
        <div class="col-sm-6">
            <label for="especialidade" class="form-label">Especialidade</label>
            <select name="especialidade" class="form-select" id="especialidade">
                <option disabled="" selected="">Selecione </option>
                <?php
                    // require "conexaoMysql.php";
                    require "php/conexaoMysql-cassio.php";
                    $pdo = mysqlConnect();

                    try{
                    $sql = <<<SQL
                        SELECT DISTINCT especialidade
                        FROM p_medico
                        SQL;

                        $stmt = $pdo->query($sql);
                    } catch (Exception $e) {
                    exit('Ocorreu uma falha: ' . $e->getMessage());
                    }
                    while ($row = $stmt->fetch()) {
                        $esp = $row['especialidade'];
                        echo <<<HTML
                        <option value='$esp'>$esp</option>    
                        HTML;
                    }
                ?>
            </select>
        </div>
        
        <form action="php/cadastro-agendamento.php" method="post">
            <div class="col-sm-6">
                <label for="medico" class="form-label">Medicos</label>
                <select name="medico" class="form-select" id="medico">
                    <option disabled="" selected="">Selecione </option>
                </select>
            </div>

            <div class="col-sm-6">
                <label for="agendamento">Data: </label>
                <input type="date" id="agendamento" name="agendamento">
            </div>

            <div class="col-sm-6">
                <label for="horario" class="form-label">Horario</label>
                <select name="horario" class="form-select" id="horario">
                    <option disabled="" selected="">Selecione </option>
                </select>
            </div>

            <div class="col-sm-6">
                <label for="nome" class="form-label">Nome completo</label>
                <input type="text" name="nome" class="form-control" id="nome">
            </div>

            <div class="col-sm-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>

            <div class="col-sm-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" class="form-select" id="sexo">
                <option disabled="" selected="">Selecione </option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="O">Outros</option>
            </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary"> Agendar</button>
            </div>
            
        </form>
        <footer class="fixed-bottom">
            05 de Março de 2022. Projeto de Programaçao para internet UFU<.
        </footer>

        <script>

            const especialidades = document.querySelector("#especialidade");
            especialidades.addEventListener('change', buscaMedicos);
            
            const agendamento = document.querySelector("#agendamento");
            // agendamento.addEventListener("change", () => console.log(agendamento.value));
            agendamento.addEventListener("change", buscaHorarios);

            function buscaMedicos(e) {
                e.preventDefault();
                const especialidade = document.querySelector("#especialidade");
    
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "./php/busca-medicos.php?especialidade=" + especialidade.value, true);
                xhr.send();
    
                xhr.onload = function() {
                    if (xhr.status != 200) {
                        console.error("Falha inesperada: " + xhr.responseText);
                    }
        
                    var medicos =  JSON.parse(xhr.responseText);
    
                    var campoSelect = document.getElementById("medico");
                    
                    for (i = campoSelect.length - 1; i >= 0; i--) {
                        campoSelect.remove(i);
                    }
    
                    for (i=0; i<medicos.length; i++) {
                    
                        medico = medicos[i];
                
                        option = document.createElement("option");
                        option.text = medico.nome;
                        option.value = medico.codigo;
                        campoSelect.add(option);
                    }   
    
                }
                xhr.onerror = function() {
                    console.error("Erro de rede");
                };
            }

            function buscaHorarios(e) {
                e.preventDefault();
                const agendamento = document.querySelector("#agendamento");
                const medico = document.querySelector("#medico");
    
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "./php/busca-agendamentos.php?agendamento=" + agendamento.value + "&medico=" + medico.value);
                xhr.send();
    
                xhr.onload = function() {
                    if (xhr.status != 200) {
                        console.error("Falha inesperada: " + xhr.responseText);
                    }
        
                    var horariosDisponiveis =  JSON.parse(xhr.responseText);
                    
                    var campoSelect = document.getElementById("horario");
                    // console.log(horariosDisponiveis);
                    
                    // limpa caso a data seja mudada
                    for (i = campoSelect.length - 1; i >= 0; i--) {
                        campoSelect.remove(i);
                    }
    
                    for (i=0; i<horariosDisponiveis.length; i++) {
                        console.log(horariosDisponiveis[i]);
                        option = document.createElement("option");
                        option.text = horariosDisponiveis[i];
                        option.value = horariosDisponiveis[i];
                        campoSelect.add(option);
                    }  
    
                }
                xhr.onerror = function() {
                    console.error("Erro de rede");
                };
            }
    
        </script>
    </body>
</html>