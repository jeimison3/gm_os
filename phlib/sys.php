<?php
header('Content-type: application/json');
//header('Content-type: text/html');
/*Documentação:
ARG1, ARG2, ARG3, ARG4, [...] para tentar repassar atributos, sem padrão notável
	TP=
tp's:
0 - Registrar turmas (nome, ano de inicio)
1 - Registrar áreas (nome)
2 - Registrar periodos (ano, bimestre e tipo de avaliação)
3 - Registrar disciplinas (nome, id da area)
4 - Registrar provas (id da turma, id do periodo)
5 - Registrar alunos (id do aluno, nome, id da turma, data de nascimento e sexo)
6 - Registrar questões (texto, dificuldade, item correto, item_a, item_b, item_c, item_d, item_e)
7 - Registrar gabaritos (id da prova, id da questão)
8 - Registrar respostas (id do aluno, id da prova, item marcado)

11 - Ler dados:
	0- Ver turmas.
	1- Ver áreas.
	2- Ver disciplinas.
	3- Ver periodos.
	4- Ver provas com dados de tabelas abaixo.
	5-
	6- Ver disciplinas por area.
	7-
	8- Ver gabarito por id da prova e da disciplina.
	9- 
	10-
	11- Verifica matrícula... Se OK, retorna vetor de provas.
*/
include('zconbd.php');


