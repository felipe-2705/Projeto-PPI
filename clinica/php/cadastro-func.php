<?
require "./authentication.php";

// if(!check_sessao()){
//     header("location: ../login.html");
//     exit();
// }

$pdo = mysqlConnect();

$nome  = $_POST["nome"] ?? "";
$sexo  = $_POST["sexo"] ?? "";
if(isset($_POST["medico"])){
    $medico = TRUE;
}else{
    $medico = FALSE;
}
$telefone       = $_POST["telefone"] ?? "";
$cep            = $_POST["cep"] ?? "";
$estado         = $_POST["estado"] ?? "";
$logradouro     = $_POST["logradouro"] ?? "";
$cidade         = $_POST["cidade"] ?? "";
$data_contrato  = $_POST["data-contrato"] ?? "";
$salario        = $_POST["salario"] ?? ""; 
$email          = $_POST["email"] ?? "";
$senha          = $_POST["senha"] ?? "";
if($medico){
    $crm  = $_POST["crm"];
    $especialidade = $_POST["especialidade"];
}
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$salario    = (float)$salario;

try{
    $pdo->beginTransaction();
    $sql = <<<SQL
    INSERT INTO p_pessoa(nome, sexo, email, telefone,
                        cep, logradouro, cidade,estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
SQL;

    $stmt =  $pdo->prepare($sql);
    if(!$stmt->execute([$nome,$sexo,$email,$telefone,$cep,$logradouro,$cidade,$estado]))
    {
        throw new Exception('Falha ao escrever em p_pessoa');
    }

    $sql = <<<SQL
    INSERT INTO p_funcionario(data_contrato, salario, senha_hash, codigo)
    VALUES (?, ?, ?, ?)
SQL;
    $codigo = $pdo->lastInsertId();
    $stmt = $pdo->prepare($sql);
    if(!$stmt->execute([$data_contrato,$salario,$senha_hash,$codigo])){
        throw new Exception('Falha ao escrever em p_funcionario');
    }

    if($medico){
        $sql = <<<SQL
    INSERT INTO p_medico(especialidade, crm, codigo)
    VALUES (?, ?, ?)
SQL;
        $stmt = $pdo->prepare($sql);
        if(!$stmt->execute([$especialidade,$crm,$codigo]))
        {
            throw new Exception('Falha ao escrever em p_medico');
        }
    }

$pdo->commit();
}catch(Exception $e){
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
?>