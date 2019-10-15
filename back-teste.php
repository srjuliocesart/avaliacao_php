<?php

	$conexao = ibase_connect("localhost:C:/Program Files (x86)/EasyPHP-Devserver-17/eds-www/Teste/BD/DB_TESTE.fdb","SYSDBA","teste123") or die( 'Erro ao conectar: ' . ibase_errmsg() );
	$url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);

	if($url == ''){
		if(is_ajax()){
			
			$sql = "select empresa, razao_social from empresa";
			$resultado = ibase_query($conexao, $sql);
			if($resultado){
				while ($row = ibase_fetch_object($resultado)) {
					 foreach ($row as $key => $value) {
					 	if($key == 'RAZAO_SOCIAL'){
					 		$razao = $value;
					 	}
					 	if($key == 'EMPRESA'){
					 		$empresa = $value;
					 	}
					 }
				        $return_arr[] = array(
				         	"razao" => $razao,
				         	"empresa" => $empresa
				        );
			    }
			}
			print_r(json_encode($return_arr));
		}
	}

	if($url == 'trocaEmpresa'){
		$sql_cidade = "select cidade, descricao_cidade from cidade where empresa = ".$_POST['id'];
		$resultado_cidade = ibase_query($conexao, $sql_cidade);
		if($resultado_cidade){
			while ($row_cidade = ibase_fetch_object($resultado_cidade)) {
				 foreach ($row_cidade as $key => $value) {
				 	if($key == 'CIDADE'){
				 		$cidade = $value;
				 	}
				 	if($key == 'DESCRICAO_CIDADE'){
				 		$nome_cidade = $value;
				 	}
				 }
			        $return_arr[] = array(
			         	"cidade" => $cidade,
			         	"nome_cidade" => $nome_cidade
			        );
		    }
		}
		print_r(json_encode($return_arr));
	}

	if()

	function is_ajax() {
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

?>