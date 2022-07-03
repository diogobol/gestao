<?php
class LoginModel{
	
	function buscarUsuario($usuario,$senha){
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$listausuario = $mysql->sql_query("select id_usuario , usuario , tipo from gestaoovino.usuario where usuario = '$usuario' and senha = '$senha' ");
		while($usu = mysqli_fetch_assoc($listausuario)){
			$item = array($usu['id_usuario'] , $usu['usuario'], $usu['tipo']);
			array_push($lista, $item);
		}
		return $lista;
	}
	
	function buscarPropriedade($id_usuario){
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$listaPropriedade = $mysql->sql_query("select * from gestaoovino.propriedade where id_usuario = '$id_usuario'");
		while($pro = mysqli_fetch_assoc($listaPropriedade)){			
			//echo $pro['id_propriedade'];
			//echo $pro['afixo'];
			//echo  $pro['nome'];						
			$item = array($pro['id_propriedade'] , $pro['afixo'] , $pro['nome']);
			array_push($lista, $item);			
		}
		return $lista;
	}
}
?>