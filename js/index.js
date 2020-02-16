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
	        			$(".cidade").append("<option>Cidade</option>");
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
		    	$.ajax({
			        url: 'back-teste.php?trocaCidade',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa,
			        dataType: 'JSON',
			        success: function(response){
	        			$(".grupo").append("<option>Grupo</option>");
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
	                	alert("Nenhum grupo encontrado");
	            	}
			    });
		    }

		    function mudaGrupo(cidade, empresa, grupo){
		    	$(".complemento").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaGrupo',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".complemento").append("<option>Complemento</option>");
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
	                	alert("Nenhum subgrupo encontrado");
	            	}
			    });
		    }

		    function mudaComplemento(cidade, empresa, grupo, complemento){
		    	$(".descricao").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaComplemento',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo+'&idComplemento='+complemento,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".descricao").append("<option>Descrição</option>");
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
	                	alert("Nenhum nome encontrado");
	            	}
			    });
		    }

		    function mudaDesc(cidade, empresa, grupo, complemento, descricao){
		    	$(".apelido").empty();
		    	$.ajax({
			        url: 'back-teste.php?trocaDescricao',
			        type: 'POST',
			    	data: 'idCidade='+cidade+'&idEmpresa='+empresa+'&idGrupo='+grupo+'&idComplemento='+complemento+'&idDesc='+descricao,
			        dataType: 'JSON',
			        success: function(response){
			    		$(".apelido").append("<option>Apelido</option>");
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
	                	alert("Nenhum apelido encontrado");
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
			    		$(".codigo").append("<option>Codigo</option>");
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
	                	alert("Nenhum código de barras encontrado");
	            	}
			    });
		    }

		    function listaProdutos(empresa,id, grupo=null, complemento=null, descricao=null, apelido=null){
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
	                    		id: id,
	                    		grupo : grupo,
	                    		complemento: complemento,
	                    		descricao: descricao,
	                    		apelido: apelido
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
		    	var nick = $('.apelido').children(":selected").attr("id");
		    	var desc = $('.descricao').children("option:selected").attr("id");
		    	var grupo = $('.grupo').children("option:selected").attr("id");    	
		    	var complemento = $('.complemento').children("option:selected").attr("id");
		    	var ativouProd = true;
		    	listaProdutos(empresa,id,grupo,complemento,desc,nick);
		    });

		    $('body').on('click','.editaItem',function(){
		    	var idItem = $(this).attr("id");
				window.open('http://localhost/Teste/produto.php?edita_prod='+idItem,'_self');
		    });

		    $('body').on('click','.removeItem',function(){
		    	var idItem = $(this).attr("id");
		    	var empresa = $('.empresas').children(":selected").attr("id");
		    	var id = $('.cidade').children(":selected").attr("id");
		    	var nick = $('.apelido').children(":selected").attr("id");
		    	var desc = $('.descricao').children("option:selected").attr("id");
		    	var grupo = $('.grupo').children("option:selected").attr("id");    	
		    	var complemento = $('.complemento').children("option:selected").attr("id");
		    	$.ajax({
			        url: 'produto-back.php?apagaItem',
			        type: 'POST',
			    	data: 'idItem='+idItem,
			        dataType: 'JSON',
			        success: function(response){
			        	alert('Produto removido com sucesso')
			        	listaProdutos(empresa,id,grupo,complemento,desc,nick);
				        //$(".complemento").trigger("change");
					},
					error:function (request, status, error) {
						alert("Não foi possível remover o item");
	            	}
			    });
		    });

		});