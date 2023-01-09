@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
	<div class="card m-3">
		
		<div class="card-body">
			<img class="float-left col-md-4 " src="/{{ $profile->avatar }}">
			<div class="ml-5 float-left">
				<div class="">
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<form method="post">
						@csrf
						Введите старый пароль: <br />
						<input type="password" name="oldPassword"/><br /><br />
						Введите новый пароль: <br />
						<input type="password" name="newPassword"/><br /><br />
						<input type="submit" name="newPassSubmit" value="Сохранить"/>
					</form>
					<a href="{{ route('user.getProfile', $profile->id) }}">Вернуться</a>
				</div>
			</div>
		</div>
		
		<div class="card-body float-left h-100">
			<form method="post" enctype="multipart/form-data" action="">
				@csrf
			<label for="avaLoadName" class="btn btn-primary" style =display:block, width:31%;>Выбрать фотографию</label><br />
			
			<input type="file" name="avaLoadName" id = "avaLoadName" style =display:none; />
			<input type="submit" name="submitAvaLoad" value="Загрузить фотографию" class="btn btn-primary" style =display:block, width:31%; />
		</form>
	</div>
	
		</div>
		
	</div>
</div></div></div>
	@component('layouts.footer')
	@endcomponent
@endsection


		
	