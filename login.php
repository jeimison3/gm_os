<?php
header('Content-type: application/json');
$mensagem="Dados insuficientes para efetuar o login.";
$retorno=5;//Dados insuficientes
if(isset($_POST['usnm'])){ $usnm=$_POST['usnm'];
if(isset($_POST['pass'])){ $pass=$_POST['pass'];
include('./phlib/reginf.php');
$mensagem="Usuário ou senha incorretos.";
$retorno=3;//Dados insuficientes
$resultado=logar_usuario($usnm,$pass);
	if($resultado==1){
	$retorno=1;//Deu certo...
	$mensagem="LINK?";
	}else{
		$retorno=$resultado;
	}
}}
echo json_encode(array('status'=>$retorno,'msg'=>$mensagem));

?>