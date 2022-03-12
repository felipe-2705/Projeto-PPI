<?
require "./authentication.php";

if(!check_sessao()){
     header("location: ../login.html");
     exit();
}


if($_SESSION["is_medico"]){
    $array  = array(
        "email" => $_SESSION["email"],
        "senha_hash" => $_SESSION["senha_hash"],
        "nome"       => $_SESSION["nome"],
        "sexo"       => $_SESSION["sexo"],
        "telefone"   => $_SESSION["telefone"],
        "cep"        => $_SESSION["cep"],
        "logradouro" => $_SESSION["logradouro"],
        "cidade"     => $_SESSION["cidade"],
        "estado"     => $_SESSION["estado"],
        "data_contrato" => $_SESSION["data_contrato"],
        "salario"      => $_SESSION["salario"],
        "is_medico" => $_SESSION["is_medico"],
        "especialidade" => $_SESSION["especialidade"],
        "crm"      => $_SESSION["crm"]
    );
}else{
    $array  = array(
        "email" => $_SESSION["email"],
        "senha_hash" => $_SESSION["senha_hash"],
        "nome"       => $_SESSION["nome"],
        "sexo"       => $_SESSION["sexo"],
        "telefone"   => $_SESSION["telefone"],
        "cep"        => $_SESSION["cep"],
        "logradouro" => $_SESSION["logradouro"],
        "cidade"     => $_SESSION["cidade"],
        "estado"     => $_SESSION["estado"],
        "data_contrato" => $_SESSION["data_contrato"],
        "salario"      => $_SESSION["salario"],
        "is_medico" => $_SESSION["is_medico"]
    );
}

echo json_encode($array);