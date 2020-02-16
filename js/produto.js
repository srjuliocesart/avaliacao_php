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

		                var tr_str = "<option class='emp"+i+" empresa' id='"+ empresa +"' name='empresa' value='"+empresa+"'>" + razao + "</option>";
		                    
		                $(".empresas").append(tr_str);
		            }

		        }
		    });

	$('#form_edit').submit(function(e){
		var disabled = $("#form_edit").find(':input:disabled').removeAttr('disabled');
		e.preventDefault();
		var serializeDados = $('#form_edit').serialize();
		disabled.attr('disabled','disabled');
		$.ajax({
            url: 'produto-back.php?editaItem',
            dataType: 'html',
            type: 'POST',
            data: serializeDados,
            success: function(response) {
               alert('Você atualizou o produto');
            },
            error: function(request, status, error) {
                alert("Algo deu errado, por favor revise os campos");
            }
        });
	});

	$('#form_new').submit(function(e){
		var idEmpresa = $('.empresas').children("option:selected").attr("id");
		e.preventDefault();
		var serializeDados = $('#form_new').serialize();
		$.ajax({
            url: 'produto-back.php?novoItem',
            dataType: 'html',
            type: 'POST',
            data: serializeDados+'&empresa='+idEmpresa,
            success: function(response) {
               alert('Você criou um novo produto');
            },
            error: function(request, status, error) {
                alert("Algo deu errado, por favor revise os campos");
            }
        });
	});
});