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
	
	<title></title>
	
</head>
<body>

<?php
if(isset($_GET['adc_produto'])){
?>
<h1>Adicionar um novo produto</h1>
<hr>
<form action="produto-back.php" method="post" id="form_new">
<label>Produto</label>
<input type="text" name="produto"><br/>
<label>Empresa</label>
<select class="empresas">
  <option selected >Escolha a empresa</option>
</select>
<label>Descrição</label>
<input type="text" name="descricao"><br/>
<label>Apelido</label>
<input type="text" name="apelido"><br/>
<label>Grupo</label>
<input type="text" name="grupo"><br/>
<label>Complemento</label>
<input type="text" name="subgrupo"><br/>
<label>Situação</label>
<input type="text" name="situacao"><br/>
<label>Peso</label>
<input type="text" name="peso"><br/>
<label>Classificação</label>
<input type="text" name="calssificacao"><br/>
<label>Código de barras</label>
<input type="text" name="codigo"><br/>
<label>Coleção</label>
<input type="text" name="colecao"><br/>
<input type="submit" name="salvar" class="novo">
<input type="button" onclick="window.history.back();" value="Voltar">
</form>
<?php
}

if(isset($_GET['edita_prod'])){
	$produto = ($_GET['edita_prod']);

	$sql_prod = 'select * from produto where produto = '.$produto;
	$result_prod = ibase_query($conexao, $sql_prod);
	$row_prod = ibase_fetch_assoc($result_prod);
?>
<h1>Editando o produto <?php=$row_prod['PRODUTO']?></h1>
<hr>
<form action="produto-back.php?editaItem" method="post" id="form_edit">
<label>Produto</label>
<input type="text" name="produto" value="<?=$row_prod['PRODUTO']?>" disabled><br/>
<label>Descrição</label>
<input type="text" name="descricao" value="<?=$row_prod['DESCRICAO_PRODUTO']?>"><br/>
<label>Apelido</label>
<input type="text" name="apelido" value="<?=$row_prod['APELIDO_PRODUTO']?>"><br/>
<label>Grupo</label>
<input type="text" name="grupo" value="<?=$row_prod['GRUPO_PRODUTO']?>"><br/>
<label>Complemento</label>
<input type="text" name="subgrupo" value="<?=$row_prod['SUBGRUPO_PRODUTO']?>"><br/>
<label>Situação</label>
<input type="text" name="situacao" value="<?=$row_prod['SITUACAO']?>"><br/>
<label>Peso</label>
<input type="text" name="peso" value="<?=$row_prod['PESO_LIQUIDO']?>"><br/>
<label>Classificação</label>
<input type="text" name="calssificacao" value="<?=$row_prod['CLASSIFICACAO_FISCAL']?>"><br/>
<label>Código de barras</label>
<input type="text" name="codigo" value="<?=$row_prod['CODIGO_BARRAS']?>"><br/>
<label>Coleção</label>
<input type="text" name="colecao" value="<?=$row_prod['COLECAO']?>"><br/>
<input type="submit" name="salvar" class="edit" value="Salvar">
<input type="button" onclick="window.history.back();" value="Voltar">
</form>
<?php
}
?>
<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="http://localhost/Teste/js/produto.js"></script>
</body>
</html>