<?php
class ModuleArray{
	static private $PreModule=array();
	static private $modules=array();
	static private $dataModules=array();
	static private $buttonModules=array();
	
	function addModule($modul){
		array_push(self::$modules,$modul);
	}
	
	function getModuleClass($ModuleNm,$ModuleClass){
		include('./modules/'.$ModuleNm.'/module.php');
		return new $ModuleClass();
	}
	
	function preloadedModulesSetup(){
		foreach(self::$PreModule as $ModuloDados){
			$this->addModule($this->getModuleClass($ModuloDados["nome"],$ModuloDados["classe"]));
		}
	}
	
	function addPreloadModule($Pasta,$Classe){
		array_push(self::$PreModule,array("nome"=>$Pasta,"classe"=>$Classe));
	}
	
	function initModules(){
		foreach(self::$modules as $module){
		//1º: Inicializa, pega informações...
		array_push(self::$dataModules,$module->initModules());
		//2º: Extrai botões.
		foreach($module->MenuReference() as $botaoTmp)
		array_push(self::$buttonModules,$botaoTmp);
		}
		
	}
	
	function getDataModules(){return self::$dataModules;}
	function findModuleClass($NameClass){
		$result = null;
		foreach(self::$modules as $modulo)
		if($NameClass==$modulo->initModules()["app_class"]) $result = $modulo;
	return $result;
	}
	function getButtonsModules(){return self::$buttonModules;}
}
?>