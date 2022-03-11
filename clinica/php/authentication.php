<?
require "conexaoMysql.php";

function check_login($email,$senha){
$pdo = mysqlConnect();
try {
  $sql = <<<SQL
  SELECT senha_hash
  FROM p_pessoa INNER JOIN p_funcionario WHERE p_pessoa.email = ? 
  LIMIT 1
SQL;
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
if ($row =$stmt->fetch()){
    $senhaHash_db =  $row['senha_hash'];
    if(password_verify($senha,$senhaHash_db)){
       return TRUE;
    }else{
     return FALSE;
    }
}else{
  return FALSE;
}
}



function inicia_sessao($email,$senha){
    $pdo = mysqlConnect();
    try{
        $sql = <<<SQL
        SELECT p_pessoa.codigo,email,senha_hash,nome,sexo,telefone,cep,logradouro,cidade,estado,data_contrato,salario
        FROM p_pessoa INNER JOIN p_funcionario WHERE p_pessoa.codigo = p_funcionario.codigo
SQL;
$stmt = $pdo->query($sql);
    }
catch (Exception $e) {
        //error_log($e->getMessage(), 3, 'log.php');
        exit('Ocorreu uma falha: ' . $e->getMessage());
}
while($row = $stmt->fetch()){
    if($row['email']==$email and password_verify($senha,$row["senha"]) ){
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["senha_hash"] = $row["senha_hash"];
        $_SESSION["nome"] = $row["nome"];
        $_SESSION["sexo"] = $row["sexo"];
        $_SESSION["telefone"] = $row["telefone"];
        $_SESSION["cep"] = $row["cep"];
        $_SESSION["logradouro"] = $row["logradouro"];
        $_SESSION["cidade"] = $row["cidade"];
        $_SESSION["estado"] = $row["estado"];
        $_SESSION["data_contrato"] = $row["data_contrato"];
        $_SESSION["salario"] = $row["salario"];
        $_SESSION["codigo"]  = $row["p_pessoa.codigo"];
        ////// checando se é um medico 
        try{
            $sql = <<<SQL
            SELECT especialidade,crm
            FROM p_medico WHERE codigo = ?
SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$row["codigo"]]);
        }
        catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
        if($row =  $stmt->fetch()){
            $_SESSION["is_medico"] = TRUE;
            $_SESSION["especialidade"] = $row["especialidade"];
            $_SESSION["crm"] = $row["crm"];
        }else{
            $_SESSION["is_medico"] = FALSE;
        }
        return TRUE;
    }
}
return FALSE;
}

function finaliza_sessao(){
session_unset();
session_destroy();
}

function check_sessao(){
    if(!isset($_SESSION["email"],$_SESSION["senha_hash"])){
        return  FALSE;
    }

    if(!check_login($_SESSION["email"],$_SESSION["senha_hash"])){
        return FALSE;
    }
    return TRUE;
}

?>