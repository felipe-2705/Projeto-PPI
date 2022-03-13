<?php

// require "conexaoMysql.php";
require "conexaoMysql-cassio.php";
$pdo = mysqlConnect();

$p_data = $_GET['agendamento'] ?? '';
$codigo_medico = $_GET['medico'] ?? '';

try{
  $sql = <<<SQL
    SELECT horario  
    FROM p_agenda
    WHERE p_data = ? AND codigo_medico = ?
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$p_data,$codigo_medico]);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

$h_ocupados = array();
while ($row = $stmt->fetch()) {
  array_push($h_ocupados, $row['horario']);
}

$h_disponiveis = array();
// popula com as horas disponiveis
for ($i=8; $i<18; $i++){
  array_push($h_disponiveis, strval($i));
}
// remove as horas ja marcadas das opções passadas
foreach ($h_ocupados as $h_ocupado){
  $key = array_search($h_ocupado, $h_disponiveis);
  if (!is_null($key)) {
    unset($h_disponiveis[$key]);
  }
}

// reorganiza as chaves do array para o uso no js
$h_disponiveis = array_values($h_disponiveis);

echo json_encode($h_disponiveis);