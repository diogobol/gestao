<?php
class conexao {
    // Coloque aqui as Informações do Banco de Dados
    var $host = "127.0.0.1"; // Nome ou IP do Servidor
    var $user = "root"; // Usuário do Servidor MySQL
    var $senha = ""; // Senha do Usuário MySQL
    var $dbase = "gestaoovino"; // Nome do seu Banco de Dados

    // Cria as variáveis que Utilizaremos
    var $query;
    var $link;
    var $resultado;
    var $list;
	
    function MySQL(){
		// Instancia o Objeto para usarmos
    }
	
	// Cria a função para Conectar ao Banco MySQL
    function conecta(){
        $this->link = mysqli_connect($this->host,$this->user,$this->senha,$this->dbase);
		// Conecta ao Banco de Dados
        if(!$this->link){
			// Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro na conexão MySQL:";
			print "<b>".mysqli_error()."</b>";
			die();
        }
		else{
			return $this->link;
		}
    }


	// Cria a função para query no Banco de Dados
    function sql_query($query){
        $this->conecta();
        $this->query = $query;
		// Conecta e faz a query no MySQL
        if($this->resultado = mysqli_query($this->link,$this->query)){
            $this->desconecta();
            return $this->resultado;
        }else{
			// Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
			print "<br><br>";
			print "Erro no MySQL: <b>".mysqli_error()."</b>";
			die();
            $this->desconecta();
        }        
    }
	

	// Cria a função para query no Banco de Dados
    function sql_query_insert($query){
        $this->conecta();
        $this->query = $query;
		// Conecta e faz a query no MySQL
        if($this->resultado = mysqli_query($this->link,$this->query)){			
			$this->resultado = mysqli_insert_id($this->link);
            $this->desconecta();
            return $this->resultado;					
        }else{
			// Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
			print "<br><br>";
			print "Erro no MySQL: <b>".mysqli_error($this->link)."</b>";
			die();
            $this->desconecta();
        }        
    }	
	
	// Cria a função para query no Banco de Dados
    function ultimo(){
        $this->conecta();
        // Conecta e faz a query no MySQL
                
    }
	
	// Cria a função para Desconectar ao Banco MySQL
    function desconecta(){
        mysqli_close($this->link);
    }
}
?>
