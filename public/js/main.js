$(function(){
	$('#estados_cod_estados').change(function(){
		if( $(this).val() ) {
			$('#cod_cidades').hide();
			//$('.carregando').show();
			$.getJSON('/admin/city/cidades/'+$(this).val(), function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
				}	
				$('#cod_cidades').html(options).show();
				$('.carregando').hide();
			});
		} else {
			$('#cod_cidades').html('<option value="">-- Escolha um estado --</option>');
		}
	});
});
