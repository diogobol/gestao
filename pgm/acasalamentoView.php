<?php
	class acasalamentoView {
		function incluir($retorno)
		{	
			print "Acasalmento incluido com sucesso.";
		}	
		function alterar($retorno)
		{	
			print "Acasalmento alterado com sucesso.";
		}	
		function listar($lista)
		{		
			$qtd = count($lista);	
			print "<table id='customers'>";
			print "<tr><th>PAI </th><th>MAE</th><th>DATA CRUZAMENTO</th><th>PREVISAO</th> <th>DIAS DE GESTACAO</th> <th>DIAS NASCIMENTO</th></tr>";
			for ($row = 0; $row < $qtd; $row++) {		
				$prazo = (substr($lista[$row][2], 8, 2)."-".substr($lista[$row][2], 5, 2)."-".substr($lista[$row][2], 0, 4));		
				$data =  (substr($lista[$row][1], 8, 2)."-".substr($lista[$row][1], 5, 2)."-".substr($lista[$row][1], 0, 4));						
				print "<tr onClick='obter(".$lista[$row][0].");'><td>".$lista[$row][5]."-".$lista[$row][6]."</td><td>".$lista[$row][7]."-".$lista[$row][8]."</td><td>".$data."</td><td>".$prazo."</td><td>".$lista[$row][3]."</td><td>".$lista[$row][4]."</td></tr>";
			} 
			print "</table>";
		}	
		function obter ($retorno)
		{
			$linha = '';
			$qtd = count($retorno);
			for ($row = 0; $row < $qtd; $row++) {				
				for ($col = 0; $col < 11 ; $col++){
					$linha = $linha.$retorno[$row][$col]."/";
				} 
			}
			print $linha;
		}
	}
?>



 

