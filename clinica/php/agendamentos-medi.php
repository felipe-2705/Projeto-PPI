<?
require "./authentication.php";
session_start();
if(!check_sessao()){
      header("location: login.html");
      exit();
}

$pdo = mysqlConnect();
try {
  
  $sql = <<<SQL
  SELECT p_agenda.codigo, p_agenda.nome, p_agenda.p_data, p_agenda.horario, p_agenda.sexo, p_agenda.email as agenda_email,p_pessoa.email as pessoa_email
    FROM p_agenda INNER JOIN p_pessoa
      WHERE codigo_medico = p_pessoa.codigo
SQL;
  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
$tabela = array();
while ($row = $stmt->fetch()) {
  if($row['pessoa_email'] == $_SESSION['email']){
    $codigo = htmlspecialchars($row['codigo']);
    $nome = htmlspecialchars($row['nome']);
    $data = htmlspecialchars($row['p_data']);
    $horario = htmlspecialchars($row['horario']);
    $sexo = htmlspecialchars($row['sexo']);
    $email = htmlspecialchars($row['agenda_email']);
        $linha = array(
                "codigo" => $codigo,
                "nome"   => $nome,
                "data"   => $data,
                "horario"=> $horario,
                "sexo"   => $sexo,
                "email"  => $email
        );
        array_push($tabela,$linha);
      }
  }
  header('Content-type: application/json');
  echo json_encode($tabela);
?>