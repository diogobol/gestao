<?php
class acasalamentoModel{

	function incluir($id_propriedade, $idPai , $idMae , $data , $tipo , $temporada , $status )
	{
    	// Instanciamos o Objeto
		$mysql = new conexao;

		$sql = "insert into gestaoovino.acasalamento(id_propriedade, id_pai , id_mae , dt_acasalamento , tipo , temporada , status )";	
		$sql = $sql.' values ("'.$id_propriedade.'" , "'.$idPai.'" , "'.$idMae.'",  "'.$data.'" , "'.$tipo.'" , "'.$temporada.'" , "'.$status.'" )';
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			$idCobertura = $retorno;					
			return $retorno;
		}
		else 
		{
			return $retorno;
		}
		
	}
	function inativar($id_propriedade, $idPai , $idMae, $temporada)
	{
    	// Instanciamos o Objeto
		$mysql = new conexao;
		$sql = 'update gestaoovino.acasalamento set status = "i" where id_propriedade = '.$id_propriedade.' and id_mae = '.$idMae.' and temporada="'.$temporada.'"'; 
		$retorno = $mysql->sql_query($sql);
		if($retorno)
		{
			return 1;
		}
		else 
		{
			return 9;
		}
	}	
	function listar($id_propriedade, $data , $temporada){
			// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$sql =  "select c.id_acasalamento,
                        c.dt_acasalamento,
						ADDDATE(c.dt_acasalamento, INTERVAL 145 DAY) as dtPrevista , 
						DATEDIFF(CURRENT_DATE(), c.dt_acasalamento) AS DIASCOBERTURA,
						145 - DATEDIFF(CURRENT_DATE(), c.dt_acasalamento) AS DIASPARANASCER ,
						ifnull(c.dt_nascimento, '0000-00-00')  as dt_nascimento,
						pp.afixo as afixoPai,
						ap.tatuagem as tatuagemPai,
						pp.afixo as afixoMae,	
						am.tatuagem as tatuagemMae,
						DATEDIFF(c.dt_nascimento, c.dt_acasalamento) AS DIASNASCIMENTO
				from 	gestaoovino.acasalamento c 
				join 	gestaoovino.animal ap on 
						c.id_pai = ap.id_animal
				join 	gestaoovino.propriedade pp on
						ap.id_propriedade =	pp.id_propriedade
				join 	gestaoovino.animal am on 
						c.id_mae = am.id_animal 
				join 	gestaoovino.propriedade pm on
						am.id_propriedade =pm.id_propriedade
				where 	c.id_propriedade = '$id_propriedade' and status ='a' ";
		$listaCobertura = $mysql->sql_query($sql);
		while($list = mysqli_fetch_assoc($listaCobertura)){
			$item = array(	$list['id_acasalamento'] , 
							$list['dt_acasalamento'] , 
							$list['dtPrevista'] , 
							$list['DIASCOBERTURA'],
							$list['DIASPARANASCER'],
							$list['dt_nascimento'],
							$list['afixoPai'],
							$list['tatuagemPai'],
							$list['afixoMae'],
							$list['tatuagemMae'],
							$list['DIASNASCIMENTO']);
			array_push($lista, $item);			
		}
		return $lista;	
	}	
	function obter($id_propriedade, $id_acasalamento){
			// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$sql =  "select c.id_acasalamento,
						c.id_pai as id_pai,
						c.id_mae as id_mae,
                		pp.afixo as afixoPai,
						ap.tatuagem as tatuagemPai,
						ap.nome as nomePai,
						pp.afixo as afixoMae,	
						am.tatuagem as tatuagemMae,
						am.nome as nomeMae,
						DATE_FORMAT (c.dt_acasalamento,'%d-%m-%Y') as dt_acasalamento,
						c.tipo as tipo
				from 	gestaoovino.acasalamento c 
				join 	gestaoovino.animal ap on 
						c.id_pai = ap.id_animal
				join 	gestaoovino.propriedade pp on
						ap.id_propriedade =	pp.id_propriedade
				join 	gestaoovino.animal am on 
						c.id_mae = am.id_animal 
				join 	gestaoovino.propriedade pm on
						am.id_propriedade =pm.id_propriedade
				where 	c.id_propriedade = '$id_propriedade'
				and     c.id_acasalamento = '$id_acasalamento'";
				
		$listaAcasalamento = $mysql->sql_query($sql);
		while($list = mysqli_fetch_assoc($listaAcasalamento)){
			$item = array(	$list['id_acasalamento'] , 
							$list['id_pai'],
							$list['afixoPai'],
							$list['tatuagemPai'],
							$list['nomePai'],
							$list['id_mae'],							
							$list['afixoMae'],
							$list['tatuagemMae'],
							$list['nomeMae'],
							$list['dt_acasalamento'],
							$list['tipo']);
			array_push($lista, $item);		
		}
		
		return $lista;	
	}	
	function informarNascimento($id_acasalamento, $data , $qtd )
	{
    	// Instanciamos o Objeto
		$mysql = new conexao;

		$sql = "update  gestaoovino.acasalamento set ";
		$sql = $sql."dt_nascimento = '".$data."', ";
		$sql = $sql."qtd_nascimento = qtd_nascimento + ".$qtd;
		$sql = $sql." where id_acasalamento = '$id_acasalamento'";
		echo $sql;
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			return $retorno;
		}
		else 
		{
			return $retorno;
		}
		
	}
	function listarConsultaMae($id_propriedade, $temporada){
			// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$sql =  "select a.id_mae as id_mae ,
						p.afixo as afixo , 
						an.tatuagem as tatuagem , 
						an.nome as nome , 
		                an.dt_nascimento as dt_nascimento , 
						a.dt_acasalamento as dt_acasalamento, 
						a.status as status,
						a.temporada,
						ifnull(af.id_animal , 0) as id_filho ,
						a.id_acasalamento as id_acasalamento
		         from gestaoovino.acasalamento a 
				 join gestaoovino.animal an on
				 a.id_mae = an.id_animal
				 join gestaoovino.propriedade p on
				 an.id_propriedade = p.id_propriedade
				 left join gestaoovino.animal af on
				 a.id_acasalamento = af.id_acasalamento
				where a.id_propriedade = '$id_propriedade'";
		if ($temporada=="")
		{}
		else{
		$sql = $sql." and a.temporada= '$temporada'";	
		}
		
		$sql = $sql." order by a.id_mae , a.dt_acasalamento";
						
		$listaConsultaMae = $mysql->sql_query($sql);
		while($list = mysqli_fetch_assoc($listaConsultaMae)){
			$item = array(	$list['id_mae'] , 
							$list['dt_acasalamento'] , 
							$list['status'],
							$list["afixo"],
							$list["tatuagem"],
							$list["nome"],
							$list["dt_nascimento"],
							$list["temporada"],
							$list["id_filho"],
							$list["id_acasalamento"]);
			array_push($lista, $item);			
		}
		return $lista;	
	}
	function listarTaxa($id_propriedade, $temporada){
			// Instanciamos o Objeto
		$mysql = new conexao;
		// retorna lista dos usuaios encontrados
		$lista = array();
		// Executa a Query desejada
		$sql =  "SELECT id_mae , qtd_nascimento , temporada
		         FROM gestaoovino.acasalamento
				 WHERE id_propriedade = '$id_propriedade'
				 and   status='a' " ;
		
		if($temporada=="")
		{
		}
		else
		{
			$sql = $sql." and temporada ='$temporada'";		
		}
		
		$sql = $sql." order by temporada;";
		$listaCobertura = $mysql->sql_query($sql);
		while($list = mysqli_fetch_assoc($listaCobertura)){
			$item = array(	$list['id_mae'] , 
							$list['qtd_nascimento'],
							$list['temporada']);
			array_push($lista, $item);			
		}
		return $lista;	
	}
	function alterar($id_propriedade, $idPai , $idMae , $data , $tipo , $temporada , $id_acasalamento)
	{
    	// Instanciamos o Objeto
		$mysql = new conexao;

		$sql = "update gestaoovino.acasalamento set ";
		$sql = $sql." id_pai='$idPai' , id_mae = '$idMae', dt_acasalamento = '$data' , tipo ='$tipo' , temporada = '$temporada' ";
		$sql = $sql." where id_acasalamento = '$id_acasalamento' and id_propriedade = '$id_propriedade'";
		$retorno = $mysql->sql_query_insert($sql);
		if($retorno)
		{
			$idCobertura = $retorno;					
			return $retorno;
		}
		else 
		{
			return $retorno;
		}
		
	}
}
?>



 

