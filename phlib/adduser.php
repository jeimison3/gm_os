<?php
header('Content-type: application/json');
$retorno=5;//Dados insuficientes
if(isset($_POST['usnm'])){ $usnm=$_POST['usnm'];
if(isset($_POST['emai'])){ $mmail=$_POST['emai'];
if(isset($_POST['pass'])){ $pass=$_POST['pass'];
if(isset($_POST['fuln'])){ $fuln=$_POST['fuln'];
if(isset($_POST['dtnc'])){ $dtnc=$_POST['dtnc'];
if(isset($_POST['usnm'])){ $idtr=$_POST['idtr'];
include('reginf.php');
$retorno=registrar_usuario($usnm,$mmail,$pass,$fuln,$dtnc,$idtr,6);
}}}}}}
echo json_encode(array('status'=>$retorno));
/*

*/

?>