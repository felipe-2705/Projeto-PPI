<?php

class Endereco
{
  public $logradouro;
  public $estado;
  public $cidade;

  function __construct($logradouro, $estado, $cidade)
  {
    $this->logradouro = $logradouro;
    $this->estado = $estado;
    $this->cidade = $cidade;
  }
}
$cep = $_GET['cep'] ?? '';

require  "conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = <<<SQL
    SELECT logradouro,cidade,estado
    FROM p_enderecos WHERE p_enderecos.cep = ? 
SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);
}catch(Exception $e){
    exit('Falha : ' . $e->getMessage());
}

if($row = $stmt->fetch()){
    $endereco = new Endereco($row["logradouro"],$row["estado"],$row["cidade"]);
}else{
    $endereco = new Endereco("","","");
}

echo json_encode($endereco);