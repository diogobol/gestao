<?php
class rebanhoModel{

function incluir ($id_propriedade, $id_animal)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql = 'insert into gestaoovino.rebanho(id_propriedade, id_animal) 
		        values ("'.$id_propriedade.'" , "'.$id_animal.'" )';
	
		$retorno = $mysql->sql_query_insert($sql);
		return $retorno;
		
			
	}
	
	function listar ($id_propriedade)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql= " select a.id_animal as id_animal , p.afixo as afixo , a.tatuagem as tatuagem, a.nome as nome
					from gestaoovino.rebanho r 
					join gestaoovino.animal a on 
					r.id_animal = a.id_animal 
					join gestaoovino.propriedade p on 
					r.id_propriedade = p.id_propriedade 
					where 
					r.id_propriedade = '$id_propriedade' and 
					sexo = '$sexo' "										;
	
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			$mensagem = 'animal inserido no rebanho comsucesso !';
		}
		else 
		{
			$mensagem = 'erro ao inserir animal do rebanho !';
		}		
	
		return $mensagem;
	}	
}
?>



 

