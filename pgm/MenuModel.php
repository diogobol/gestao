<?php
class MenuModel{
		function listar(){
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$listaMenu = $mysql->sql_query("select * from gestaoovino.menu order by ordem_apresentacao");
		
		while($menu = mysqli_fetch_assoc($listaMenu)){
			$item = array($menu['id_menu'] , $menu['pagina'] , $menu['descricao']  , $menu['tipo'] );
			array_push($lista,$item);
;
		}		
		return $lista;
	}
}
?>



 

