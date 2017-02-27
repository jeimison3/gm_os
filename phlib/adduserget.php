<?php
header('Content-type: application/json');
$retorno=5;//Dados insuficientes
if(isset($_GET['usnm'])){ $usnm=$_GET['usnm'];
if(isset($_GET['emai'])){ $mmail=$_GET['emai'];
if(isset($_GET['pass'])){ $pass=$_GET['pass'];
if(isset($_GET['fuln'])){ $fuln=$_GET['fuln'];
if(isset($_GET['dtnc'])){ $dtnc=$_GET['dtnc'];
if(isset($_GET['usnm'])){ $idtr=$_GET['idtr'];
include('reginf.php');
$retorno=registrar_usuario($usnm,$mmail,$pass,$fuln,$dtnc,$idtr,6);
}}}}}}
echo json_encode(array('status'=>$retorno));
/*

*/

?>