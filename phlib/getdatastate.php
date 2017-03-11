<?php

function ValidKeyUser($keyInp){
include_once('./phlib/getinf.php');
return getUsrIDByKey($keyInp)!=-1;
}

function isLogged(){
include_once("./phlib/sec.php");
$data = GetCookieLog();
if($data!=null){
	if( ValidKeyUser($data) ) return true;
	else{
		CookieLogoff();
		return false;
	}
}
else return false;
}

?>