function getTodasQuests(){
	include('zconbd.php');
	$sqlQr = "select provas.id_prova,periodos.bimestre,periodos.ano,periodos.tipo_avaliacao,turmas.nome,turmas.ano_inicio from provas inner join periodos on provas.id_periodo=periodos.id_periodo inner join turmas on turmas.id_turma=provas.id_turma order by provas.id_prova DESC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getQuestsByDscpID($disciplinaID){
	include('zconbd.php');
	$sqlQr = "select * from Questoes where id_dscp=".$disciplinaID." order by id_questao DESC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getGabaritoByProvaAndDiscip($provaID,$discipID){
	include('zconbd.php');
	$sqlQr = "select Gabaritos.id_gab, Gabaritos.id_questao from Gabaritos inner join Questoes on Questoes.id_questao=Gabaritos.id_questao and Gabaritos.id_prova=".intval($provaID)." and Questoes.id_dscp=".intval($discipID).";";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getProvasViewData(){
	include('zconbd.php');
	$sqlQr = "select provas.id_prova,periodos.bimestre,periodos.ano,periodos.tipo_avaliacao,turmas.nome,turmas.ano_inicio from provas inner join periodos on provas.id_periodo=periodos.id_periodo inner join turmas on turmas.id_turma=provas.id_turma order by provas.id_prova DESC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getDisciplinasDataByProva($id_prova){
	include('zconbd.php');
	$query_Discips="select Disciplinas.id_dscp,Disciplinas.nome from Disciplinas;";
	$dados = mysqli_query($con,$query_Discips) or die(mysql_error());
	
	//$sqlQr = "select Disciplinas.nome,Count(Questoes.id_dscp) from Disciplinas inner join Questoes on Questoes.id_dscp=Disciplinas.id_dscp inner join Gabaritos on Gabaritos.id_questao=Questoes.id_questao inner join Provas on Gabaritos.id_prova=Provas.id_prova and Provas.id_prova=".$id_prova.";";
	//$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	
	$data = array();	
	while($consulta = mysqli_fetch_array($dados)){
			$queryTamanho="select count(Gabaritos.id_gab) from Gabaritos inner join Questoes on Questoes.id_dscp=".$consulta["id_dscp"]." and Gabaritos.id_questao=Questoes.id_questao where Gabaritos.id_prova=".$id_prova.";";
			$dadoTamanho = mysqli_query($con,$queryTamanho) or die(mysql_error());
			$consultaTamanho = mysqli_fetch_array($dadoTamanho);
			
			$data=array_merge($data,array(
			array_merge($consulta,$consultaTamanho)));
	}
	return $data;
}

function getQuestoesByProva($id_prova,$id_disciplina){
	include('zconbd.php');
			$queryQuests="select Questoes.* from Gabaritos inner join Questoes on Questoes.id_dscp=".$id_disciplina." and Gabaritos.id_questao=Questoes.id_questao where Gabaritos.id_prova=".$id_prova.";";
			$dadoQuests = mysqli_query($con,$queryQuests) or die(mysql_error());
	$data = array();	
	while($consulta = mysqli_fetch_array($dadoQuests)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getTurmas(){
	include('zconbd.php');
	$sqlQr = "select * from Turmas order by nome,ano_inicio ASC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();
	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
			
	}
	return $data;
}
function getAreas(){
	include('zconbd.php');
	$sqlQr = "select * from AreasDisciplinas order by nome ASC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();
	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getPeriodos(){
	include('zconbd.php');
	$sqlQr = "select * from Periodos order by ano DESC,bimestre DESC,id_periodo ASC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();
	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getDisciplinas(){
	include('zconbd.php');
	$sqlQr = "select * from Disciplinas order by id_area,nome ASC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();
	
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function getDisciplinasByArea($id_area){
	include('zconbd.php');
	$sqlQr = "select * from Disciplinas where id_area=".$id_area." order by id_area,nome ASC;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

function provasFromMatricula($id_matric){
	include('zconbd.php');
	$sqlQr = "select Provas.id_prova,Periodos.bimestre,Periodos.ano,Periodos.tipo_avaliacao from Provas inner join Alunos on Provas.id_turma=Alunos.id_turma and Alunos.id_aluno=".$id_matric." inner join Periodos on Periodos.id_periodo=Provas.id_periodo;";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$data = array();
	while($consulta = mysqli_fetch_array($dados)){
			$data=array_merge($data,array($consulta));
	}
	return $data;
}

//echo var_dump($data);
function execQuestao_oper_excluir($gabID){
	include('zconbd.php');
	$sqlQr = "delete from Gabaritos where id_gab=".$gabID.";";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	return $dados;
}

function execQuestao_oper_incluir($provaID,$questID){
	include('zconbd.php');
	$sqlQr = "insert into Gabaritos(`id_gab`,`id_prova`,`id_questao`) values (NULL,".$provaID.",".$questID.");";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	return $dados;
}

function matriculaExists($matricID){
	include('zconbd.php');
	$sqlQr = "select id_aluno from Alunos where id_aluno=".$matricID.";";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$row_cnt = mysqli_num_rows($dados);
	return $row_cnt==1;
}


function getProva_cfgFetchSearch($dadosDeBusca){
	$sqlQr = "select * from Provas where ".$dadosDeBusca.";";
	$dados = mysqli_query($con,$sqlQr) or die(mysql_error());
	$consulta = mysqli_fetch_array($dados);
	return $consulta;
}

if(isset($_POST["TP"]) && ( intval($_POST["TP"])<9 )){
	$tp = intval($_POST["TP"]);
	$sql_query="";
	
	//Registrar turma
	if(($tp==0)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"]))){
		$arg1 = $_POST["ARG1"];
		$arg2 = $_POST["ARG2"];
		$sql_query="insert into Turmas(`id_turma`,`nome`,`ano_inicio`) values (NULL,'".$arg1."',".$arg2.");";
	}
	
	//Registrar área
	if(($tp==1)&&(isset($_POST["ARG1"]))){
		$arg1 = $_POST["ARG1"];
		$sql_query="insert into AreasDisciplinas(`id_area`,`nome`) values (NULL,'".$arg1."');";
	}
	
	//Registrar períodos
	if(($tp==2)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"])&&isset($_POST["ARG3"]))){
		$arg1 = intval($_POST["ARG1"]);
		$arg2 = intval($_POST["ARG2"]);
		$arg3 = $_POST["ARG3"];
		$sql_query="insert into Periodos(`id_periodo`,`bimestre`,`ano`,`tipo_avaliacao`) values (NULL,".$arg1.",".$arg2.",'".$arg3."');";
	}

	//Registrar disciplina
	if(($tp==3)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"]))){
		$arg1 = $_POST["ARG1"];
		$arg2 = $_POST["ARG2"];
		$sql_query="insert into Disciplinas(`id_dscp`,`nome`,`id_area`) values (NULL,'".$arg1."',".$arg2.");";
	}

	//Registrar prova
	if(($tp==4)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"]))){
		$arg1 = $_POST["ARG1"];
		$arg2 = $_POST["ARG2"];
		$sql_query="insert into Provas(`id_prova`,`id_turma`,`id_periodo`) values (NULL,".$arg1.",".$arg2.");";
	}

	//Registrar alunos
	if(($tp==5)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"])&&isset($_POST["ARG3"])&&isset($_POST["ARG4"])&&isset($_POST["ARG5"]))){
		$arg1 = floatval($_POST["ARG1"]);
		$arg2 = $_POST["ARG2"];
		$arg3 = floatval($_POST["ARG3"]);
		$arg4 = $_POST["ARG4"];
		$arg5 = $_POST["ARG5"];
		$sql_query="insert into Alunos(`id_aluno`,`nome`,`id_turma`,`dt_nascimento`,`sexo`) values (".$arg1.",'".$arg2."',".$arg3.",'".$arg4."','".$arg5."');";
	}
	
	//Registrar questões
	if(($tp==6)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"])&&isset($_POST["ARG3"])&&isset($_POST["ARG4"])&&isset($_POST["ARG5"])&&isset($_POST["ARG6"])&&isset($_POST["ARG7"])&&isset($_POST["ARG8"])&&isset($_POST["ARG9"]))){
		$arg1 = $_POST["ARG1"];
		$arg2 = intval($_POST["ARG2"]);
		$arg3 = $_POST["ARG3"];
		$arg4 = $_POST["ARG4"];
		$arg5 = $_POST["ARG5"];
		$arg6 = $_POST["ARG6"];
		$arg7 = $_POST["ARG7"];
		$arg8 = $_POST["ARG8"];
		$arg9 = $_POST["ARG9"];
		$sql_query="insert into Questoes(`id_questao`,`texto_questao`,`dificuldade`,`ltr_itm_correto`,`id_dscp`,`itm_a`,`itm_b`,`itm_c`,`itm_d`,`itm_e`)
		values (NULL,'".$arg1."',".$arg2.",'".$arg3."','".$arg9."','".$arg4."','".$arg5."','".$arg6."','".$arg7."','".$arg8."');";
	}
	
	//Registrar gabaritos
	if(($tp==7)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"]))){
		$arg1 = intval($_POST["ARG1"]);
		$arg2 = intval($_POST["ARG2"]);
		$sql_query="insert into Disciplinas(`id_gab`,`id_prova`,`id_questao`) values (NULL,".$arg1.",".$arg2.");";
	}

	//Registrar respostas
	if(($tp==8)&&(isset($_POST["ARG1"])&&isset($_POST["ARG2"])&&isset($_POST["ARG3"])&&isset($_POST["ARG4"]))){
		$arg1 = intval($_POST["ARG1"]);
		$arg2 = intval($_POST["ARG2"]);
		$arg3 = intval($_POST["ARG3"]);
		$arg4 = $_POST["ARG4"];
		$sql_query="insert into Respostas(`id_resposta`,`id_aluno`,`id_prova`,`id_questao`,`itm_marcado`) values (NULL,".$arg1.",".$arg2.",".$arg3.",'".$arg4."');";
	}
	if($sql_query!=""){ $dados = mysqli_query($con,$sql_query) or die(mysql_error());
	echo(json_encode(array('status'=>$dados,'msg'=>'Operação concluída.')));
	}
	
	
}else if(isset($_POST["TP"]) && ( intval($_POST["TP"])>=11 )){
	$tp = intval($_POST["TP"]);
	$response = "";
	if(($tp==11)&&(intval($_POST["ARG1"])==0)){
		$arg = intval($_POST["ARG1"]);
		$vect = getTurmas();
		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	
	if(($tp==11)&&(intval($_POST["ARG1"])==1)){
		$arg = intval($_POST["ARG1"]);
		$vect = getAreas();
		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}

	if(($tp==11)&&(intval($_POST["ARG1"])==2)){
		$arg = intval($_POST["ARG1"]);
		$vect = getDisciplinas();
		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==3)){
		$arg = intval($_POST["ARG1"]);
		$vect = getPeriodos();
		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==4)){
		$arg = intval($_POST["ARG1"]);
		$vect = getProvasViewData();
		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==5)){
		$arg = intval($_POST["ARG1"]);
		$vect = getTodasQuests();
		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==6)&&isset($_POST["ARG2"])){
		$arg = intval($_POST["ARG1"]);
		$area = intval($_POST["ARG2"]);
		$vect = getDisciplinasByArea($area);		
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==7)&&isset($_POST["ARG2"])){
		$arg = intval($_POST["ARG1"]);
		$disci = intval($_POST["ARG2"]);
		$vect = getQuestsByDscpID($disci);
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==8)&&isset($_POST["ARG2"])&&isset($_POST["ARG3"])){
		$arg = intval($_POST["ARG1"]);
		$prova = intval($_POST["ARG2"]);
		$disci = intval($_POST["ARG3"]);
		$vect = getGabaritoByProvaAndDiscip($prova,$disci);
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	//Excluir questão
	if(($tp==11)&&(intval($_POST["ARG1"])==9)&&isset($_POST["ARG2"])){
		$arg = intval($_POST["ARG1"]);
		$idgab = intval($_POST["ARG2"]);
		$vect = execQuestao_oper_excluir($idgab);
		echo json_encode(array('status'=>$vect));
	}
	//Incluir questão
	if(($tp==11)&&(intval($_POST["ARG1"])==10)&&isset($_POST["ARG2"])&&isset($_POST["ARG3"])){
		$arg = intval($_POST["ARG1"]);
		$prova = intval($_POST["ARG2"]);
		$questao = intval($_POST["ARG3"]);
		$vect = execQuestao_oper_incluir($prova,$questao);
		echo json_encode(array('status'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==11)&&isset($_POST["ARG2"])){
		$matric = intval($_POST["ARG2"]);
		$vect = matriculaExists($matric);
		if($vect){
			$vectDone = provasFromMatricula($matric);
		echo json_encode(array('status'=>true,'vetor'=>$vectDone));
		}else echo json_encode(array('status'=>false));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==12)&&isset($_POST["ARG2"])){
		$id_prov = intval($_POST["ARG2"]);
		$vect = getDisciplinasDataByProva($id_prov);
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	if(($tp==11)&&(intval($_POST["ARG1"])==13)&&isset($_POST["ARG2"])&&isset($_POST["ARG3"])){
		$id_prov = intval($_POST["ARG2"]);
		$id_discip = intval($_POST["ARG3"]);
		$vect = getQuestoesByProva($id_prov,$id_discip);
		echo json_encode(array('status'=>true,'vetor'=>$vect));
	}
	
}

?>