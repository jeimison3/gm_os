<?php
class Test{
	function initModules(){
		return array(
		"app_name"=>"Teste",
		"app_class"=>"app.test",
		"app_ver"=>1.000);
	}
	
	function postInitModules(){
		echo("Carregados:".
		iFaces::$ModulArr->findModuleClass("app.main")->initModules()["app_name"]);
	}
	
	function MenuReference(){
		return array(
		array('title'=>'TESTE 1',
		'icon'=>'glyphicon glyphicon-envelope',
		'linkref'=>'http://google.com/',
		'color'=>'blue'),
		array('title'=>'TESTE 2',
		'icon'=>'glyphicon glyphicon-envelope',
		'linkref'=>'http://google.com/',
		'color'=>'cyan'),
		array('title'=>'TESTE 3',
		'icon'=>'glyphicon glyphicon-envelope',
		'linkref'=>'http://google.com/',
		'color'=>'red')
		);
	}
}

?>