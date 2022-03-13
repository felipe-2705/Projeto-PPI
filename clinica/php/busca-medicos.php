<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try{
  $sql = <<<SQL
    SELECT m.codigo, p.nome
    FROM p_medico m
      INNER JOIN p_pessoa p ON m.codigo = p.codigo
    WHERE especialidade = ?
    SQL;

  $stmt = $pdo->prepare($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

$especialidade = $_GET['especialidade'] ?? '';

$stmt->execute([$especialidade]);

class Medico
{
  public $nome;
  public $codigo;

  function __construct($nome, $codigo)
  {
    $this->nome = $nome;
    $this->codigo = $codigo; 
  }
}

$medicos = array();
while ($row = $stmt->fetch()) {
  array_push($medicos, new Medico($row['nome'], $row['codigo']));
}
echo json_encode($medicos);