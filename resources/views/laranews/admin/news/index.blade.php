@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card m-3"> 
					<div class="card-body"> 
						<a href="{{ route('admin.news.create') }}">
							<h3 class="font-weight-bold pb-3 text-center">Добавить новость</h3>
						</a>
					</div>
				</div>
				@foreach($paginate as $item)
					<div class="card m-3"> 
						<div class="card-body"> 
							<div class="container-rem">
								<div class="card-body"> 
										<h2 class="font-weight-bold pb-3"> {{ $item->title}}</h2> 
									<p>{{ $item->created_at}}</p>
									<a href="{{ route('admin.news.comments.index', $item->id) }}">
										<img class="img-fluid rounded carousel-inner" src="{{ $item->news_picture}}"> 
									</a>
									<h4 class="text-xs-left pt-4 pl-0 col-10"> {{ $item->short_description}} </h4>
									<a href="{{ route('admin.news.comments.index', $item->id) }}">
										<h4 class="float-left">Читать далее</h4> 
									</a>
									<form action = "{{ route('admin.news.destroy', $item->id) }}" method="post">
										<input type="submit" class="float-right" value="Удалить новость">
										@method('delete')
   										@csrf
									</form>
										
									</a>
								</div> 
							</div>
						</div>
					</div>
				@endforeach
				@if($paginate->total() > $paginate->count())
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card m-3 align-items-center"> 
								<div class="card-body"> 
									{{ $paginate->onEachSide(5)->links('vendor.pagination.bootstrap-4') }}
								</div>
							</div>
						</div>
					</div>
				@endif
		</div>
	</div>
</div>
	@component('layouts.footer')
	@endcomponent
@endsection

