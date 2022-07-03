<?php
	include 'acasalamentoModel.php';
	include 'acasalamentoView.php';
	include 'conexao.php';
	
	$acao = $_GET["acao"];
	if ($acao == 'incluir')
	{
		$acasalamentoController = new acasalamentoController();
		$acasalamentoController->incluir();
	}		
	if ($acao == 'listar')
	{
		$acasalamentoController = new acasalamentoController();
		$acasalamentoController->listar();
	}			
	if ($acao == 'obter')
	{
		$acasalamentoController = new acasalamentoController();
		$acasalamentoController->obter();
	}			
	if ($acao == 'alterar')
	{
		$acasalamentoController = new acasalamentoController();
		$acasalamentoController->alterar();
	}			
	
class acasalamentoController{

	function incluir()
	{		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
			
		$idPai			= $_GET["idPai"];
		$idMae			= $_GET["idMae"];
		$dtMonta   		= $_GET["Data"];
		$data           = substr($dtMonta, 6, 4)."-".substr($dtMonta, 3, 2)."-".substr($dtMonta, 0, 2);
		$temporada 		= substr($dtMonta, 6, 4);
		$tipo 			= $_GET["Tipo"];
			
		// caso exista acasalamento ativo - e necessario inativa-lo.
		$acasalamentoModel = new acasalamentoModel();		
		$retorno = $acasalamentoModel->inativar($id_propriedade, $idMae, $temporada);
			
		//criar
		$status = "a";
		$retorno = $acasalamentoModel->incluir($id_propriedade, $idPai , $idMae , $data , $tipo , $temporada , $status);			
		
		$acasalamentoView = new acasalamentoView();
		$acasalamentoView-> incluir($retorno);	
		
	}
	
	function listar()
	{
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
			
		$dtFiltro 		= $_GET["data"];
		$data           = substr($dtFiltro, 6, 4)."-".substr($dtFiltro, 3, 2)."-".substr($dtFiltro, 0, 2);
		$temporada 		= $_GET["temporada"];
			
		$listaRetorno = array();
		$acasalamentoModel = new acasalamentoModel();		
		$lista = $acasalamentoModel->listar($id_propriedade, $data , $temporada);		
		$qtd = count($lista);
		for ($row = 0; $row < $qtd; $row++) {		
			//c.id_acasalamento,
		     //c.dt_acasalamento,
		     //ADDDATE(c.dt_acasalamento, INTERVAL 147 DAY) as dtPrevista , 
		    //DATEDIFF(CURRENT_DATE(), c.dt_acasalamento) AS DIASCOBERTURA,
		    //147 - DATEDIFF(CURRENT_DATE(), c.dt_acasalamento) AS DIASPARANASCER ,
		    //c.dt_nascimento as dt_nascimento,
		    //pp.afixo as afixoPai,
		    //ap.tatuagem as tatuagemPai,
		    //pp.afixo as afixoMae,	
		    //am.tatuagem as tatuagemMae
			//DIASNASCIMENTO	
		if($lista[$row][5] == '0000-00-00')
		{}else{
			$lista[$row][4] = 0;
			$lista[$row][3] = $lista[$row][10];			
		}
		
		$item = array($lista[$row][0],$lista[$row][1],$lista[$row][2],$lista[$row][3],$lista[$row][4],$lista[$row][6],$lista[$row][7],$lista[$row][8],$lista[$row][9]);
		array_push($listaRetorno , $item);
		
		}
		
		$acasalamentoView = new acasalamentoView();
		$acasalamentoView->listar($listaRetorno);
	}
	
	function obter()
	{
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		$id_acasalamento = $_GET["id_acasalamento"];
		
		$acasalamentoModel = new acasalamentoModel();		
		$obter = $acasalamentoModel->obter($id_propriedade, $id_acasalamento);
		
		$acasalamentoView = new acasalamentoView();
		$acasalamentoView->obter($obter);
		
	}
	function informarNascimento($id_acasalamento, $data , $qtd )
	{
		$acasalamentoModel = new acasalamentoModel();		
		$informarNascimento = $acasalamentoModel->informarNascimento($id_acasalamento, $data , $qtd );
		return $informarNascimento;
	}
	function listarConsultaMae($id_propriedade, $temporada)
	{
		$acasalamentoModel = new acasalamentoModel();		
		$lista = $acasalamentoModel->listarConsultaMae($id_propriedade, $temporada);		
		return $lista;
	}
	function listarTaxa($id_propriedade, $temporada)
	{
		$acasalamentoModel = new acasalamentoModel();		
		$lista = $acasalamentoModel->listarTaxa($id_propriedade, $temporada);		
		return $lista;
	}
	function alterar()
	{		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
			
		$idPai			= $_GET["idPai"];
		$idMae			= $_GET["idMae"];
		$dtMonta   		= $_GET["Data"];
		$data           = substr($dtMonta, 6, 4)."-".substr($dtMonta, 3, 2)."-".substr($dtMonta, 0, 2);
		$temporada 		= substr($dtMonta, 6, 4);
		$tipo 			= $_GET["Tipo"];
		$id_acasalamento= $_GET["idAcasalamento"];
			
		$acasalamentoModel = new acasalamentoModel();		
		$retorno = $acasalamentoModel->alterar($id_propriedade, $idPai , $idMae , $data , $tipo , $temporada , $id_acasalamento);			
		
		$acasalamentoView = new acasalamentoView();
		$acasalamentoView-> alterar($retorno);	
		
	}
}
?>



 

