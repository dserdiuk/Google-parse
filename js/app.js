$( "#search" ).change(function() {
	var text = $(this).val();
	$.ajax({
		url: '/search.php?text='+text,
		beforeSend: function(){
			$('#result').text('Waiting...');
		},
		success: function(response){
			$('#result').empty();
			var resp = JSON.parse(response);
			$.each(resp,function(index,value){
				$('#result').append(value+'<br>');
			});
		}
	});
});