function onLoad()
{	 
document.getElementById("divFiltro").style.display = '';
document.getElementById("divCadastro").style.display = 'none';
document.getElementById("divLista").style.display = 'none';
carregarMae();
carregarPai();
}
function novo()
{
	document.getElementById("divFiltro").style.display = 'none';
	document.getElementById("divLista").style.display = 'none';
	document.getElementById("divCadastro").style.display = '';  
}
  
function salvar()
{
    document.getElementById("divFiltro").style.display = '';
    document.getElementById("divCadastro").style.display = 'none';
}

function carregarMae()
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
				document.getElementById("divObterMaeF").innerHTML = xmlreq.responseText;				
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
}

function carregarPai()
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
				document.getElementById("divObterPaiF").innerHTML = xmlreq.responseText;				
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
	
	// Declaração de Variáveis
     var idAcasalamento   = idLista;
     var xmlreq = CriaRequest();
	 
	 // Iniciar uma requisição
     xmlreq.open("GET", "acasalamentoController.php?id_acasalamento=" + idAcasalamento + "&acao=obter", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText.trim();
				alert(str);
				var strsplit = str.split("/");				
				document.getElementById("hdnIdAcasalamento").value = strsplit[0];	
				document.getElementById("hdnIdPai").value = strsplit[01];					
				document.getElementById("txtPaiI").value = strsplit[2] + strsplit[3] + strsplit[4] ;
				document.getElementById("hdnIdMae").value = strsplit[05];					
				document.getElementById("txtMaeI").value = strsplit[6] + strsplit[7] + strsplit[8] ;
				
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
	 var temporada = document.getElementById("txtTemporadaF").value;
	 var idMae   = document.getElementById("cboMaeI").value;
	 var idPai   = document.getElementById("cboPaiI").value;
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

}
 
function incluir()
{
   	// Declaração de Variáveis
	var tatuagem =  document.getElementById("txtTatuagemI").value;
	var nome =  document.getElementById("txtNomeI").value;
    var dtNascimento =  document.getElementById("txtDtNascimentoI").value;
    var caracteristicas =  document.getElementById("subject").value;
	var sexo = document.getElementById("cboSexoI").value;
	var parto = document.getElementById("cboPartoI").value;
	var peso = document.getElementById("txtPesoI").value;
	var idPai = document.getElementById("hdnIdPai").value;
    var idMae = document.getElementById("hdnIdMae").value;
    var idAcasalamento = document.getElementById("hdnIdAcasalamento").value;
	var vivo = document.getElementById("cboVivoI").value;
	
    var xmlreq = CriaRequest();
	 
     // Iniciar uma requisição
      xmlreq.open("GET", "nascimentoController.php?tatuagem=" + tatuagem +
										"&dtNascimento=" + dtNascimento +
										"&nome=" + nome +
										"&idPai=" + idPai +										
										"&idMae=" + idMae + 
										"&subject=" + caracteristicas +
										"&sexo=" + sexo +
										"&parto=" + parto +
										"&peso=" + peso +
										"&idAcasalamento=" + idAcasalamento +
										"&vivo=" + vivo +
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
	 listar();
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


