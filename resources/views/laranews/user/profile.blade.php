@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card m-3">
			
				<div class="card-body">
					<img class="col-md-4" src="../{{ $profile->avatar }}"><br />
				</div>
				
				<div class="ml-4 float-left">
					<ul class="list-unstyled">
						<li class="">{{ $profile->name }}</li>
						<li>Дата регистрации: {{ $profile->created_at }}</li>
						<li>Количество сообщений:  {{ $sum }}</li>

						@if($edit)
						<li><a href="{{ route('user.edit', $profile->id) }}">Редактировать</a></li>
						@endif

					</ul>
				</div>
		
			</div>
		</div>
	</div>
</div>
@component('layouts.footer')
@endcomponent
@endsection
