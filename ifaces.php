<?php
include_once('./entidades/module_array.php');

class iFaces{
	static public $ModulArr;
}

function includModule($mdlNm){
	include_once('./modules/'.$mdlNm.'/module.php');
}

function getifacesData(){

iFaces::$ModulArr = new ModuleArray();
iFaces::$ModulArr->addPreloadModule("main","MainModule");
iFaces::$ModulArr->addPreloadModule("test","Test");
iFaces::$ModulArr->preloadedModulesSetup();//Carrega e registra módulos 
iFaces::$ModulArr->initModules();//Extrai dados
iFaces::$ModulArr->postInitModules();//Extrai dados

$dados = iFaces::$ModulArr->getDataModules();

//var_dump($dados);


$html='<div class="container">
<div class="col-xs-12 col-sm-offset-2 col-sm-8" id="panelLogd">';
foreach(iFaces::$ModulArr->getButtonsModules() as $moduleButn){
	$html.= '<div class="btnMenu col-xs-6 col-sm-4 col-md-3" onclick="FormViewSpace(\''.$moduleButn['linkref'].'\',\''.$moduleButn['title'].'\')" style="background-color:'.$moduleButn['color'].';"><h1><span class="'.$moduleButn['icon'].'"></span></h1><b>'.$moduleButn['title'].'</b></div>';

}

$html.='</div></div>';
return $html;
}

