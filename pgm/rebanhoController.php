<?php
include 'rebanhoModel.php';
class rebanhoController{
	
	public function incluir($id_propriedade, $id_animal){
		$rebanhoModel = new rebanhoModel();
		$mensagem = $rebanhoModel->incluir($id_propriedade, $id_animal);
		return $mensagem;
	}
	public function listar($id_propriedade){
		$rebanhoModel = new rebanhoModel();
		$mensagem = $rebanhoModel->listar($id_propriedade);
		return $mensagem;
	}	
}
?>



 

