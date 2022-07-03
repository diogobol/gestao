<?php
	include 'animalModel.php';
	include 'animalView.php';	
	include 'rebanhoController.php'; 
	include 'conexao.php';
	$acao = $_GET["acao"];
	if ($acao == 'carregarPai')
	{
		$animal = new animalController();
		$animal->carregarPai();
	}		
	if ($acao == 'carregarMae')
	{
		$animal = new animalController();
		$animal->carregarMae();
	}		
	if ($acao == 'incluir')
	{
		$animal = new animalController();
		$animal->incluir();
	}		
	if ($acao == 'alterar')
	{
		$animal = new animalController();
		$animal->$acao();
	}		
	if ($acao == 'listar')
	{
		$animal = new animalController();
		$animal->listar();
	}		
	if ($acao == 'obter')
	{
		$animal = new animalController();
		$animal->obter();
	}		

class animalController{

function carregarPai (){

		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];

		$animalModel = new animalModel();
		$listaPai = $animalModel->carregarAnimal($id_propriedade,'m');
		
		$animalView = new animalView();
		$animalView->carregarPai($listaPai);		
		
	}
	
	function carregarMae (){
		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		//acessa camada de animalModel solicitando a lista das maes//
		$animalModel = new animalModel();		
		$listaMae = $animalModel->carregarAnimal($id_propriedade,'f');		
		//chama view para apresentacao da lista das maes 
		$animalView = new animalView();
		$animalView->carregarMae($listaMae);		
	}
	
	function incluir(){
		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];		

		$tatuagem		= $_GET["txtTatuagemI"];
		$dtNascimento   = $_GET["txtDtNascimentoI"];
		$data           = substr($dtNascimento, 6, 4)."-".substr($dtNascimento, 3, 2)."-".substr($dtNascimento, 0, 2);
		$sexo 			= $_GET["cboSexoI"];
		$parto 			= $_GET["cboPartoI"];	
		$idPai			= $_GET["idPai"];
		$idMae			= $_GET["idMae"];
		$caracteristica = $_GET["subject"];
		$nome			= $_GET["nome"];
		$morte 			= $_GET["dtMorte"];
		if($morte=="")
		{
			$dtMorte = "";
		}
		else
		{
			$dtMorte = substr($morte, 6, 4)."-".substr($morte, 3, 2)."-".substr($morte, 0, 2);
		}
		
		$animalModel = new animalModel();
		$idAnimal = $animalModel->incluir($id_propriedade, $tatuagem, $data, $sexo, $parto, $idPai, $idMae, $caracteristica, $nome, $dtMorte ,'');
		if($idAnimal > 0)
		{
			$rebanhoController = new rebanhoController();
			$retorno = $rebanhoController -> incluir($id_propriedade, $idAnimal);			
		}
		
		$animalView = new animalView();
		$animalView->incluir($retorno);		
	}
	function alterar(){
		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];		

		$tatuagem		= $_GET["txtTatuagemI"];
		$dtNascimento   = $_GET["txtDtNascimentoI"];
		$data           = substr($dtNascimento, 6, 4)."-".substr($dtNascimento, 3, 2)."-".substr($dtNascimento, 0, 2);
		$sexo 			= $_GET["cboSexoI"];
		$parto 			= $_GET["cboPartoI"];	
		$idPai			= $_GET["idPai"];
		$idMae			= $_GET["idMae"];
		$caracteristica = $_GET["subject"];
		$nome			= $_GET["nome"];
		$morte 			= $_GET["dtMorte"];
		$id_animal		= $_GET["idAnimal"];
		if($morte=="")
		{
			$dtMorte = "";
		}
		else
		{
			$dtMorte = substr($morte, 6, 4)."-".substr($morte, 3, 2)."-".substr($morte, 0, 2);
		}
		
		$animalModel = new animalModel();
		$idAnimal = $animalModel->alterar($tatuagem, $data, $sexo, $parto, $idPai, $idMae, $caracteristica, $nome, $dtMorte ,$id_animal);
		
		$animalView = new animalView();
		$animalView->alterar($idAnimal);		
	}
	
	public function listar (){
		
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];		
		$tatuagem		= $_GET["tatuagem"];
		
		$animalModel = new animalModel();
		$listaAnimal = $animalModel->listar($id_propriedade, $tatuagem);
		
     	$animalView = new animalView();
		$animalView->listar($listaAnimal);
	}
	
	public function obter (){
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];		
		$id_animal = $_GET["idAnimal"];
		
		$animalModel = new animalModel();
		$obter = $animalModel->obter($id_propriedade, $id_animal);

		$animalView = new animalView();
		$animalView->obter($obter);
	}
	
	function obterExterno ($id_propriedade, $id_animal){
		$animalModel = new animalModel();
		$obter = $animalModel->obter($id_propriedade, $id_animal);
		return $obter;		
	}
	
	public function listarFilho ($id_animal){
		$animalModel = new animalModel();
		$lista = $animalModel->listarFilho($id_animal);
		
		$animalView = new animalView();
		$animalView->listarFilho($lista);		
	}	
}	
?>



 

