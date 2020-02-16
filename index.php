<!DOCTYPE html>
<html>
<head>
	
	<!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
  <link href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css" type='text/css'>
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <!-- MDBootstrap Datatables  -->
	<title></title>
	
</head>
<body>
	<h1>Empresas</h1>
	<hr>
	<select class="empresas">
		<option selected >Escolha a empresa</option>
	</select>
	<select class="cidade" disabled="true">
		<option selected >Cidade</option>
	</select>
	<select class="grupo" disabled="true">
		<option selected >Grupo de produto</option>
	</select>
	<select class="complemento" disabled="true">
		<option selected >Complemento</option>
	</select>
	<select class="descricao" disabled="true">
		<option selected >Descrição</option>
	</select>
	<select class="apelido" disabled="true">
		<option selected >Apelido</option>
	</select>
	<select class="codigo" disabled="true">
		<option selected >Código</option>
	</select>
	<button class="lista_prod" >Listar produtos</button>
	<button class="adc_prod" onclick="window.open('http://localhost/Teste/produto.php?adc_produto','_self')">Adicionar produtos</button>
	<br/>
	<div class="produtos">
		<table class="produtos_cad table table-striped table-bordered table-sm" id="selectedColumn" >
			<thead><th>Produto</th>
		        		<th>Descrição</th>
		        		<th>Apelido</th>
		        		<th>Grupo</th>
		        		<th>Subgrupo</th>
		        		<th>Situação</th>
		        		<th>Peso</th>
		        		<th>Classificação</th>
		        		<th>Código de barras</th>
		        		<th>Coleção</th></thead>
		</table>
	</div>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="http://localhost/Teste/js/index.js"></script>
</body>
</html>