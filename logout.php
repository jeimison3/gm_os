<?php
header('Content-type: application/json');
//include("./phlib/sec.php");
include_once("./phlib/getdatastate.php");
$status=false;//Não estava logado
$msg="Você não está logado.";
if(isLogged()){
CookieLogoff();
$status=true;
$msg="Logout efetuado com sucesso.";
}
echo json_encode(array('status'=>$status,'msg'=>$msg));

?>