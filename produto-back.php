<?php

	$conexao = ibase_connect($_SERVER['HTTP_HOST'].":".__DIR__. "/BD/DB_TESTE.fdb","SYSDBA","masterkey") or die( 'Erro ao conectar: ' . ibase_errmsg() );

	$url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY);


	if($url == 'apagaItem'){
		$sql_del = "DELETE FROM PRODUTO WHERE PRODUTO = ".$_POST['idItem'];
		$result = ibase_query($conexao,$sql_del);
		if($result)
			echo 1;
	}

	if($url == 'editaItem'){
		$prod = strip_tags($_POST['produto']);
		$desc = strip_tags($_POST['descricao']);
		$empresa = strip_tags($_POST['empresa']);
		$nick = strip_tags($_POST['apelido']);
		$grupo = strip_tags($_POST['grupo']);
		$sgrupo = strip_tags($_POST['subgrupo']);
		$sit = strip_tags($_POST['situacao']);
		if(strip_tags($_POST['peso']) != null)
			$peso = 'PESO_LIQUIDO = '. strip_tags($_POST['peso']).', ';
		$class = strip_tags($_POST['calssificacao']);
		if(strip_tags($_POST['codigo']) != null)
			$codigo = 'CODIGO_BARRAS = '. strip_tags($_POST['codigo']).', ';
		$colecao = strip_tags($_POST['colecao']);

		$sql_edit = "UPDATE PRODUTO SET EMPRESA = ".$empresa.", DESCRICAO_PRODUTO = '". $desc ."', APELIDO_PRODUTO = ". $nick.", GRUPO_PRODUTO=". $grupo .", SUBGRUPO_PRODUTO = ". $sgrupo .", SITUACAO = '". $sit ."', ". $peso ." CLASSIFICACAO_FISCAL = ". $class .",  ". $codigo ." COLECAO = ". $colecao ." WHERE PRODUTO = ". $prod;
		//echo $sql_edit;
		$result = ibase_query($conexao,$sql_edit);
		if($result)
			echo 1;
	}

	if($url == 'novoItem'){
		$prod = strip_tags($_POST['produto']);
		$empresa = strip_tags($_POST['empresa']);
		$desc = strip_tags($_POST['descricao']);
		$nick = strip_tags($_POST['apelido']);
		$grupo = strip_tags($_POST['grupo']);
		$sgrupo = strip_tags($_POST['subgrupo']);
		$sit = strip_tags($_POST['situacao']);
		if(strip_tags($_POST['peso']) != null)
			$peso = strip_tags($_POST['peso']);
		else
			$peso = 'NULL';
		$class = strip_tags($_POST['calssificacao']);
		if(strip_tags($_POST['codigo']) != null)
			$codigo = strip_tags($_POST['codigo']);
		else
			$codigo = 'NULL';
		$colecao = strip_tags($_POST['colecao']);
		$sql_new = "INSERT INTO PRODUTO (EMPRESA, PRODUTO, DESCRICAO_PRODUTO, APELIDO_PRODUTO, GRUPO_PRODUTO, SUBGRUPO_PRODUTO, SITUACAO, PESO_LIQUIDO, CLASSIFICACAO_FISCAL, CODIGO_BARRAS, COLECAO) VALUES (".$empresa.", '".$prod."', '".$desc."', '".$nick."', ".$grupo.", ".$sgrupo.", '".$sit."', ".$peso.", '".$class."', ".$codigo.", ".$colecao.")";
		$result = ibase_query($conexao,$sql_new);
		if($result)
			echo 1;
	}