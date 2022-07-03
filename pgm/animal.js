function onLoad()
{
document.getElementById("divFiltro").style.display = '';
document.getElementById("divCadastro").style.display = 'none';
document.getElementById("divLista").style.display = 'none';
}
function novo()
{
  carregarPai();
  carregarMae();
  document.getElementById("divFiltro").style.display = 'none';
  document.getElementById("divCadastro").style.display = '';
  document.getElementById("btnAlterar").style.display = 'none';
  document.getElementById("divLista").style.display = 'none';
  document.getElementById("divMorte").style.display = 'none';
  
}
function salvar()
{
    document.getElementById("divFiltro").style.display = '';
    document.getElementById("divCadastro").style.display = 'none';
}

function obterTela()
{
  document.getElementById("divFiltro").style.display = 'none';
  document.getElementById("divCadastro").style.display = '';
  document.getElementById("btnAlterar").style.display = '';
  document.getElementById("divLista").style.display = 'none';
  document.getElementById("btnSalvar").style.display = 'none';  
  carregarPai();
  carregarMae();
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
				document.getElementById("divPai").innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     }
     xmlreq.send(null);
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
				document.getElementById("divMae").innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     }
     xmlreq.send(null);
}

function incluir()
{
   
	// Declaração de Variáveis
	var tatuagem =  document.getElementById("txtTatuagemI").value;
    var dtNascimento =  document.getElementById("txtDtNascimentoI").value;
	var sexo = document.getElementById("cboSexoI").value;
	var parto = document.getElementById("cboPartoI").value;
	var idPai = document.getElementById("cboPaiI").value;
	var idMae = document.getElementById("cboMaeI").value;
    var caracteristicas =  document.getElementById("subject").value;
	var nome = document.getElementById("txtNomeI").value;
	var dtMorte = document.getElementById("txtDtMorteI").value;
    var xmlreq = CriaRequest();

	 
     // Iniciar uma requisição
     xmlreq.open("GET", "animalController.php?&txtTatuagemI=" + tatuagem +
										"&txtDtNascimentoI=" + dtNascimento +
										"&idPai=" + idPai + 
										"&idMae=" + idMae + 										
										"&subject=" + caracteristicas +
										"&cboSexoI=" + sexo +
										"&cboPartoI=" + parto +
										"&nome=" + nome +
										"&dtMorte="+dtMorte+
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
	var tatuagem =  document.getElementById("txtTatuagemI").value;
    var dtNascimento =  document.getElementById("txtDtNascimentoI").value;
	var sexo = document.getElementById("cboSexoI").value;
	var parto = document.getElementById("cboPartoI").value;
	var idPai = document.getElementById("cboPaiI").value;
	var idMae = document.getElementById("cboMaeI").value;
    var caracteristicas =  document.getElementById("subject").value;
	var nome = document.getElementById("txtNomeI").value;
	var dtMorte = document.getElementById("txtDtMorteI").value;
	var idAnimal = document.getElementById("hdnIdAnimal").value;
    var xmlreq = CriaRequest();

	 
     // Iniciar uma requisição
     xmlreq.open("GET", "animalController.php?&txtTatuagemI=" + tatuagem +
										"&txtDtNascimentoI=" + dtNascimento +
										"&idPai=" + idPai + 
										"&idMae=" + idMae + 										
										"&subject=" + caracteristicas +
										"&cboSexoI=" + sexo +
										"&cboPartoI=" + parto +
										"&nome=" + nome +
										"&dtMorte="+dtMorte+
										"&idAnimal="+idAnimal+
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

function obter(idLista)
{	
    obterTela();
		
	// Declaração de Variáveis
    var id   = idLista;
    var xmlreq = CriaRequest();
    	
     // Iniciar uma requisição
     xmlreq.open("GET", "animalController.php?idAnimal=" + id + "&acao=obter", true);
	 
     
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
         
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                var str = xmlreq.responseText.trim();
				var strsplit = str.split("/");
				document.getElementById("hdnIdAnimal").value = strsplit[0];
				
				//0a.id_animal as id_animal , 
				//1p.afixo as afixo ,
				//2a.tatuagem as tatuagem, 
				//3a.nome as nome, 
				//4a.id_pai as id_pai , 
				//5a.id_mae as id_mae, 
				//6a.sexo as sexo , 
				//7a.dt_nascimento  as dt_nascimento,
				//8a.caracteristica as caracteristica,
				//9a.tipo_parto as tipo_parto
				document.getElementById("txtNomeI").value = strsplit[3];
				document.getElementById("txtDtNascimentoI").value = strsplit[7];
				document.getElementById("cboPartoI").value = strsplit[9];
				document.getElementById("cboSexoI").value = strsplit[6];
				document.getElementById("subject").value = strsplit[8];
				document.getElementById("cboPaiI").value = strsplit[4];
				document.getElementById("cboMaeI").value = strsplit[5];
				document.getElementById("txtTatuagemI").value = strsplit[2];
				
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
 
