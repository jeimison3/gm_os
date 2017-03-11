<?php
header('Content-type: application/json');
//header('Content-type: text/html');

$ZeroFMail="zero@fill.com";

function InscricoesAtivas(){
include_once('zconbd.php');
$query = "SELECT periodo_inscri from system_defs";
if ($stmt = mysqli_prepare($con, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $dataLimite);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	//return $dataLimite;
	$differ = strtotime($dataLimite)-strtotime(date("Y-m-d H:i:s"));
	//echo($differ);
	return $differ>0;
	
}else return false;
}
function UsuarioPermitido($usuario,$email){
	$ZeroFMail="zero@fill.com";
$resu = ((GetUserBy("email",$email)==null)||($email==$ZeroFMail));
$resu = $resu && (GetUserBy("username",$usuario)==null);
return $resu;
}


function registrar_usuario($UserName,$E_mail,$Passwd,$NomeCmplt,$DataNasci,$idturma,$id_creden){
include_once('getinf.php');
if(InscricoesAtivas()&&UsuarioPermitido($UserName,$E_mail)){
$retornoCod = 4; //Erros inesperados
include('zconbd.php');
include('sec.php');
$stmt = mysqli_prepare($con, "INSERT INTO usuarios VALUES (null, ?,?,?,?,?, ?,?,?)");
mysqli_stmt_bind_param($stmt, 'sssssiii', $user, $email, $senh, $nom_comp, $datNasc, $id_turma, $id_cred, $numsec);
$user=$UserName;
$email=$E_mail;
$numsec = getN();
$senh=strSegura($numsec,$Passwd);
$nom_comp=$NomeCmplt;
$datNasc=getToBD_date($DataNasci,"/");
$id_turma=$idturma;
$id_cred=6;
mysqli_stmt_execute($stmt);
$retornoCod = 2; //Falha ao registrar usuário
if(mysqli_stmt_affected_rows($stmt)>0){
	$stmtKey = mysqli_prepare($con, "INSERT INTO usuarios_keys VALUES (null, ?, ?)");
	mysqli_stmt_bind_param($stmtKey, 'is', $id_usr, $key_usr);
	$id_usr=GetUserBy("username",$UserName);
	$key_usr=strSegura(16,strSegura(128,strSegura(64,$UserName).$numsec));
	mysqli_stmt_execute($stmtKey);
if(mysqli_stmt_affected_rows($stmtKey)>0)$retornoCod = 0; else $retornoCod=3; //Dados não inseridos.
	mysqli_stmt_close($stmtKey);
}else{
	if(GetUserBy("username",$UserName)!=null) $retornoCod = 7; //Usuário já registrado
	if(GetUserBy("email",$E_mail)!=null) $retornoCod = 6; //E-mail já registrado
}
mysqli_stmt_close($stmt);
return $retornoCod;

}else{
	$ZeroFMail="zero@fill.com";
if (!InscricoesAtivas())
return 1; //Fora do período de inscrições
elseif(($E_mail!=$ZeroFMail)&&(GetUserBy("email",$E_mail)!=null)) return 6;//E-mail já registrado
elseif(GetUserBy("username",$UserName)!=null) return 7;//Usuário já registrado
else return 8; //Erro desconhecido :x
}
}

//=========================================================================

function logar_usuario($UserName,$Passwd){
include_once("./phlib/getinf.php");
$keyRead = GetKeyByCredenLogin($UserName,$Passwd);
$resumo = $keyRead["errorcode"];
if ($resumo==1) AddCookieLog($keyRead["key"]);
return $resumo;
}
?>