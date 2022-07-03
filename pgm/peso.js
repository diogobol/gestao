function onLoad()
{	 
document.getElementById("divFiltro").style.display = '';
document.getElementById("divCadastro").style.display = 'none';
document.getElementById("divLista").style.display = 'none';
document.getElementById("divListaPeso").style.display = 'none';
document.getElementById("btnAlterar").style.display = 'none';
document.getElementById("btnExcluir").style.display = 'none';

}
function novo()
{
  document.getElementById("divFiltro").style.display = 'none';
  document.getElementById("divCadastro").style.display = '';
  document.getElementById("btnAlterar").style.display = 'none';
  document.getElementById("btnExcluir").style.display = 'none';
  document.getElementById("btnSalvar").style.display = '';

  document.getElementById("txtPesoI").value = '';
  document.getElementById("txtDataI").value = '';
  document.getElementById("cboMarcoI").value = 0; 
  
  
}
function salvar()
{
    document.getElementById("divFiltro").style.display = '';
    document.getElementById("divCadastro").style.display = 'none';
}

function obter(idLista)
{
	novo();
	document.getElementById("divLista").style.display = 'none';
	document.getElementById("divLista").style.display = 'none';
	document.getElementById("btnSalvar").style.display = '';
	
	// Declaração de Variáveis
     var id   = idLista;
     var xmlreq = CriaRequest();
    	
     // Iniciar uma requisição
	 xmlreq.open("GET", "pesoController.php?idAnimal=" + id + "&acao=obter", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText.trim();
				var strsplit = str.split("#");
				document.getElementById("hdnIdAnimal").value = strsplit[0];
				document.getElementById("txtAnimalI").value = strsplit[1] +'-'+strsplit[2] +'-'+strsplit[3];
				
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
	 
	 listarPeso(idLista);	 
}

function obterPeso(idLista)
{
	novo();
	document.getElementById("divLista").style.display = 'none';
	document.getElementById("divLista").style.display = 'none';
	document.getElementById("btnSalvar").style.display = '';
	
	// Declaração de Variáveis
     var id   = idLista;
     var xmlreq = CriaRequest();
    	
     // Iniciar uma requisição
	 xmlreq.open("GET", "pesoController.php?idPeso=" + id + "&acao=obterPeso", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText.trim();
				var strsplit = str.split("#");
				document.getElementById("hdnIdAnimal").value = strsplit[0];
				document.getElementById("txtAnimalI").value = strsplit[1] +'-'+strsplit[2] +'-'+strsplit[3];				
				document.getElementById("txtPesoI").value = strsplit[7];
				document.getElementById("txtDataI").value = strsplit[6];
				document.getElementById("hdnId").value = strsplit[5];
				document.getElementById("cboMarcoI").value = strsplit[8];
				
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);	 
	 document.getElementById("btnSalvar").style.display = 'none';
	 document.getElementById("btnAlterar").style.display = '';
	 document.getElementById("btnExcluir").style.display = '';
	 
}    

function listarPeso(idLista) 
{     
     // Declaração de Variáveis
     var xmlreq = CriaRequest();
     var id   = idLista;
	 
     // Iniciar uma requisição
     xmlreq.open("GET", "pesoController.php?idAnimal=" + id +
                                    	 "&acao=listarPeso", true);
	 
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
        
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
				 document.getElementById("divListaPeso").innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 
	document.getElementById("divListaPeso").style.display = '';

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
     var tatuagem   = document.getElementById("txtTatuagemF").value;
     var xmlreq = CriaRequest();
     
     // Iniciar uma requisição
     xmlreq.open("GET", "animalController.php?tatuagem=" + tatuagem +
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
	var peso =  document.getElementById("txtPesoI").value;
	var data = document.getElementById("txtDataI").value;
	var idAnimal = document.getElementById("hdnIdAnimal").value;
	var marco = document.getElementById("cboMarcoI").value;
	
	var xmlreq = CriaRequest();
	 
     // Iniciar uma requisição
     xmlreq.open("GET", "pesoController.php?peso=" + peso + 
										"&idAnimal="  + idAnimal +
										"&data=" + data +
										"&marco=" + marco +
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
	onLoad();
}
 
function alterar()
{
	 // Declaração de Variáveis
	var idPeso	= document.getElementById("hdnId").value;
	var peso =  document.getElementById("txtPesoI").value;
	var data = document.getElementById("txtDataI").value;
	var idAnimal = document.getElementById("hdnIdAnimal").value;
	var marco = document.getElementById("cboMarcoI").value;
	
	var xmlreq = CriaRequest();
     
     // Iniciar uma requisição
     xmlreq.open("GET", "pesoController.php?peso=" + peso + 
										"&idAnimal="  + idAnimal +
										"&data=" + data +
										"&marco=" + marco +
										"&idPeso="+idPeso+
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
	novo();
	listarPeso(document.getElementById("hdnIdAnimal").value);
}
 
function excluir()
{
	 // Declaração de Variáveis
	 var id 		= document.getElementById("hdnId").value;
     var xmlreq = CriaRequest();
     
     // Iniciar uma requisição
     xmlreq.open("GET", "pesoController.php?idPeso=" + id +
										"&acao=excluir", true);
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 alert(xmlreq.responseText.trim());
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
	novo();
	listarPeso(document.getElementById("hdnIdAnimal").value);
}