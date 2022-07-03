<?php
	//adiciona camada de controller 
	include 'MenuModel.php';
	include 'MenuView.php';
	include 'conexao.php';

	session_start();
	$tipo = $_SESSION["tipo"];	
	$idPropriedade = $_SESSION["id_propriedade"];	
	$menuController = new menuController();
	$menuController->montarMenu($tipo,$idPropriedade);

class menuController{
	function montarMenu($tipo,$idPropriedade){
		$lista = array();
		$MenuModel = new MenuModel();
		$listMenu = $MenuModel->listar();	
		$qtd = count($listMenu);
		// monta menu de acordo com a funcao do usuario
		// array -> id_menu | pagina | descricao | tipo

		for ($row = 0; $row < $qtd; $row++) {
			if ($tipo == 'a'){
				$item = array($listMenu[$row][0] , $listMenu[$row][1] , $listMenu[$row][2]);
			    array_push($lista,$item);
			}
			else{}
			
			if ($tipo == 'p'){
				if ($listMenu[$row][3] == 'p' ||
					$listMenu[$row][3] == 'x' ){
					$item = array($listMenu[$row][0] , $listMenu[$row][1] , $listMenu[$row][2]);
					array_push($lista,$item);
				}
				else{}
			}
			else{}	
		}		
		$menuView = new menuView();
		$menuView->montarMenu($lista);
	}
}
?>



 

