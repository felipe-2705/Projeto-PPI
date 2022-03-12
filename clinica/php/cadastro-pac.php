<?
require "./authentication.php";

if(!check_sessao()){
     header("location: ../login.html");
     exit();
}

$pdo = mysqlConnect();

$nome  = $_POST["nome"] ?? "";
$sexo  = $_POST["sexo"] ?? "";
$telefone       = $_POST["telefone"] ?? "";
$cep            = $_POST["cep"] ?? "";
$estado         = $_POST["estado"] ?? "";
$logradouro     = $_POST["logradouro"] ?? "";
$cidade         = $_POST["cidade"] ?? ""; 
$email          = $_POST["email"] ?? "";
$altura         = $_POST["altura"] ?? "";
$peso           = $_POST["peso"] ?? "";
$tipo_sanguineo = $_POST["tipo-sanguineo"];


$altura = (float)$altura;
$peso   = (float)$peso;
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
    INSERT INTO p_paciente(codigo,peso, tipo_sanguineo, altura)
    VALUES (?,?, ?, ?)
SQL;
    $codigo = $pdo->lastInsertId();
    $stmt =  $pdo->prepare($sql);
    if(!$stmt->execute([$codigo,$peso,$tipo_sanguineo,$altura]))
    {
        throw new Exception('Falha ao escrever em p_paciente');
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