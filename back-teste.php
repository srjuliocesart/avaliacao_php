<?php
	
	//conexão do meu computador, na instalação do Firebird a masterkey foi trocada para "teste123" pois desconhecia como usar o firebird
	$conexao = ibase_connect("localhost:C:/Program Files (x86)/EasyPHP-Devserver-17/eds-www/Teste/BD/DB_TESTE.fdb","SYSDBA","teste123") or die( 'Erro ao conectar: ' . ibase_errmsg() );
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
		$sql_prod = 'select * from produto where empresa = '.$_POST['empresa'];
		$result_prod = ibase_query($conexao, $sql_prod);
		if($result_prod){
			while ( $row_prod = ibase_fetch_object($result_prod)) {
				//var_dump($row_prod);
				foreach($row_prod as $key => $value){
					if($key == 'PRODUTO'){ $produto = $value; }
					if($key == 'DESCRICAO_PRODUTO'){ $desc = $value; }
					if($key == 'APELIDO_PRODUTO'){ $nick = $value; }
					if($key == 'GRUPO_PRODUTO'){ $group = $value; }
					if($key == 'SUBGRUPO_PRODUTO'){ $sgroup = $value; }
					if($key == 'SITUACAO'){ $sit = $value; }
					if($key == 'PESO_LIQUIDO'){ $peso = $value; }
					if($key == 'CLASSIFICACAO_FISCAL'){ $class = $value; }
					if($key == 'CODIGO_BARRAS'){ $codb = $value;}
					if($key == 'COLECAO'){ $collection = $value; }
				}
				$return_arr[] = array(
					"produto" => $produto,
					"descricao" => $desc,
					"apelido" => $nick,
					"grupo" => $group,
					"subgrupo" => $sgroup,
					"situacao" => $sit,
					"peso" => $peso,
					"classificacao" => $class,
					"codigo_barra" => $codb,
					"colecao" => $collection
				);
			}
		}
		print_r(json_encode($return_arr));
	}

	function is_ajax() {
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

?>