/*
<div class="container">
<div class="col-xs-offset-0 col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6" id="atvRegis"></div>
<script>

function getDiv(classe){
var tmpRet = document.createElement("div");
$(tmpRet).attr("class",classe);
return tmpRet;
}

function getLinha(){
var dv = getDiv("col-xs-12 col-sm-ofsset-1 col-sm-10");
$(dv).css({"float":'none',"margin-top":'10px',"margin-bottom":'10px'});
return dv;
}

function getIconObject(codespan){
return "<span class='glyphicon "+codespan+"'></span>";
}

function campoTexto(placehdr,labelSet,linhInsert){
var tmpSpn = document.createElement("span");
$(tmpSpn).attr("id","basic-addon1");
$(tmpSpn).attr("class","input-group-addon");
$(tmpSpn).html(labelSet);
var tmpDiv1 = document.createElement("div");
$(tmpDiv1).attr("aria-describedby","basic-addon1");
$(tmpDiv1).attr("class","input-group");
var tmpRet = document.createElement("input");
$(tmpRet).attr("class","form-control");
$(tmpRet).attr("placeholder",placehdr);
$(tmpDiv1).append(tmpSpn);
$(tmpDiv1).append(tmpRet);
$(linhInsert).append(tmpDiv1);
return tmpRet;
}



var backgroundPage = document.createElement("div");
var formu = document.createElement("form");

var linhUs = getLinha();
var rowUs = getDiv("row");
var inUs = campoTexto("Nome de usuário",getIconObject("glyphicon-user"),linhUs);

var linhNom = getLinha();
var rowNom = getDiv("row");
var inNom = campoTexto("Nome completo",getIconObject("glyphicon-asterisk"),linhNom);

var linhEmai = getLinha();
var rowEmai = getDiv("row");
var inEmai = campoTexto("E-mail",getIconObject(" glyphicon-envelope"),linhEmai);
$(inEmai).dblclick(function(){
	if(confirm("Pressione 'Ok' caso não tenha um E-mail.")){
	$(inEmai).attr("class",$(inEmai).attr("class")+" desabili");
	$(inEmai).hide(1600,function(){
	$(inEmai).val("zero@fill.com");
	});
	}
});

var linhDat = getLinha();
var rowDatN = getDiv("row");
var nascmDt = campoTexto("Nascimento (dd/mm/aaaa)",getIconObject("glyphicon-log-in"),linhDat);

var linhPas = getLinha();
var rowPas = getDiv("row");
var inPas = campoTexto("Senha",getIconObject("glyphicon-pencil"),linhPas);

var linhBtnReg = document.createElement("div");
var rowBtn = getDiv("row");
var btnReg = document.createElement("button");



$(".page-header").css("border-bottom","none");
$("body").css("background","url('./img/sky-949091.jpg')");
$("body").css("animation","");


$(linhBtnReg).attr("class","col-sm-offset-5 col-xs-12 col-sm-5");
$(linhBtnReg).css("margin-top","10px");
$(linhBtnReg).css("margin-bottom","10px");

$(inPas).attr("type","password");
var blurVal= 2;
$(inPas).css("-webkit-filter","blur("+blurVal+"px)");
$(inPas).css("-moz-filter","blur("+blurVal+"px)");
$(inPas).css("-o-filter","blur("+blurVal+"px)");
$(inPas).css("-ms-filter","blur("+blurVal+"px)");
$(inPas).css("filter","blur("+blurVal+"px)");
$(inPas).on("focusin",function(){
var blurVal= 0;
$(inPas).css("-webkit-filter","blur("+blurVal+"px)");
$(inPas).css("-moz-filter","blur("+blurVal+"px)");
$(inPas).css("-o-filter","blur("+blurVal+"px)");
$(inPas).css("-ms-filter","blur("+blurVal+"px)");
$(inPas).css("filter","blur("+blurVal+"px)");
});
$(inPas).on("focusout",function(){
var blurVal= 2;
$(inPas).css("-webkit-filter","blur("+blurVal+"px)");
$(inPas).css("-moz-filter","blur("+blurVal+"px)");
$(inPas).css("-o-filter","blur("+blurVal+"px)");
$(inPas).css("-ms-filter","blur("+blurVal+"px)");
$(inPas).css("filter","blur("+blurVal+"px)");
});

$(inUs).css({"text-align":"center"});
$(inPas).css({"text-align":"center"});
$(inNom).css({"text-align":"center"});
$(inEmai).css({"text-align":"center"});
$(nascmDt).css({"text-align":"center"});

$(inUs).attr({"data-toggle":"popover","data-placement":"bottom","data-trigger":"focus"});
$(inEmai).attr({"data-toggle":"popover","data-placement":"bottom","data-trigger":"focus"});
$(inPas).attr({"data-toggle":"popover","data-placement":"bottom","data-trigger":"focus"});
$(inNom).attr({"data-toggle":"popover","data-placement":"bottom","data-trigger":"focus"});


$(nascmDt).mask("99/99/9999");

$(btnReg).attr({"type":"submit","class":"btn btn-success"});
$(btnReg).css({"cursor":"pointer","width":"100%"});
$(btnReg).html("Registrar");

$(linhBtnReg).append(btnReg);

$(rowUs).append(linhUs);
$(rowNom).append(linhNom);
$(rowPas).append(linhPas);
$(rowBtn).append(linhBtnReg);
$(rowDatN).append(linhDat);
$(rowEmai).append(linhEmai);

$(formu).append(rowNom);
$(formu).append(rowEmai);
$(formu).append(rowUs);
$(formu).append(rowPas);
$(formu).append(rowDatN);
$(formu).append(rowBtn);

$(formu).submit(function(e){
        e.preventDefault();
		var preenchimento = nnulo($(inNom).val())&&nnulo($(inUs).val())&&nnulo($(inPas).val())&&nnulo($(nascmDt).val())&&nnulo($(inEmai).val());
		var formData = new FormData();
		var condizente=(($(inEmai).val()).indexOf("@")>-1)&&(($(inEmai).val()).indexOf(".")>-1)&&
		(($(inUs).val().trim()).indexOf(" ")==-1)&&
		(($(inNom).val().trim()).indexOf(" ")!=-1)&&
		(($(inPas).val().trim()).length>=6);
		
		if(!condizente){
			if(($(inPas).val().trim()).length<6){
			$(inPas).attr("data-content","Digite uma senha com no mínimo 6 caracteres.");
			$(inPas).popover('show');
			}
			if((($(inEmai).val()).indexOf("@")==-1)&&(($(inEmai).val()).indexOf(".")==-1)){
			$(inEmai).attr("data-content","O e-mail digitado não tem um formato comum.");
			$(inEmai).popover('show');
			}
			if(($(inUs).val().trim()).indexOf(" ")!=-1){
			$(inUs).attr("data-content","Nome de usuário não deve conter espaços.");
			$(inUs).popover('show');
			}
			if(($(inNom).val().trim()).indexOf(" ")==-1){
			$(inNom).attr("data-content","Você deve inserir mais de um nome.");
			$(inNom).popover('show');
			}
		}	
		else if((preenchimento)&&(condizente)){
        formData.append('fuln', $(inNom).val().trim());
        formData.append('usnm', $(inUs).val().trim());
        formData.append('pass', $(inPas).val().trim());
        formData.append('dtnc', $(nascmDt).val().trim());
        formData.append('emai', $(inEmai).val().trim());
        formData.append('idtr', 1);
		
		$(inEmai).popover('destroy');
		$(inUs).popover('destroy');
		$(inPas).popover('destroy');
		$(inNom).popover('destroy');
				$(btnReg).hide(100);
				 

          $.ajax({
            url: "phlib/adduser.php",
            data: formData,
            type: 'post',
			error: function (xhr, ajaxOptions, thrownError) { //Caso de ERRO
			console.log("Erro:\n"+thrownError+'\n>'+xhr.responseText);
			$(formu).submit();
			},
            success: function(response) //Para conclusão
            {
			if(response.status==0){
			alert("Registro concluído!");
			updtPagn(1);
			}else{
				if(response.status==1)
				alert("Fora do período das inscrições. Cód. 1");
				else if(response.status==2)
				alert("Dados inconsistentes. Cód. 2");
				else if(response.status==3)
				alert("Dados não inseridos. Cód. 3");
				else if(response.status==4)
				alert("Erro inesperado. Cód. 4");
				else if(response.status==5)
				alert("Dados enviados insuficientes. Cód. 5");
				else if(response.status==6){
				$(inEmai).attr("data-content","Parece que o e-mail '"+$(inEmai).val()+"' já está cadastrado.");
				$(inEmai).popover('show');
				$(inEmai).focus();
				//alert("E-mail já registrado. Cód. 6");
				}else if(response.status==7){
				$(inUs).attr("data-content","O nome de usuário '"+$(inUs).val()+"' já está em uso.");
				$(inUs).popover('show');
				$(inUs).focus();
				//alert("Usuário já registrado. Cód. 7");
				}else alert("Erro desconhecido: Cód. "+response.status);
				$(btnReg).show(100);
			}
                //alert(response);
            },
            processData: false,	
            cache: false,
            contentType: false
          });
		  
		  }//Se tudo foi preenchido, vai chegar até aqui.
		  else{alert("Por favor, preencha todos os dados corretamente.");}
    });



$("#atvRegis").append(formu);

</script>
</div>
*/
?>