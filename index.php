<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<title></title>
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
		        	if(response.length >= 1){
	        			var len = response.length;
			            for(var i=0; i<len; i++){
			                var produto = response[i].produto;
			                var descricao = response[i].descricao;
			                var apelido = response[i].apelido;
			                var grupo = response[i].grupo;
			                var subgrupo = response[i].subgrupo;
			                var situacao = response[i].situacao;
			                var peso = response[i].peso;
			                var classificacao = response[i].classificacao;
			                var codigo_barra = response[i].codigo_barra;
			                var colecao = response[i].colecao;

			                var tr_str = "<tr><td class='produto'> " + produto + "</td>" +
			                	"<td class='descricao'>" + descricao + "</td>" +
			                	"<td class='apelido'>" + apelido + "</td>" +
			                	"<td class='grupo'>" + grupo + "</td>" +
			                	"<td class='subgrupo'>" + subgrupo + "</td>" +
			                	"<td class='situacao'>" + situacao + "</td>" +
			                	"<td class='peso'>" + peso + "</td>" +
			                	"<td class='classificacao'>" + classificacao + "</td>" +
			                	"<td class='codigo_barra'>" + codigo_barra + "</td>" +
			                	"<td class='colecao'>" + colecao + "</td></tr>";
			                
			                $(".produtos_cad").append(tr_str);
			            	}
		        		}
		        	}
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
		    	var empresa = $('.empresas').children(":selected").attr("id");
		    	listaProdutos(empresa);
		    });
		});
	</script>
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
	<br/>
	<div class="produtos">
		<table class="produtos_cad"></table>
	</div>
	<script type="text/javascript">
		
	</script>
</body>
</html>