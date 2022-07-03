<?php
class animalModel{

	function carregarAnimal ($id_propriedade,$sexo)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		//carregar base 
		$item = array('0', 'Selecione' , '' , '');
		array_push($lista, $item);							
		// Executa a Query desejada
		$listaPai = $mysql->sql_query(" select a.id_animal as id_animal , p.afixo as afixo , a.tatuagem as tatuagem, a.nome as nome
										from gestaoovino.rebanho r 
										join gestaoovino.animal a on 
										r.id_animal = a.id_animal 
										join gestaoovino.propriedade p on 
										r.id_propriedade = p.id_propriedade 
										where 
										r.id_propriedade = '$id_propriedade' and 
										sexo = '$sexo' ");
		while($pai = mysqli_fetch_assoc($listaPai)){
			$item = array($pai['id_animal'] , $pai['afixo'] , $pai['tatuagem'] , $pai['nome']);
			array_push($lista, $item);			
		}
		return $lista;
	}

	function listar ($id_propriedade, $tatuagem)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		
		// Executa a Query desejada
		$sql = " select a.id_animal as id_animal , p.afixo as afixo , a.tatuagem as tatuagem, a.nome as nome ,a.sexo sexo
						from gestaoovino.rebanho r 
						join gestaoovino.animal a on 
						r.id_animal = a.id_animal 
						join gestaoovino.propriedade p on 
						r.id_propriedade = p.id_propriedade 
						where 
						r.id_propriedade = '$id_propriedade'";
		if ($tatuagem =='')
		{}
		else
		{
			$sql = $sql." and tatuagem = '$tatuagem'";
		}									
								
		$resultado = $mysql->sql_query($sql);
		while($pai = mysqli_fetch_assoc($resultado)){
			$item = array($pai['id_animal'] , $pai['afixo'] , $pai['tatuagem'] , $pai['nome'] , $pai['sexo'] );
			array_push($lista, $item);			
		}
		return $lista;
	}

	function obter ($id_propriedade, $id_animal)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$sql = "select a.id_animal as id_animal , 
					p.afixo as afixo ,
                	a.tatuagem as tatuagem, 
					a.nome as nome, 
					a.id_pai as id_pai , 
					a.id_mae as id_mae, 
					a.sexo as sexo , 
					a.dt_nascimento  as dt_nascimento,
					a.caracteristica as caracteristica,
					a.tipo_parto as tipo_parto
				from gestaoovino.rebanho r 
				join gestaoovino.animal a on 
				r.id_animal = a.id_animal 
				join gestaoovino.propriedade p on 
				r.id_propriedade = p.id_propriedade 
				where r.id_animal = '$id_animal' ";
				
		if($id_propriedade == '')
		{}
		else
		{
			$sql = $sql." and r.id_propriedade = '$id_propriedade'";
		}
		$obter = $mysql->sql_query($sql);
		while($animal = mysqli_fetch_assoc($obter)){			
			$data = 
			$item = array($animal['id_animal'] , $animal['afixo'] , $animal['tatuagem'] , $animal['nome'],$animal['id_pai'] , 
							$animal['id_mae'], $animal['sexo'],
							substr($animal['dt_nascimento'], 8, 2)."-".substr($animal['dt_nascimento'], 5, 2)."-".substr($animal['dt_nascimento'], 0, 4) , 
							$animal['caracteristica'] , $animal['tipo_parto']);
			array_push($lista, $item);			
		}
		return $lista;
	}
	
	function incluir ($id_propriedade, $tatuagem, $data, $sexo, $parto, $idPai, $idMae, $caracteristica, $nome, $dtMorte, $id_acasalamento)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql = 'insert into gestaoovino.animal(tatuagem , dt_nascimento , sexo , tipo_parto, caracteristica, id_pai, id_mae , id_propriedade, nome, dt_morte, id_acasalamento) 
		        values ("'.$tatuagem.'" , "'.$data.'" , "'.$sexo.'" , "'.$parto.'" , "'.$caracteristica.'"  , "'.$idPai.'" , "'.$idMae.'" , "'.$id_propriedade.'", "'.$nome.'", "'.$dtMorte.'" , "'.$id_acasalamento.'")';
	
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			$id_animal = $retorno;	
			
		}
		else 
		{
			$id_animal = 0;
		}		
	
		return $id_animal;			
	}
	function alterar ($tatuagem, $data, $sexo, $parto, $idPai, $idMae, $caracteristica, $nome, $dtMorte, $id_animal)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		
		$sql = "update gestaoovino.animal set tatuagem = '$tatuagem'  , dt_nascimento = '$data' , sexo ='$sexo' , tipo_parto = '$parto'";
		$sql = $sql." , caracteristica = '$caracteristica' , id_pai = '$idPai' , id_mae = '$idMae' , nome = '$nome' , dt_morte = '$dtMorte'";
		$sql = $sql." where id_animal = '$id_animal'";        
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			$id_animal = $retorno;	
			
		}
		else 
		{
			$id_animal = 0;
		}		
	
		return $id_animal;			
	}
	function listarFilho ($id_animal)
	{
		// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		
		// Executa a Query desejada
		$sql = " select a.id_animal as id_animal , 
						p.afixo as afixo , 
						a.tatuagem as tatuagem, 
						a.nome as nome , 
						a.sexo sexo , 
						a.dt_nascimento dt_nascimento , 
						a.tipo_parto tipo_parto , 
						a.id_mae id_mae, 
						am.dt_nascimento dt_nascimento_mae,
						DATEDIFF(a.dt_nascimento, am.dt_nascimento) AS diasMae
						from gestaoovino.animal a  
						join gestaoovino.propriedade p on 
						a.id_propriedade = p.id_propriedade 
						join gestaoovino.animal am on
						a.id_mae = am.id_animal						
						where a.id_pai = '$id_animal' or a.id_mae = '$id_animal' ";
								
		$resultado = $mysql->sql_query($sql);
		while($filho = mysqli_fetch_assoc($resultado)){
			$item = array($filho['id_animal'] , $filho['afixo'] , $filho['tatuagem'] , $filho['nome'] , $filho['sexo'] , 
			              $filho['dt_nascimento'] , $filho['tipo_parto'], $filho['id_mae'], $filho['dt_nascimento_mae'] , $filho['diasMae'] );
			array_push($lista, $item);			
		}
		return $lista;
	}
}

?>



 

