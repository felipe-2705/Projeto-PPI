<?php
class RequestResponse
{
 public $success;
 public $destination;
 function __construct($success, $destination)
 {
 $this->success = $success;
 $this->destination = $destination;
 }
}
require "authenticaiton.php";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
if(inicia_sessao($email,$senha)){
       $reposta = new RequestResponse(TRUE,"sucesso.html");
       header('Content-type: application/json');
       echo json_encode($reposta);
}else{
    $reposta = new RequestResponse(FALSE,"");
    header('Content-type: application/json');
    echo json_encode($reposta);
}
?>