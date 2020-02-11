<?php
	
	//conexão do meu computador, na instalação do Firebird a masterkey foi trocada para "teste123" pois desconhecia como usar o firebird
	//$conexao = ibase_connect("localhost:C:/Program Files (x86)/EasyPHP-Devserver-17/eds-www/Teste/BD/DB_TESTE.fdb","SYSDBA","masterkey") or die( 'Erro ao conectar: ' . ibase_errmsg() );
	$conexao = ibase_connect("localhost:C:/xampp/htdocs/avaliacao_php/BD/DB_TESTE2.fdb","SYSDBA","masterkey") or die( 'Erro ao conectar: ' . ibase_errmsg() );
	//lê a requisição após do "?" na url do ajax
	$url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);

	//trazendo as empresas
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

	//trocou as empresas então troca-se as cidades
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

	if($url == 'listaProdutos'){
		$i = 1;
		$sql_prod = 'select * from produto where empresa = '.$_POST['empresa'];
		$result_prod = ibase_query($conexao, $sql_prod);
		if($result_prod){
			while ( $row_prod = ibase_fetch_object($result_prod)) {
				//var_dump($row_prod);
				$return_arr[$i] = array();
				foreach($row_prod as $key => $value){
					if($key == 'PRODUTO'){ $return_arr[$i]['produto'] = $value; }
					if($key == 'DESCRICAO_PRODUTO'){ $return_arr[$i]['desc'] = $value; }
					if($key == 'APELIDO_PRODUTO'){ $return_arr[$i]['nick'] = $value; }
					if($key == 'GRUPO_PRODUTO'){ $return_arr[$i]['group'] = $value; }
					if($key == 'SUBGRUPO_PRODUTO'){ $return_arr[$i]['sgroup'] = $value; }
					if($key == 'SITUACAO'){ $return_arr[$i]['sit'] = $value; }
					if($key == 'PESO_LIQUIDO'){ $return_arr[$i]['peso'] = $value; }
					if($key == 'CLASSIFICACAO_FISCAL'){ $return_arr[$i]['class'] = $value; }
					if($key == 'CODIGO_BARRAS'){ $return_arr[$i]['codb'] = $value;}
					if($key == 'COLECAO'){ $return_arr[$i]['collection'] = $value; }
				}
				$i++;
			}
		}
		print_r(json_encode($return_arr));
	}

	function is_ajax() {
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

?>