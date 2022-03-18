<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$medico = $_POST["medico"] ?? "";
$agendamento = $_POST["agendamento"] ?? "";
$horario = $_POST["horario"] ?? "";
$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$sexo = $_POST["sexo"] ?? "";

try {

  $sql = <<<SQL
  INSERT INTO p_agenda (codigo_medico, p_data, horario, nome, email, sexo)
    VALUES (?, ?, ?, ?, ?, ?)
SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $medico, $agendamento, $horario,
    $nome, $email, $sexo
  ]);
  
  header("location: ../index.html");
  exit();
} 
catch (Exception $e) {  
  //error_log($e->getMessage(), 3, 'log.php');
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
