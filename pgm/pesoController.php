<?php
	include 'pesoModel.php';
	include 'pesoView.php';
	include 'conexao.php';		
	$acao = $_GET["acao"];
	if ($acao == 'obter')
	{
		$acao='';
		$pesoController = new pesoController();
		$pesoController->obter();
	}		
	if ($acao == 'obterPeso')
	{
		$acao='';
		$pesoController = new pesoController();
		$pesoController->obterPeso();
	}		
	if ($acao == 'incluir')
	{
		$pesoController = new pesoController();
		$pesoController->incluir();
	}		
	if ($acao == 'listarPeso')
	{		
		$pesoController = new pesoController();
		$pesoController->listarPeso();
	}		
	if ($acao == 'alterar')
	{		
		$pesoController = new pesoController();
		$pesoController->alterar();
	}		
	if ($acao == 'excluir')
	{		
		$pesoController = new pesoController();
		$pesoController->excluir();
	}		

class pesoController{
	function incluir(){
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		
		$id_animal = $_GET["idAnimal"];
		$peso = $_GET["peso"];
		$dtPeso = $_GET["data"];
		$data   = substr($dtPeso, 6, 4)."-".substr($dtPeso, 3, 2)."-".substr($dtPeso, 0, 2);		
		$marco = $_GET["marco"];
		
		$pesoModel = new pesoModel();
		$mensagem = $pesoModel->incluir($id_animal , $peso , $marco , $data);
		
		$pesoView = new pesoView();
		$pesoView-> incluir($mensagem);
	}
	
	function alterar(){
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		
		$id_animal = $_GET["idAnimal"];
		$peso = $_GET["peso"];
		$dtPeso = $_GET["data"];
		$data   = substr($dtPeso, 6, 4)."-".substr($dtPeso, 3, 2)."-".substr($dtPeso, 0, 2);		
		$marco = $_GET["marco"];
		$id_peso = $_GET["idPeso"];
		
		$pesoModel = new pesoModel();
		$mensagem = $pesoModel->alterar($id_animal , $peso , $marco , $data, $id_peso);
		
		$pesoView = new pesoView();
		$pesoView-> alterar($mensagem);
	}
	
	function obter()
	{
		
		include 'animalModel.php';	
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		$id_animal = $_GET["idAnimal"];
	
		$animalModel = new animalModel();
		$obter =  $animalModel->obter($id_propriedade, $id_animal);
		
		$pesoView = new pesoView();
		$pesoView->obter($obter);
	}
	
	function obterPeso()
	{
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		$id_peso = $_GET["idPeso"];
	
		$PesoModel = new PesoModel();
		$obter =  $PesoModel->obter($id_peso , $id_propriedade);
		
		$pesoView = new pesoView();
		$pesoView->obterPeso($obter);
	}
	
	function excluir()
	{
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		$id_peso = $_GET["idPeso"];
	
		$PesoModel = new PesoModel();
		$excluir =  $PesoModel->excluir($id_peso);
		
		$pesoView = new pesoView();
		$pesoView->excluir($excluir);
	}
	
	function listarPeso(){
		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];		
		$id_animal = $_GET["idAnimal"];
		
		$pesoModel = new pesoModel();
		$retorno =  $pesoModel->listarPeso($id_animal);
		
		$pesoView = new pesoView();
		$pesoView->listarPeso($retorno);
		
	}
}
?>



 

