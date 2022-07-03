<?php
//
class loginView {
	function logar($listaUsuario){
		session_start();
		$_SESSION["id_usuario"] = $listaUsuario[0][0];
		$_SESSION["tipo"] = $listaUsuario[0][1];
		$_SESSION["id_propriedade"] = $listaUsuario[0][2];
		$_SESSION["afixo"] = $listaUsuario[0][3];
		header("Location:home.html");	
	}
	function naoLogar($listaUsuario){
		
		print "Usuario nao localizado.";		
	}
}
?>