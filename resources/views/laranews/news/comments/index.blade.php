@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/newsComments.js') }}"></script>
@endpush

@section('content')
	<div class="container">
		 
			<div class="card-body col-md-10 mx-auto d-block"> 
				<div class="card p-3 m-1">
					<h2 class="font-weight-bold"> {{ $showNewsById->title}} </h2>
					<p>{{ $showNewsById->created_at}}</p>
					<h4 class="text-xs-left pl-0"> {{ $showNewsById->short_description}} </h4>
					<img class="img-fluid rounded carousel-inner" src="{{$showNewsById->news_picture}}">
					<h4 class="text-xs-left pt-4 pl-0"> {{ $showNewsById->full_description}} </h4>
					<a href="{{ route('news.index') }}">
					<h4>Вернуться</h4> 
				</a>
			</div>
			@include('laranews.news.comments.includes.comments')
			</div> 
		</div> 
	</div> 
</div>
@endsection