<?php
	
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

	if($url == 'produtoPag'){
		if(is_ajax()){
			$sql_grupo = "select GRUPO_PRODUTO from produto GROUP BY GRUPO_PRODUTO ";
			$resultado_grupo = ibase_query($conexao, $sql_grupo);
			if($resultado_grupo){
				while ($row_grupo = ibase_fetch_object($resultado_grupo)) {
					 foreach ($row_grupo as $key => $value) {
					 	$grupo = $value;
					 }
				        $return_arr[] = array(
				         	"grupo" => $grupo
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
				 	switch($key){
				 		case 'CIDADE':
				 			$cidade = $value;
				 			break;
				 		case 'DESCRICAO_CIDADE':
							$nome_cidade = $value;
							break;
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

	if($url == 'trocaCidade'){
		$sql_grupo = "select GRUPO_PRODUTO from produto p join cidade c on p.empresa = c.empresa where p.empresa = ".$_POST['idEmpresa']. " AND  c.cidade = ".$_POST['idCidade']." GROUP BY GRUPO_PRODUTO";
		$resultado_grupo = ibase_query($conexao, $sql_grupo);
		if($resultado_grupo){
			while ($row_grupo = ibase_fetch_object($resultado_grupo)) {
				 foreach ($row_grupo as $key => $value) {
				 	$grupo = $value;
				 }
			        $return_arr[] = array(
			         	"grupo" => $grupo
			        );
		    }
		}
		print_r(json_encode($return_arr));
	}

	if($url == 'trocaGrupo'){
		$sql_sgrupo = "select SUBGRUPO_PRODUTO from produto p join cidade c on p.empresa = c.empresa where p.empresa = ".$_POST['idEmpresa']. " AND  c.cidade = ".$_POST['idCidade']." AND p.GRUPO_PRODUTO = ".$_POST['idGrupo']." GROUP BY SUBGRUPO_PRODUTO";
		$resultado_sgrupo = ibase_query($conexao, $sql_sgrupo);
		if($resultado_sgrupo){
			while ($row_sgrupo = ibase_fetch_object($resultado_sgrupo)) {
				 foreach ($row_sgrupo as $key => $value) {
				 	$sgrupo = $value;
				 }
			        $return_arr[] = array(
			         	"sgrupo" => $sgrupo
			        );
		    }
		}
		print_r(json_encode($return_arr));
	}


	if($url == 'trocaComplemento'){
		$sql_desc = "select DESCRICAO_PRODUTO from produto p join cidade c on p.empresa = c.empresa where p.empresa = ".$_POST['idEmpresa']. " AND  c.cidade = ".$_POST['idCidade']." AND p.GRUPO_PRODUTO = ".$_POST['idGrupo']." AND p.SUBGRUPO_PRODUTO = ".$_POST['idComplemento']." GROUP BY DESCRICAO_PRODUTO";
		$resultado_desc = ibase_query($conexao, $sql_desc);
		if($resultado_desc){
			while ($row_desc = ibase_fetch_object($resultado_desc)) {
				 foreach ($row_desc as $key => $value) {
				 	$desc = $value;
				 }
			        $return_arr[] = array(
			         	"desc" => $desc
			        );
		    }
		}
		print_r(json_encode($return_arr));
	}

	if($url == 'trocaDescricao'){
		$sql_nick = "select APELIDO_PRODUTO from produto p join cidade c on p.empresa = c.empresa where p.empresa = ".$_POST['idEmpresa']. " AND  c.cidade = ".$_POST['idCidade']." AND p.GRUPO_PRODUTO = ".$_POST['idGrupo']." AND p.SUBGRUPO_PRODUTO = ".$_POST['idComplemento']." AND p.DESCRICAO_PRODUTO like '%".$_POST['idDesc']."%' GROUP BY APELIDO_PRODUTO";
		$resultado_nick = ibase_query($conexao, $sql_nick);
		if($resultado_nick){
			while ($row_nick = ibase_fetch_object($resultado_nick)) {
				 foreach ($row_nick as $key => $value) {
				 	$nick = $value;
				 }
			        $return_arr[] = array(
			         	"nick" => $nick
			        );
		    }
		}
		print_r(json_encode($return_arr));
	}

	if($url == 'trocaApelido'){
		$sql_cbar = "select CODIGO_BARRAS from produto p join cidade c on p.empresa = c.empresa where p.empresa = ".$_POST['idEmpresa']. " AND  c.cidade = ".$_POST['idCidade']." AND p.GRUPO_PRODUTO = ".$_POST['idGrupo']." AND p.SUBGRUPO_PRODUTO = ".$_POST['idComplemento']." AND p.DESCRICAO_PRODUTO like '%".$_POST['idDesc']."%' AND APELIDO_PRODUTO = ".$_POST['idApelido']." GROUP BY CODIGO_BARRAS";
		$resultado_cbar = ibase_query($conexao, $sql_cbar);
		if($resultado_sgrupo){
			while ($row_cbar = ibase_fetch_object($resultado_cbar)) {
				 foreach ($row_cbar as $key => $value) {
				 	$cbar = $value;
				 }
			        $return_arr[] = array(
			         	"cbar" => $cbar
			        );
		    }
		}
		print_r(json_encode($return_arr));
	}

	if($url == 'listaProdutos'){
		$columns = array(
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
		//if($requestData['order'][0]['dir'] == )
		$limit = 'FIRST '.$requestData['length'].' SKIP '.$requestData['start']. ' ';

		$sql_prod = 'select '.$limit.'* from produto p join cidade c on p.empresa = c.empresa where p.empresa = '.$_POST['empresa'].' AND c.cidade = '.$_POST['id']. ' ';
		

		if( !empty($requestData['search']['value']) ) {
			$sql_prod .= " AND ( PRODUTO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR DESCRICAO_PRODUTO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR APELIDO_PRODUTO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR GRUPO_PRODUTO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR SUBGRUPO_PRODUTO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR SITUACAO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR PESO_LIQUIDO LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR CLASSIFICACAO_FISCAL LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR CODIGO_BARRAS LIKE '".strtoupper($requestData['search']['value'])."%' ";
			$sql_prod .= " OR COLECAO LIKE '".strtoupper($requestData['search']['value'])."%')";
		}

		if($_POST['grupo'] != null)
			$sql_prod .= ' AND p.GRUPO_PRODUTO = ' . $_POST['grupo'];
		if($_POST['complemento'] != null)
			$sql_prod .= ' AND p.SUBGRUPO_PRODUTO = ' . $_POST['complemento'];
		if($_POST['descricao'] != null)
			$sql_prod .= " AND p.DESCRICAO_PRODUTO like '%" . $_POST['descricao'] ."%' ";
		if($_POST['apelido'] != null)
			$sql_prod .= ' AND p.APELIDO_PRODUTO = '. $_POST['apelido'];
		//faz a ordenação
		$sql_prod.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";
		//echo $sql_prod;
		$result_prod = ibase_query($conexao, $sql_prod)or die(ibase_errmsg());
		if($result_prod){
			$datas = array();
			while ( $row_prod = ibase_fetch_assoc($result_prod) ){
				$data = array();
				$data['produto'] 		=	$row_prod['PRODUTO'];
				$data['desc']			=	$row_prod['DESCRICAO_PRODUTO'];
				$data['nick']			=	$row_prod['APELIDO_PRODUTO'];
				$data['group']			=	$row_prod['GRUPO_PRODUTO'];
				$data['sgroup']			=	$row_prod['SUBGRUPO_PRODUTO'];
				$data['sit']			=	$row_prod['SITUACAO'];
				$data['peso']			=	$row_prod['PESO_LIQUIDO'];
				$data['class']			=	$row_prod['CLASSIFICACAO_FISCAL'];
				$data['codb']			=	$row_prod['CODIGO_BARRAS'];
				$data['collection']		=	$row_prod['COLECAO'];
				$data['buttons']		=  "<button class='removeItem' id=".$row_prod['PRODUTO'].">Remover</button><button class='editaItem' id=".$row_prod['PRODUTO'].">Editar</button>";
				$datas[] = $data;
			}
		}
		//echo "<pre>";
		$sql_qtd = 'select COUNT(*) as qtd from produto where empresa = '.$_POST['empresa'];
		$result = ibase_query($sql_qtd);
		$row_qtd = ibase_fetch_assoc($result);

		$limit .= '*';
		$order = "ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir'] ;
		$sql_qtd_tot = str_replace($limit, 'COUNT(*) as QTDTOT', $sql_prod);
		$sql_qtd_tot = str_replace($order, '',$sql_qtd_tot);
		//echo $sql_qtd_tot;
		$result_tot = ibase_query($sql_qtd_tot);
		$row_tot = ibase_fetch_assoc($result_tot);

		$dados_json = array(
			"draw" =>  $requestData['draw'],
			"recordsTotal" => intval($row_qtd['QTD']),
			"recordsFiltered" => $row_tot['QTDTOT'],
			"data" => $datas
		);

		
		echo json_encode( $dados_json );
		//echo "</pre>";
		//exit();
	}

	function is_ajax() {
	  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

?>