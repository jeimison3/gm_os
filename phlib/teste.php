<?php
/*
include('reginf.php');
if (InscricoesAtivas()){
	echo('estao ativas');
}else
	echo('nao estao ativas');*/
include('getinf.php');
echo GetUserByMail("jeimison3@gml.com");
?>