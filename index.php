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


<!--e. Poder filtrar os produtos por Descrição, apelido e código;-->
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
		    	$(".grupo").empty();
		    	$(".complemento").empty();
		    	$(".descricao").empty();
		    	$(".apelido").empty();
		    	$(".codigo").empty();	    	
		    	$.ajax({
			        url: 'back-teste.php?trocaEmpresa',
			        type: 'POST',
			    	data: 'id='+id,
			        dataType: 'JSON',
			        success: function(response){
	        			$(".cidade").append("<option>=====================</option>");
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var cidade = response[i].cidade;
				                var nome_cidade = response[i].nome_cidade;

				                var tr_str = "<option id='"+cidade+"' class='cidade_op'>" + nome_cidade + "</option>";            
				                $(".cidade").append(tr_str);
				            	}

				        }
				        $(".cidade").prop("disabled", false);
				        //$(".cidade").trigger("change");
					},
					error:function (request, status, error) {
						$(".cidade").append("<option>=====================</option>");
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }

		    function mudaCidade(cidade, empresa){
		    	$(".grupo").empty();
		    	$(".complemento").empty();
		    	$(".descricao").empty();
		    	$(".apelido").empty();
		    	$(".codigo").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaCidade',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa,
			        dataType: 'JSON',
			        success: function(response){
	        			$(".grupo").append("<option>=====================</option>");
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var grupo = response[i].grupo;
				                var tr_str = "<option id='"+grupo+"' class='grupo_op'>" + grupo + "</option>";            
				                $(".grupo").append(tr_str);
				            	}
				        }
				        $(".grupo").prop("disabled", false);
				        //$(".grupo").trigger("change");
					},
					error:function (request, status, error) {
						$(".grupo").append("<option>=====================</option>");
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }

		    function mudaGrupo(cidade, empresa, grupo){
		    	$(".complemento").empty();
		    	$(".descricao").empty();
		    	$(".apelido").empty();
		    	$(".codigo").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaGrupo',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".complemento").append("<option>=====================</option>");
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var sgrupo = response[i].sgrupo;
				                var tr_str = "<option id='"+sgrupo+"' class='complemento_op'>" + sgrupo + "</option>";
				                $(".complemento").append(tr_str);
				            	}
				        }
				        $(".complemento").prop("disabled", false);
				        //$(".complemento").trigger("change");
					},
					error:function (request, status, error) {
						$(".complemento").append("<option>=====================</option>");
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }

		    function mudaComplemento(cidade, empresa, grupo, complemento){
		    	$(".descricao").empty();
		    	$(".apelido").empty();
		    	$(".codigo").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaComplemento',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo+'&idComplemento='+complemento,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".descricao").append("<option>=====================</option>");
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var desc = response[i].desc;
				                var tr_str = "<option id='"+desc+"' class='descricao_op'>" + desc + "</option>";
				                $(".descricao").append(tr_str);
				            	}
				        }
				        $(".descricao").prop("disabled", false);
				        //$(".complemento").trigger("change");
					},
					error:function (request, status, error) {
						$(".descricao").append("<option>=====================</option>");
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }

		    function mudaDesc(cidade, empresa, grupo, complemento, descricao){
		    	$(".apelido").empty();
		    	$(".codigo").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaDescricao',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo+'&idComplemento='+complemento+'&idDesc='+descricao,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".apelido").append("<option>=====================</option>");
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var nick = response[i].nick;
				                var tr_str = "<option id='"+nick+"' class='apelido_op'>" + nick + "</option>";
				                $(".apelido").append(tr_str);
				            	}
				        }
				        $(".apelido").prop("disabled", false);
				        //$(".complemento").trigger("change");
					},
					error:function (request, status, error) {
						$(".apelido").append("<option>=====================</option>");
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }


		    function mudaApelido (cidade, empresa, grupo, complemento, descricao, apelido){
		    	$(".codigo").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaApelido',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo+'&idComplemento='+complemento+'&idDesc='+descricao+'&idApelido='+apelido,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".codigo").append("<option>=====================</option>");
			        	if(response.length >= 1){
				            var len = response.length;
				            for(var i=0; i<len; i++){
				                var codigo = response[i].codigo;
				                var tr_str = "<option id='"+codigo+"' class='codigo_op'>" + codigo + "</option>";
				                $(".codigo").append(tr_str);
				            	}
				        }
				        $(".codigo").prop("disabled", false);
				        //$(".complemento").trigger("change");
					},
					error:function (request, status, error) {
						$(".codigo").append("<option>=====================</option>");
	                	alert("Não há uma cidade cadastrada para essa empresa");
	            	}
			    });
		    }

		    function listaProdutos(empresa,id){
		    	var tr_str = '<th>Produto</th>'+
		        		'<th>Descrição</th>'+
		        		'<th>Apelido</th>'+
		        		'<th>Grupo</th>'+
		        		'<th>Subgrupo</th>'+
		        		'<th>Situação</th>'+
		        		'<th>Peso</th>'+
		        		'<th>Classificação</th>'+
		        		'<th>Código de barras</th>'+
		        		'<th>Coleção</th>';
		        $('.thead').append(tr_str);
		    	 $('.produtos_cad').dataTable({
		    	 	'destroy':true,
	                'processing': true,
	                'serverSide': true,
	                'serverMethod': 'post',
	                'ajax': {
	                    'url':'back-teste.php?listaProdutos',
	                    'data': {
	                    		empresa: empresa,
	                    		id: id
	                			}
	                },
	                'columns': [
	                    { data: 'produto', title: 'Produto' },
	                    { data: 'desc', title: 'Descrição' },
	                    { data: 'nick', title: 'Apelido' },
						{ data: 'group', title: 'Grupo'},
						{ data: 'sgroup', title: 'Subgrupo'},
						{ data: 'sit', title: 'Situação'},
						{ data: 'peso', title: 'Peso'},
						{ data: 'class', title: 'Classificação'},
						{ data: 'codb', title: 'Código de barras'},
						{ data: 'collection', title: 'Coleção'},
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

		    $('.cidade').change(function (){
		    	$(".grupo").remove(".grupo_op");
		    	var idCidade = $(this).children(":selected").attr("id");
		    	var idEmpresa = $('.empresas').children("option:selected").attr("id");
		    	mudaCidade(idCidade, idEmpresa);
		    });

		    $('.grupo').change(function (){
		    	$(".complemento").remove(".complemento_op");
		    	var idGrupo = $(this).children(":selected").attr("id");
		    	var idCidade = $('.cidade').children("option:selected").attr("id");
		    	var idEmpresa = $('.empresas').children("option:selected").attr("id");
		    	mudaGrupo(idCidade, idEmpresa, idGrupo);
		    });

		     $('.complemento').change(function (){
		    	$(".descricao").remove(".desc_op");
		    	var idComplemento = $(this).children(":selected").attr("id");
		    	var idGrupo = $('.grupo').children("option:selected").attr("id");
		    	var idCidade = $('.cidade').children("option:selected").attr("id");
		    	var idEmpresa = $('.empresas').children("option:selected").attr("id");
		    	mudaComplemento(idCidade, idEmpresa, idGrupo, idComplemento);
		    });

		    $('.descricao').change(function (){
		    	$(".apelido").remove(".nick_op");
		    	var idDesc = $(this).children(":selected").attr("id");
		    	var idGrupo = $('.grupo').children("option:selected").attr("id");
		    	var idCidade = $('.cidade').children("option:selected").attr("id");
		    	var idEmpresa = $('.empresas').children("option:selected").attr("id");
		    	var idComplemento = $('.complemento').children("option:selected").attr("id");
		    	mudaDesc(idCidade, idEmpresa, idGrupo, idComplemento, idDesc);
		    });

		    $('.apelido').change(function (){
		    	$(".codigo").remove(".codigo_op");
		    	var idApelido = $(this).children(":selected").attr("id");
		    	var idDesc = $('.descricao').children("option:selected").attr("id");
		    	var idGrupo = $('.grupo').children("option:selected").attr("id");
		    	var idCidade = $('.cidade').children("option:selected").attr("id");
		    	var idEmpresa = $('.empresas').children("option:selected").attr("id");
		    	var idComplemento = $('.complemento').children("option:selected").attr("id");
		    	mudaApelido(idCidade, idEmpresa, idGrupo, idComplemento, idDesc, idApelido);
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