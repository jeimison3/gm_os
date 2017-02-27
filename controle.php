<?php
header('Content-Type: text/html; charset=utf-8');
if(isset($_POST["i"])&&(intval($_POST["i"])>-1))
$id=intval($_POST["i"]); else
$id=0;

if($id==0){
echo("<center><h1>Sem início...</h1></center>");
}elseif($id==1){
$dat = file_get_contents("regs.html");
echo($dat);
}elseif($id==2){
$dat = file_get_contents("addregis.html");
echo($dat);
}

?>