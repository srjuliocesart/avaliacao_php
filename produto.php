<?php


$conexao = ibase_connect("localhost:C:/Program Files (x86)/EasyPHP-Devserver-17/eds-www/Teste/BD/DB_TESTE.fdb","SYSDBA","masterkey") or die( 'Erro ao conectar: ' . ibase_errmsg() );
?>
<!DOCTYPE html>
<html>
<head>
	
	<!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <!-- MDBootstrap Datatables  -->
  <link href="css/addons/datatables.min.css" rel="stylesheet">

  <style>
    table.produtos_cad thead .sorting:after,
    table.produtos_cad thead .sorting:before,
    table.produtos_cad thead .sorting_asc:after,
    table.produtos_cad thead .sorting_asc:before,
    table.produtos_cad thead .sorting_asc_disabled:after,
    table.produtos_cad thead .sorting_asc_disabled:before,
    table.produtos_cad thead .sorting_desc:after,
    table.produtos_cad thead .sorting_desc:before,
    table.produtos_cad thead .sorting_desc_disabled:after,
    table.produtos_cad thead .sorting_desc_disabled:before {
    bottom: .5em;
    }
  </style>
	
	<title></title>
	
</head>
<body>

<?php
if($_GET['adc_produto']){
?>
<input type="" name="">

<?php
}

if($_GET['edita_produto']){
	$produto = $_GET['id'];

	$sql_prod = 'select * from produto where produto = '.$produto;
	$result_prod = ibase_query($conexao, $sql_prod);
	$row_prod = ibase_fetch_object($result_prod);

}
