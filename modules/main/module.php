<?php
class MainModule{
	function initModules(){
		return array(
		"app_name"=>"GM_OS",
		"app_class"=>"app.main",
		"app_ver"=>1.000);
	}
	
	function MenuReference(){
		return array(
		array('title'=>'Perfil',
		'icon'=>'glyphicon glyphicon-user',
		'linkref'=>'profile.php',
		'color'=>'lime'),
		array('title'=>'Propriedades',
		'icon'=>'glyphicon glyphicon-wrench',
		'linkref'=>'properties.php',
		'color'=>'lime'),
		array('title'=>'Sair',
		'icon'=>'glyphicon glyphicon-log-out',
		'linkref'=>'./modules/main/logoutme.html',
		'color'=>'rgb(255,165,0)'));
	}
}

?>