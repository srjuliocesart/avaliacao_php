<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<title></title>
	<script type="text/javascript">
		 

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

		    $('.empresas').change(function (){
		    	$(".cidade").remove(".cidade_op");
		    	var id = $(this).children(":selected").attr("id");
		    	mudaEmpresa(id);
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
	</div>
	<script type="text/javascript">
		
	</script>
</body>
</html>