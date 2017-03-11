	var difAlt,difLarg;
	var divPagina;
	var PageFocus;

function loadPageScreen(link,typee,dat,   sucesso,xhrload){
$.ajax({
url: link,
data: dat,
type: typee,
error: function (xhr, ajaxOptions, thrownError) { //Caso de ERRO
alert("Erro:\n"+thrownError+'\n>'+xhr.responseText);
},
success: sucesso,
xhr:xhrload,
processData: false,	
cache: false,
contentType: false
});
}

//function carregaPagina(link,tipo,dados){
function carregaPagina(link,titl){
/*
	difAlt=0;difLarg=0;
	PageFocus=false;
loadPageScreen(link,tipo,dados,
	function(recebido){
	//alert(recebido);
	FormViewSpace(recebido);
	},
	function(){
	var xhr=new window.XMLHttpRequest();
		//Download
	xhr.addEventListener("progress",function(evt){
		if(evt.lengthComputable){
			var pctLoad=evt.loaded/evt.total * 100;
			console.log(pctLoad+"%");
		}
	}, false);
	return xhr;
	}

)
*/
FormViewSpace(link,titl);
}


function FormViewSpace(linkpage,titulo){
	if(!PageFocus){
	var tamanhoBar = 25;
	var hideBack = document.createElement( "div" );
	$(hideBack).css("position","absolute");
	$(hideBack).css("background-color","rgba(0,0,0,0.9)");
	$(hideBack).css("width",(window.innerWidth-1)+"px");
	$(hideBack).css("height",(window.innerHeight-tamanhoBar)+"px");
	
	var divHeader = document.createElement( "div" );
	var divPage = document.createElement( "div" );
	var ifrm = document.createElement( "iframe" );
	
	var alturaPage = (window.innerHeight-tamanhoBar);
	var larguraPage = (window.innerWidth*1)-1;
	
	
	difLarg = (window.innerWidth-larguraPage)+1;
	difAlt = (window.innerHeight-alturaPage);
	
	var larguraHeader = larguraPage;
	var alturaHeader = difAlt;
	
	
	$(divHeader).css("position","absolute");
	$(divHeader).css("background-color","lime");
	$(divHeader).css("width","100%");
	$(divHeader).css("height",alturaHeader+"px");
	
		//Cabeçalho
		var btnClose = document.createElement( "button" );
		var centraliz = document.createElement( "center" );
		var fonteTxt = document.createElement( "h3" );
		var fonteBtn = document.createElement( "h4" );
		
		$(fonteTxt).html(titulo);
		$(fonteTxt).css({"color":"black","display":"inline"});
		$(centraliz).append(fonteTxt);	
		
		$(fonteBtn).css({"display":"inline"});
		
		$(btnClose).attr("id","ButtonClosePage");
		$(btnClose).html('<span class="glyphicon glyphicon-log-out"></span>');
		$(btnClose).css({'float':'left','color':'black'});
		
		$(fonteBtn).append(btnClose);	
		
		$(centraliz).append(fonteBtn);	
		
		$(divHeader).append(centraliz);	
		//$(divHeader).append(btnClose);	
		//=================
	
	
	$(ifrm).css("width","100%");
	$(ifrm).css("height","100%");
	$(ifrm).attr("src",linkpage);
	$(ifrm).css("border-width","inherit");
	
	
	$(divPage).css("position","absolute");
	$(divPage).css("background-color","white");
	$(divPage).css("width","100%");
	$(divPage).css("height",alturaPage+"px");
	
	
	var y = window.pageYOffset || document.documentElement.scrollTop;
	var x = window.pageXOffset || document.documentElement.scrollLeft;
	
	
	$(hideBack).css("top",(y)+"px");
	$(hideBack).css("left",(x)+"px");
	
	$(divPage).css("top",(difAlt)+"px");
	$(divPage).css("left",(difLarg)+"px");
	$(divPage).hide();
	$(hideBack).css("z-index","2147483646");
	$(divHeader).css("z-index","2147483647");
	$(divPage).css("z-index","2147483647");
	$( divPage ).append( ifrm );
	$( hideBack ).append( divHeader );
	$( hideBack ).append( divPage );
	$( "html" ).append( hideBack );
	/*
	var innerImg = document.createElement( "img" );
	$(innerImg).css("position","absolute");
	$(innerImg).css("width","99%");
	$(innerImg).css("height","99%");
	$(innerImg).css("top","0.5%");
	$(innerImg).css("left","0.5%");
	
	innerImg.src=img.src;
	*/
	//$(divPage).append( innerImg );
	//$(divPage).html( conteudo );
	divPagina=hideBack;
	PageFocus=true;
	//Efeito de exibir
	$(divPage).fadeIn(600);
	/*
	//Clique na imagem fecha
	$(innerImg).click(function(){
		//Efeito de esconder
		$(divImage).fadeOut(500,function(){
		$(hideBack).remove();
		$(divImage).remove();
		$(innerImg).remove();
		});
	ImageFocus=false;
	});
	*/
	//Clique no fundo fecha
	$(btnClose).click(function(){
		//Efeito de esconder
		$(hideBack).fadeOut(500,function(){
		$(divPage).remove();
		$(divPagina).remove();
		$(divHeader).remove();
		$(hideBack).remove();
		//$(innerImg).remove();
		});
	PageFocus=false;
	});
}	
}

$(window).scroll(function(){
	if( PageFocus ){
		var y = window.pageYOffset || document.documentElement.scrollTop;
		var x = window.pageXOffset || document.documentElement.scrollLeft;
var pY = y;
var pX = x;
	$(divPagina).css("top",pY+"px");
	$(divPagina).css("left",pX+"px");
}
});
