@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@foreach($paginate as $item)
					<div class="card m-3"> 
						<div class="card-body"> 
							<div class="container-rem">
								<div class="card-body"> 
										<h2 class="font-weight-bold pb-3"> {{ $item->title}}</h2> 
									<p>{{ $item->created_at}}</p>
									<a href="{{ route('news.comments.index', $item->id) }}">
										<img class="img-fluid rounded carousel-inner" src="{{ $item->news_picture}}"> 
									</a>
									<h4 class="text-xs-left pt-4 pl-0 col-10"> {{ $item->short_description}} </h4>
									<a href="{{ route('news.comments.index', $item->id) }}">
										<h4>Читать далее</h4> 
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
									{{ $paginate->onEachSide(3)->links('vendor.pagination.bootstrap-4') }}
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

