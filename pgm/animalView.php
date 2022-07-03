<?php
	
	
	class animalView {
	function carregarPai($listaPai)
	{	
		$qtd = count($listaPai);			
		print "<div class='col-25'>";
		print "    <label for='country'>PAI:</label>";
		print "  </div>";
		print "  <div class='col-75'>";
		print "    <select id='cboPaiI' name='cboPaiI'>";
		for ($row = 0; $row < $qtd; $row++) {		
			print "<option value='".$listaPai[$row][0]."'".">".$listaPai[$row][1]." - ".$listaPai[$row][2]." - ".$listaPai[$row][3]."</option>";
		}		
		print "</select>";
		print "</div>";		
	}
	function carregarMae($listaMae)
	{
		$qtdMae = count($listaMae);	
		print "<div class='col-25'>";
		print "    <label for='country'>MAE:</label>";
		print "  </div>";
		print "  <div class='col-75'>";
		print "    <select id='cboMaeI' name='cboMaeI'>";

		for ($row = 0; $row < $qtdMae; $row++) {		
			print "<option value='".$listaMae[$row][0]."'".">".$listaMae[$row][1]." - ".$listaMae[$row][2]." - ".$listaMae[$row][3]."</option>";
		}
		
		print "</select>";
		print "</div>";
		return;	
	}
	function incluir($retorno)
	{		
		print "Incluido com sucesso!";
	}
	function alterar($retorno)
	{		
		print "Alterado com sucesso!";
	}
	function listar($retorno)
	{		
		$qtd = count($retorno);
		print "<table id='customers'>";
		print "<tr><th>AFIXO</th><th>TATUAGEM</th><th>NOME</th><th>Sexo</th></tr>";
		for ($row = 0; $row < $qtd; $row++) {				
		if($retorno[$row][4] == 'm')
		{
			$descSexo = 'MACHO';
		}
		else
		{
			$descSexo = 'FEMEA';
		}
			print "<tr onClick='obter(".$retorno[$row][0].");'><td>".$retorno[$row][1]."</td><td>".$retorno[$row][2]."</td><td>".$retorno[$row][3]."</td><td>".$descSexo."</td></tr>";
		} 
		print "</table>";		
	}
	function obter($retorno)
	{				
		$linha = '';
		$qtd = count($retorno);
		for ($row = 0; $row < $qtd; $row++) {				
			for ($col = 0; $col < 10 ; $col++){
				$linha = $linha.$retorno[$row][$col]."/";
			} 
		}
		print $linha;
	}	
}
?>



 

