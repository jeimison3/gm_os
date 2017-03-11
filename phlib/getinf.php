<?php
//header('Content-type: application/json');
//header('Content-type: text/html');

function GetUserBy($dataname,$input){
include_once('./phlib/zconbd.php');
$query = "SELECT id_usr from usuarios where $dataname=?";
if ($stmt = mysqli_prepare($con, $query)) {
	mysqli_stmt_bind_param($stmt, 's', $entr);
	$entr = $input;
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $dadosUsuario);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	return $dadosUsuario;
}else return null;
}

function getUsrIDByKey($keyUsr){
include_once('./phlib/zconbd.php');
$query = "SELECT usuarios_keys.id_usr from usuarios_keys where usuarios_keys.key_value=?";
$usr=-1;
$erroFinal=0;
if ($stmt = mysqli_prepare($con, $query)){
	mysqli_stmt_bind_param($stmt, 's', $entr);
	$entr = $keyUsr;
	mysqli_stmt_execute($stmt);
	$erroFinal = 0;//Falha
	if(mysqli_stmt_num_rows($stmt)==1){
	mysqli_stmt_bind_result($stmt, $usrID);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
			$erroFinal = 1;//Ok
			$usr=$usrID;
	}
}
return array("user"=>$usr,"errorcode"=>$erroFinal);
}

function GetKeyByCredenLogin($Usnm,$Passwd){
include_once('./phlib/zconbd.php');
include_once('./phlib/sec.php');
$query = "SELECT usuarios.passwd,usuarios.numsec,usuarios_keys.key_value from usuarios inner join usuarios_keys on usuarios_keys.id_usr=usuarios.id_usr and usuarios.username=?";
$erroFinal = -1;//Sem conexão com o banco de dados
$key="?";
if ($stmt = mysqli_prepare($con, $query)){
	mysqli_stmt_bind_param($stmt, 's', $entr);
	$entr = $Usnm;
	mysqli_stmt_execute($stmt);
	$erroFinal = 0;//Dados de login incorretos.
	if(mysqli_stmt_affected_rows($stmt)==-1){		
	mysqli_stmt_bind_result($stmt, $passencoded, $numsec, $keypass);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
		if($passencoded == strSegura(intval($numsec),$Passwd)){
			$erroFinal = 1;//Ok!
			$key=$keypass;
		}
	}
}
return array("key"=>$key,"errorcode"=>$erroFinal);
}


?>