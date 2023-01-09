$(document).ready(function() {
    //Динамическое добавление комментария к новости
	$("#addComment").click(function(e){
		e.preventDefault();
        let id = $("#id").val();
        let comment = $("#comment").val();
        let _token = $("input[name=_token]").val();

		$.ajax({
			url: "{{ route('news.comments.store')}}",
			type: "POST",
			data: {id: id, comment: comment, _token: _token},
			success: function() {
            	$("#ulcom").load(location.href + " #ulcom");
           		$("#form-comments")[0].reset();
      		}
		});
	});
});
