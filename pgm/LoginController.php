<?php
include 'LoginModel.php';
include 'LoginView.php';
include 'conexao.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$login = new LoginController();
$login->logar($usuario,$senha);

class LoginController{
	function logar($usuario,$senha)
	{
		$lista = array();
		//regra de negocio	
		$LoginModel = new LoginModel();
		$listaUsuarios = $LoginModel->buscarUsuario($usuario,$senha);
		$qtd = count($listaUsuarios);
		
		if($qtd>=1)
		{
			//&item = array($usu['id_usuario'] , $usu['usuario'], $usu['tipo']);
			for ($row = 0; $row < $qtd; $row++) 
			{
				if ($listaUsuarios[$row][2] == 'p'){
					// busca dados da propriedade
					$id_usuario = $listaUsuarios[$row][0];
					//echo $id_usuario;
					$listaPropriedade =  $LoginModel-> buscarPropriedade($id_usuario);
					$qtdProp =count($listaPropriedade);
					for ($rowProp = 0; $rowProp < $qtdProp; $rowProp++) {
						// id_usuario , tipo ,  id_propriedade , afixo 					
						//echo $listaUsuarios[$row][0];
						//echo $listaUsuarios[$row][2];
						//echo $listaPropriedade[$rowProp][0];
						//echo  $listaPropriedade[$rowProp][1];					
						$item = array($listaUsuarios[$row][0], $listaUsuarios[$row][2] , $listaPropriedade[$rowProp][0] , $listaPropriedade[$rowProp][1]);
						array_push($lista, $item);
					}				
				}
				else
				{
					$item = array($listaUsuarios[$row][0], $listaUsuarios[$row][2] , '0' , '');
					array_push($lista, $item);
				}
			}
			
			$loginView = new loginView();
			$loginView -> logar($lista);	
		}
		else
		{
			$loginView = new loginView();
			$loginView -> NaoLogar($lista);				
		}
	}
}
?>