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
	<select class="empresas">
		<option selected >Escolha a empresa</option>
	</select>
	<select class="cidade">
		<option selected >Cidade</option>
	</select>
	<select class="grupo">
		<option selected >Grupo de produto</option>
	</select>
	<select class="complemento">
		<option selected >Complemento</option>
	</select>
	<select class=""></select>
	<button class="lista_prod">Listar produtos</button>
	<button class="adc_prod">Adicionar produtos</button>
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

<!--c. Poder filtrar os produtos por grupo de produto;
d. Poder filtrar os produtos por tipo complemento do grupo de produtos;
e. Poder filtrar os produtos por Descrição, apelido e código;-->
	<!-- SCRIPTS -->
	<!-- JQuery -->
	<!-- Datatable CSS -->


<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Datatable JS -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>


    <script type="text/javascript">
		 
		//Início para trazer as empresas cadastradas
		$(document).ready(function(){
		    
		    $.ajax({
		        url: 'back-teste.php',
		        type: 'POST',
		        dataType: 'JSON',
		        success: function(response){
		            var len = response.length;
		            for(var i=0; i<len; i++){
		                var razao = response[i].razao;
		                var empresa = response[i].empresa;

		                var tr_str = "<option class='emp"+i+" empresa' id='"+ empresa +"'>" + razao + "</option>";
		                    
		                $(".empresas").append(tr_str);
		            }

		        }
		    });

		    //trocam as empresas e trocam-se as cidades disponíveis para a qual foi selecionada
		    function mudaEmpresa(id){
		    	$(".cidade").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaEmpresa',
			        type: 'POST',
			    	data: 'id='+id,
			        dataType: 'JSON',
			        success: function(response){
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var cidade = response[i].cidade;
				                var nome_cidade = response[i].nome_cidade;

				                var tr_str = "<option id='"+cidade+"' class='cidade_op'>" + nome_cidade + "</option>";            
				                $(".cidade").append(tr_str);
				            	}

				        }
					},
					error:function (request, status, error) {
						$(".cidade").empty();
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }

		    function listaProdutos(empresa,id){
		    	 $('.produtos_cad').dataTable({
		    	 	'destroy':true,
	                'processing': true,
	                'serverSide': true,
	                'serverMethod': 'post',
	                'ajax': {
	                    'url':'back-teste.php?listaProdutos',
	                    'data': {
	                    		empresa: 'empresa',
	                    		id: 'id'
	                			}
	                },
	                'columns': [
	                    { data: 'produto' },
	                    { data: 'desc' },
	                    { data: 'nick' },
						{ data: 'group'},
						{ data: 'sgroup'},
						{ data: 'sit'},
						{ data: 'peso'},
						{ data: 'class'},
						{ data: 'codb'},
						{ data: 'collection'},
						{ data: 'buttons'}
	                ]
	            });
		    	
		    }

		    //"trigger" para quando trocar a empresa
		    $('.empresas').change(function (){
		    	$(".cidade").remove(".cidade_op");
		    	var id = $(this).children(":selected").attr("id");
		    	mudaEmpresa(id);
		    });

		    //lista de produtos
		    $('.lista_prod').click(function(){
		    	$(".produtos_cad").empty();
		    	var empresa = $('.empresas').children(":selected").attr("id");
		    	var id = $('.cidade').children(":selected").attr("id");
		    	var ativouProd = true;
		    	listaProdutos(empresa,id);
		    });

		});

	</script>
</body>
</html>