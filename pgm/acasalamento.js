function onLoad()
{	 
document.getElementById("divFiltro").style.display = '';
document.getElementById("divCadastro").style.display = 'none';
document.getElementById("divLista").style.display = 'none';

}
function novo()
{
  obterPai();
  obterMae();
  document.getElementById("divFiltro").style.display = 'none';
  document.getElementById("divCadastro").style.display = '';
  document.getElementById("btnAlterar").style.display = 'none';
}
function salvar()
{
    document.getElementById("divFiltro").style.display = '';
    document.getElementById("divCadastro").style.display = 'none';
}

function obterPai()
{
	 var xmlreq = CriaRequest();
    	
     // Iniciar uma requisição
     xmlreq.open("GET", "animalController.php?acao=carregarPai", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText;
				var strsplit = str.split("/");
				document.getElementById("divObterPai").innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}

function obterMae()
{
	 var xmlreq = CriaRequest();
    	
     // Iniciar uma requisição
     xmlreq.open("GET", "animalController.php?acao=carregarMae", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText;
				var strsplit = str.split("/");
				document.getElementById("divObterMae").innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}


function obter(idLista)
{
	novo();
	document.getElementById("btnAlterar").style.display = '';
	document.getElementById("btnIncluir").style.display = 'none';
		
	// Declaração de Variáveis
     var id   = idLista;
     var xmlreq = CriaRequest();
    	
     // Iniciar uma requisição
     xmlreq.open("GET", "acasalamentoController.php?id_acasalamento=" + id + "&acao=obter", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText;
				var strsplit = str.split("/");
				document.getElementById("hdnIdAcasalamento").value = strsplit[0];
				document.getElementById("cboPaiI").value= strsplit[1];
				document.getElementById("cboMaeI").value= strsplit[5];
				document.getElementById("txtDataI").value = strsplit[9];
				document.getElementById("cboMontaI").value = strsplit[10];
	
				
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}

function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
         
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
         
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
     
     if (!request) 
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }
 
function listar() 
{     
     // Declaração de Variáveis
     var data   = document.getElementById("txtDataF").value;
	 var temporada = document.getElementById("txtTeporadaF").value;
	 var xmlreq = CriaRequest();
     
	      // Iniciar uma requisição
     xmlreq.open("GET", "acasalamentoController.php?data=" + data +
										   "&temporada=" + temporada +	
	                                       "&acao=listar", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 document.getElementById("divLista").innerHTML = xmlreq.responseText;				 				 
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 
	document.getElementById("divLista").style.display = '';
	document.getElementById("divFiltro").style.display = 'none';
}
 
function incluir()
{
   
	// Declaração de Variáveis
	var idPai =  document.getElementById("cboPaiI").value;
    var idMae = document.getElementById("cboMaeI").value;
    var data =  document.getElementById("txtDataI").value;
    var tipoMonta =  document.getElementById("cboMontaI").value;
    
       var xmlreq = CriaRequest();

	 
     // Iniciar uma requisição
     xmlreq.open("GET", "acasalamentoController.php?idPai=" + idPai + 
										"&idMae=" + idMae + 
										"&Data=" + data +
										"&Tipo=" + tipoMonta +
										"&acao=incluir", true);
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 alert(xmlreq.responseText.trim());//result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
	//onLoad();
}
 
function alterar()
{
	 // Declaração de Variáveis
	var idPai =  document.getElementById("cboPaiI").value;
    var idMae = document.getElementById("cboMaeI").value;
    var data =  document.getElementById("txtDataI").value;
    var tipoMonta =  document.getElementById("cboMontaI").value;
	var id 		= document.getElementById("hdnIdAcasalamento").value;
    var xmlreq = CriaRequest();
     
     // Iniciar uma requisição
      // Iniciar uma requisição
     xmlreq.open("GET", "acasalamentoController.php?idPai=" + idPai + 
										"&idMae=" + idMae + 
										"&Data=" + data +
										"&Tipo=" + tipoMonta +
										"&idAcasalamento=" + id +
										"&acao=alterar", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 alert(xmlreq.responseText.trim());//result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
	onLoad();
}
 
function excluir()
{
	 // Declaração de Variáveis
	 var id 		= document.getElementById("hdnId").value;
     var xmlreq = CriaRequest();
     
     // Iniciar uma requisição
     xmlreq.open("GET", "crud_individuo.php?hdnId=" + id +
										"&acao=excluir", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 alert(xmlreq.responseText);
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
	onLoad();
}
