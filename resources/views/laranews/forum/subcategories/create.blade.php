@extends('layouts.app')

@section('content')
<div class="">
<form method="post" action="{{ route('forum.subcategories.store', $id) }}">
		@csrf
	<br />
	<textarea name="subcategory_name" cols="80" rows="3" class="" placeholder="Заголовок"></textarea>
	<br /><br />
	<textarea name="comment" cols="80" rows="8" class=""></textarea>
	<br />
	<input type="submit" name="subcatCreate" class="" value="Создать">
</form>
</div>
@component('layouts.footer')
	@endcomponent
@endsection