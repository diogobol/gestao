<?php
class pesoView {

	function obter($retorno){
 		$linha = '';
		$qtd = count($retorno);
		
		for ($row = 0; $row < $qtd; $row++) {				
			for ($col = 0; $col < 4 ; $col++){
				$linha = $linha.$retorno[$row][$col]."#";
			} 
		}
		print $linha;
	}

	function obterPeso($retorno){
 		$linha = '';
		$qtd = count($retorno);
		
		for ($row = 0; $row < $qtd; $row++) {				
			for ($col = 0; $col < 9 ; $col++){
				$linha = $linha.$retorno[$row][$col]."#";
			} 
		}
		print $linha;
	}


	function incluir($retorno){

		print "incluido com sucesso ! ";
	
	}
	
	function alterar($retorno){

		print "Alterado com sucesso ! ";
	
	}
	function excluir($retorno){

		print "Peso excluido com sucesso ! ";
	
	}

	public function listarPeso($retorno)
	{
		$qtd = count($retorno);
		print "<table id='customers'>";
		print "<tr><th>Data Nascimento</th><th>Data Pesagem</th><th>Peso</th><th>Marco</th></tr>";
		//id_animal afixo tatuagem nome dt_nascimento id_peso dt_peso peso marco
		for ($row = 0; $row < $qtd; $row++) {		
			$dataNascimento = (substr($retorno[$row][4], 8, 2)."-".substr($retorno[$row][4], 5, 2)."-".substr($retorno[$row][4], 0, 4));
			$dataPesagem = (substr($retorno[$row][6], 8, 2)."-".substr($retorno[$row][6], 5, 2)."-".substr($retorno[$row][6], 0, 4));			
			print "<tr onClick='obterPeso(".$retorno[$row][5].");'><td>".$dataNascimento."</td><td>".$dataPesagem."</td><td>".$retorno[$row][7]."</td><td>".$retorno[$row][8]."</td>";
		} 
		print "</table>";
	}
}
?>



 

