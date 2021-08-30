@extends('layouts.app')

@section('content')
<div class="">
<form method="post" enctype="multipart/form-data" action="">
		@csrf
	<br />
	<textarea name="title" cols="80" rows="3" class="" placeholder="Заголовок"></textarea>
	<br /><br />
	<textarea name="short_description" cols="80" rows="3" class="" placeholder="Краткое описание новости"></textarea>
	<textarea name="full_description" cols="80" rows="8" class="" placeholder="Новость"></textarea>
	<br />
	<input type="file" name="news_picture" id = "newsPicture" />
	<input type="submit" name="newsCreate" class="" value="Создать новость">
</form>
</div>
@component('layouts.footer')
	@endcomponent
@endsection