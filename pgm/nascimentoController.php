<?php

	include 'nascimentoModel.php';
	include 'nascimentoView.php';
	include 'animalModel.php';
	include 'pesoModel.php';
	include 'acasalamentoModel.php';
	
	include 'conexao.php';
	
	$acao = $_GET["acao"];
	if ($acao == 'incluir')
	{
		$nascimentoController = new nascimentoController();
		print $nascimentoController->incluir();
	}		
	

class nascimentoController{
	
	function incluir() 
	{
		session_start();
		$id_propriedade = $_SESSION["id_propriedade"];
		
		$peso	        = $_GET["peso"];		
		$tatuagem		= $_GET["tatuagem"];
		$dtNascimento   = $_GET["dtNascimento"];
		$data           = substr($dtNascimento, 6, 4)."-".substr($dtNascimento, 3, 2)."-".substr($dtNascimento, 0, 2);
		$dtPeso  		= $data;
		$sexo 			= $_GET["sexo"];
		$parto 			= $_GET["parto"];
		$caracteristica = $_GET["subject"];
		$idPai			= $_GET["idPai"];
		$idMae			= $_GET["idMae"];
		$idAcasalamento = $_GET["idAcasalamento"];	
		$marco          = 'n';		
		$nome 			= $_GET["nome"];
		$vivo			= $_GET["vivo"];
		$dtMorte = "";
		if ($vivo == 's'){				
		}
		else
		{
			$dtMorte = $data;
		}


		$animal = new animalModel();
		$incluirAnimal = $animal->incluir($id_propriedade, $tatuagem, $data, $sexo, $parto, $idPai, $idMae, $caracteristica, $nome, $dtMorte , $idAcasalamento);
		$id_animal= $incluirAnimal;
		
		$pesoModel = new pesoModel();
		$retorno = $pesoModel->incluir($id_animal , $peso , $marco , $data);
				
		$qtd = 1;
		$acasalamento = new acasalamentoModel();				
		$informarNascimento = $acasalamento->informarNascimento($idAcasalamento, $data , $qtd );
		
		$nascimentoView = new $nascimentoView();
		$nascimentoView->incluir($informarNascimento);		
	}	
}
?>



 

