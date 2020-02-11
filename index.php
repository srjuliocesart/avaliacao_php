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
	<h1>Empresas</h1>
	<select class="empresas">
		<option selected >Escolha a empresa</option>
	</select>
	<select class="cidade">
		<option selected >Cidade</option>
	</select>
	<button class="lista_prod">Listar produtos</button>
	<button class="adc_prod">Adicionar produtos</button>
	<br/>
	<div class="produtos">
		<table class="produtos_cad table table-striped table-bordered table-sm" id="selectedColumn" >
		</table>
	</div>


	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script src="js/addons/dataTables.min.js" type="text/javascript"></script>	

    <script type="text/javascript">
		 
		//Início para trazer as empresas cadastradas
		$(document).ready(function(){
			$('#selectedColumn').DataTable({
				'bSort': true,
				'columnDefs': [{
					orderable: true
				}],
        'aoColumns': [ 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }, 
              { sWidth: "20%", bSearchable: false, bSortable: true }
        ],
        
        "scrollCollapse": true,
        "info":           true,
        "paging":         true
			});
			$('.dataTables_length').addClass('bs-select');
		    
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

		    function listaProdutos(empresa){
		    	$.ajax({
			        url: 'back-teste.php?listaProdutos',
			        type: 'POST',
			    	data: 'empresa='+empresa,
			        dataType: 'JSON',
			        success: function(response){
	        			console.log(response);
		        	//if(response.length >= 1){
		        		 //testes sendo efetuados com dynatable para filtro feito direto com bootstrap
		        		 /*$('.table').dynatable({
		        		 	dataset: {
								records: response
							}
		        		 });*/
		        		var head = "<thead><th>Produto</th>" +
		        		"<th>Descrição</th>" +
		        		"<th>Apelido</th>" +
		        		"<th>Grupo</th>" +
		        		"<th>Subgrupo</th>" +
		        		"<th>Situação</th>" +
		        		"<th>Peso</th>" +
		        		"<th>Classificação</th>" +
		        		"<th>Código de barras</th>" +
		        		"<th>Coleção</th></thead><tbody>";
		        		$(".produtos_cad").append(head);
	        			var len = response.length;
			            $.each(response, function(i, val){
			                var produto = val.produto;
			                var descricao = val.desc;
			                var apelido = val.nick;
			                var grupo = val.group;
			                var subgrupo = val.sgroup;
			                var situacao = val.sit;
			                var peso = val.peso;
			                var classificacao = val.class;
			                var codigo_barra = val.codb;
			                var colecao = val.collection;

			                var tr_str = "<tr><td class='produto'> " + produto + "</td>" +
			                	"<td class='descricao'>" + descricao + "</td>" +
			                	"<td class='apelido'>" + apelido + "</td>" +
			                	"<td class='grupo'>" + grupo + "</td>" +
			                	"<td class='subgrupo'>" + subgrupo + "</td>" +
			                	"<td class='situacao'>" + situacao + "</td>" +
			                	"<td class='peso'>" + peso + "</td>" +
			                	"<td class='classificacao'>" + classificacao + "</td>" +
			                	"<td class='codigo_barra'>" + codigo_barra + "</td>" +
			                	"<td class='colecao'>" + colecao + "</td>" +
			                	"<td class='remover' id="+ i +"><button>REMOVER</button><button>EDITAR</button></td></tr>"
			                
			                $(".produtos_cad").append(tr_str);
			            	});
			            $(".produtos_cad").append("</tbody>");
		        		}
		        	//}
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
		    	var ativouProd = true;
		    	listaProdutos(empresa);
		    });

		});
		
		//$('.dataTables_length').addClass('bs-select');
	</script>
</body>
</html>