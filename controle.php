<?php
header('Content-Type: text/html; charset=utf-8');
if(isset($_POST["i"])&&(intval($_POST["i"])>-1))
$id=intval($_POST["i"]); else
$id=1;

include_once("./phlib/getdatastate.php");
if(($id==1)&&(isLogged())) $id=0;

if($id==0){
include_once('ifaces.php');
echo(getifacesData());
}elseif($id==1){
$dat = file_get_contents("regs.html");
echo($dat);
}elseif($id==2){
$dat = file_get_contents("addregis.html");
echo($dat);
}

?>