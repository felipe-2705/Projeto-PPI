<?
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
require "authentication.php";
if(check_sessao()){
    finaliza_sessao();
    header("location: ../index.html");
    exit();
}
?>