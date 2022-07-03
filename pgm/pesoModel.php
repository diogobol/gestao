<?php
class pesoModel{
	function incluir($id_animal , $peso , $marco , $data)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql = 'insert into gestaoovino.peso(id_animal, marco , dt_peso , peso) 
		        values ("'.$id_animal.'" , "'.$marco.'" , "'.$data.'" , "'.$peso.'")';	
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			print  'peso inserido com sucesso !';
		}
		else 
		{
			print 'erro ao inserir peso do animal !';
		}			
		return $retorno;				
	}
	function excluir($id_peso)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql = "delete from gestaoovino.peso where id_peso = '$id_peso'";

		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			
		}
		else 
		{
			
		}			
		return $retorno;				
	}
	function alterar($id_animal , $peso , $marco , $data , $id_peso)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql = "update gestaoovino.peso set marco = '$marco' , dt_peso = '$data' , peso =  '$peso' where id_peso = '$id_peso'"; 
		        
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			
		}
		else 
		{
			
		}			
		return $retorno;				
	}
	function listarPeso ($id_animal)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		//carregar base 
		
		// Executa a Query desejada
		$listaPeso = $mysql->sql_query(" select a.id_animal as id_animal , 
												p.afixo as afixo , 
												a.tatuagem as tatuagem, 
												a.nome as nome , 
												a.dt_nascimento as dt_nascimento,
												peso.id_peso as id_peso,
												peso.dt_peso as dt_peso , 
												peso.peso as peso , 
												peso.marco as marco ,
												DATEDIFF(peso.dt_peso, a.dt_nascimento) AS diasPeso
										from gestaoovino.rebanho r 
										join gestaoovino.animal a on 
										r.id_animal = a.id_animal 
										join gestaoovino.propriedade p on 
										r.id_propriedade = p.id_propriedade 
										join gestaoovino.peso peso on
										peso.id_animal = r.id_animal
										where r.id_animal = '$id_animal'");
		while($peso = mysqli_fetch_assoc($listaPeso)){
			$item = array($peso['id_animal'] , $peso['afixo'] , $peso['tatuagem'] , $peso['nome'] , $peso['dt_nascimento'] , $peso['id_peso'] , $peso['dt_peso'] , $peso['peso'] , $peso['marco'] , $peso['diasPeso'] );
			array_push($lista, $item);			
		}
		return $lista;
	}
	function obter($id_peso , $id_propriedade)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		//carregar base 
		
		// Executa a Query desejada
		$listaPeso = $mysql->sql_query(" select a.id_animal as id_animal , 
												p.afixo as afixo , 
												a.tatuagem as tatuagem, 
												a.nome as nome , 
												a.dt_nascimento as dt_nascimento,
												peso.id_peso as id_peso,
												DATE_FORMAT (peso.dt_peso,'%d-%m-%Y') as dt_peso , 
												peso.peso as peso , 
												peso.marco as marco 
										from gestaoovino.rebanho r 
										join gestaoovino.animal a on 
										r.id_animal = a.id_animal 
										join gestaoovino.propriedade p on 
										r.id_propriedade = p.id_propriedade 
										join gestaoovino.peso peso on
										peso.id_animal = r.id_animal
										where peso.id_peso = '$id_peso' and r.id_propriedade = '$id_propriedade' ");
		while($peso = mysqli_fetch_assoc($listaPeso)){
			$item = array($peso['id_animal'] , $peso['afixo'] , $peso['tatuagem'] , $peso['nome'] , $peso['dt_nascimento'] , $peso['id_peso'] , $peso['dt_peso'] , $peso['peso'] , $peso['marco']);
			array_push($lista, $item);			
		}
		return $lista;
	}

}
?>



 

