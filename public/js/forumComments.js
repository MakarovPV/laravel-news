$(document).ready(function() {
    //Динамическое добавление комментария на форуме
	$("#add-comment").click(function(e){
		e.preventDefault();
		let catId = $("#id").val();
		let comment = $("#comment").val();
		let _token = $("input[name=_token]").val();

		$.ajax({
			url: "{{ route('forum.subcategories.store') }}",
			type: "POST",
			data: {catId: catId, comment: comment, _token: _token},
			success: function() {
            	$("#show-comment").load(location.href + " #show-comment");
           		$("#form-comment")[0].reset();
      		}
		});
	});
});
