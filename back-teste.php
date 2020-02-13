<?php
	
	//conexão do meu computador, na instalação do Firebird a masterkey foi trocada para "teste123" pois desconhecia como usar o firebird
	$conexao = ibase_connect("localhost:C:/Program Files (x86)/EasyPHP-Devserver-17/eds-www/Teste/BD/DB_TESTE.fdb","SYSDBA","masterkey") or die( 'Erro ao conectar: ' . ibase_errmsg() );
	//$conexao = ibase_connect("localhost:C:/xampp/htdocs/avaliacao_php/BD/DB_TESTE2.fdb","SYSDBA","masterkey") or die( 'Erro ao conectar: ' . ibase_errmsg() );
	//lê a requisição após do "?" na url do ajax
	$url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);
	$requestData= $_REQUEST;

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
		$colunas = array(
			0 => 'PRODUTO',
			1 => 'DESCRICAO_PRODUTO',
			2 => 'APELIDO_PRODUTO',
			3 => 'GRUPO_PRODUTO',
			4 => 'SUBGRUPO_PRODUTO',
			5 => 'SITUACAO',
			6 => 'PESO_LIQUIDO',
			7 => 'CLASSIFICACAO_FISCAL',
			8 => 'CODIGO_BARRAS',
			9 => 'COLECAO'
		);
		$i = 1;
		$sql_prod = 'select * from produto p join cidade c on p.empresa = c.empresa where p.empresa = '.$_POST['empresa'].' AND c.cidade = '.$_POST['id']. ' ';
		if( !empty($requestData['search']['value']) ) {
			$sql_prod .= " AND ( PRODUTO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR DESCRICAO_PRODUTO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR APELIDO_PRODUTO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR GRUPO_PRODUTO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR SUBGRUPO_PRODUTO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR SITUACAO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR PESO_LIQUIDO LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR CLASSIFICACAO_FISCAL LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR CODIGO_BARRAS LIKE '".$requestData['search']['value']."%' ";
			$sql_prod .= " OR COLECAO LIKE '".$requestData['search']['value']."%')";
		}
		//faz a ordenação
		$sql_prod.=" ORDER BY ". $colunas[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		
		$result_prod = ibase_query($conexao, $sql_prod);
		if($result_prod){
			$datas = array();
			while ( $row_prod = ibase_fetch_assoc($result_prod) ){
				$data = array();
				$data['produto'] 		=	$row_prod['PRODUTO'];
				$data['desc']			=	$row_prod['DESCRICAO_PRODUTO'];
				$data['nick']			=	$row_prod['APELIDO_PRODUTO'];
				$data['group']			=	$row_prod['GRUPO_PRODUTO'];
				$data['sgroup']		=	$row_prod['SUBGRUPO_PRODUTO'];
				$data['sit']			=	$row_prod['SITUACAO'];
				$data['peso']			=	$row_prod['PESO_LIQUIDO'];
				$data['class']			=	$row_prod['CLASSIFICACAO_FISCAL'];
				$data['codb']			=	$row_prod['CODIGO_BARRAS'];
				$data['collection']	=	$row_prod['COLECAO'];
				$data['buttons']		=  '<button>Remover</button><button>editar</button>';
				$datas[] = $data;
			}
		}
		ibase_free_result($result_prod);
		//echo "<pre>";
		$sql_qtd = 'select COUNT(*) as qtd from produto where empresa = '.$_POST['empresa'];
		$result = ibase_query($sql_qtd);
		$row_qtd = ibase_fetch_assoc($result);

		$sql_qtd_tot = str_replace($sql_prod, 'COUNT(*) as QTDTOT', '*');
		$result_tot = ibase_query($sql_qtd_tot);
		$row_tot = ibase_fetch_assoc($result_tot);

		$dados_json = array(
			"draw" =>  $requestData['draw'],
			"recordsTotal" => intval($row_qtd['QTD']),
			"recordsFiltered" => $row_tot['QTDTOT'],
			"data" => $datas
		);

		$sql_details = array(
		    'user' => 'SYSDBA',
		    'pass' => 'masterkey',
		    'db'   => 'DB_TESTE.fdb',
		    'host' => 'localhost'
		);

		require( 'ssp.class.php' );
 
		echo json_encode(
		    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
		//echo "</pre>";
		//exit();
	}

	function is_ajax() {
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

?>