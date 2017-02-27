<?php
function strSegura($numSec,$str){
$strFinal = $str;
for ($ct=0;$ct<$numSec;$ct++){
	$strFinal = md5($strFinal);
}
return $strFinal;
}
function getN(){
	return rand(1,10000);
}
function getToBD_date($datanm,$filt){
$dt_tmp = explode($filt,$datanm);
return $dt_tmp[2]."-".$dt_tmp[1]."-".$dt_tmp[0];
}
function AddCookieLog($dataAdd){
	setcookie("_lgmdt",$dataAdd,time() + 86400);
	return true;
}
function GetCookieLog(){
	if(isset($_COOKIE["_lgmdt"]))
	return $_COOKIE["_lgmdt"];
	else return null;
}
function CookieLogoff(){
if (isset($_COOKIE['_lgmdt'])){
    unset($_COOKIE['_lgmdt']);
    setcookie('_lgmdt', '', time() - 3600);
	return true;
} else return false;
}


?>