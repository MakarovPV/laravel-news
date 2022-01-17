@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/forumComments.js') }}"></script>
@endpush



@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card m-3">
			@foreach($firstComment as $item)
				<div class="card-body"> 
						<div class="container-rem position-relative">
							<div class="card-body float-left border-right h-100 w-25 d-inline-block position-absolute">
								<img class="col-md-10" src="{{$item->avatar}}"> 
								<h4 class="m-3"> {{ $item->name}}</h4> 
							</div> 
							<div class="card-body ml-5"> 
								<div class = "ml-5">
									<div class = "ml-3">
										<h3 class="m-3 ml-5 font-weight-bold"> {{ $item->subcategory_name}}</h3>
										<h4 class="m-3 ml-5"> {{ $item->subcategory_first_comment}}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				
					@endforeach
				</div>

			<div id="show-comment">
			@foreach($showComments as $item)
				<div class="card m-3"> 
					<div class="card-body"> 
						<div class="container-rem position-relative">
							<div class="card-body float-left border-right h-100 w-25 d-block position-absolute"> 
								<img class="col-md-10" src="{{$item->avatar}}"> 
								<h4 class="m-3"> {{ $item->name}}</h4> 
							</div> 
							<div class="card-body ml-5"> 
								<div class = "ml-5">
									<div class = "ml-5">
										<h4 class="m-3 ml-3"> {{ $item->comment}}</h4>
									</div>
								</div>
							</div> 
						</div>
					</div>
				</div>
			@endforeach
			</div>

					<div class="card m-3"> 
						<div class="card-block col-12"> 
							@if( $auth )
							<form method="POST" name="comments" class="pt-4" action="" id="form-comment">
								@csrf 
								<div class="form-group"> 
									<textarea name="comment" id="comment" placeholder="Ваш комментарий" class="form-control"></textarea>
									<input type="hidden" name="id" id="id" value="{{ $catId }}">
								</div>
								<div class="form-group"> 
									<button type="submit" class="btn btn-primary" id="add-comment">Добавить комментарий</button>
								</div>
							</form>
							@else
								<div>Оставлять комментарии могут только зарегистрированные пользователи</div>
							@endif
						</div>
					</div>


			</div>
		</div>
	</div>
</div>
	@component('layouts.footer')
	@endcomponent
@endsection