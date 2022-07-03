<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 200px;
    background-color: #f8f8ff;
	font-family: Candara,"Trebuchet MS", Arial, Helvetica, sans-serif;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
	font-family: Candara,"Trebuchet MS", Arial, Helvetica, sans-serif;
}

li a.active {
    background-color: rgba(60, 179, 113, 1 );
    color: white;
	font-family: Candara,"Trebuchet MS", Arial, Helvetica, sans-serif;	
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
	font-family: Candara,"Trebuchet MS", Arial, Helvetica, sans-serif;
}
</style>
<?php
class menuView{
	function montarMenu ($lista){
		// montar menu
		$qtd = count($lista);		
		print "<ul><li><a class='active' href='#home'>MENU</a></li>";		
		for ($row = 0; $row < $qtd; $row++) {		
			print "<li><a href='".$lista[$row][1]."' target='iframe_b'>".$lista[$row][2]."</a></li>";			
		}					
		print "</ul>";	
	}
}
?>



 

