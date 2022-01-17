@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card m-3">
			
				<div class="card-body">
					<img class="col-md-4" src="{{ $cabinet->avatar }}"><br />
				</div>
				
				<div class="ml-4 float-left">
					<ul class="list-unstyled">
						<li class="">{{ $cabinet->name }}</li>
						<li>Дата регистрации: {{ $cabinet->created_at }}</li>
						<li>Количество сообщений:  {{ $sum }}</li>

						@if($edit)
						<li><a href="{{ route('user.edit', $cabinet->id) }}">Редактировать</a></li>
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
