$(document).ready(function() {
	$("#addComment").on("click", function(){
		$.ajax({
			url: "route('news/{id}')",
			type: "POST",
			data: {id: 2},
			
			error: function (msg) {
				alert('Ошибка');
			}
		});
	});
});