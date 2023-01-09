@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@foreach($showSubcat as $item)
					<div class="card m-3"> 
						<div class="card-body"> 
							<div class="container-rem">
								<div class="card-body"> 
										<h2 class="font-weight-bold"> {{ $item->name}}</h2>
										<a href="{{ route('admin.forum.subcategories.comments.index', [$id, $item->id ]) }}"><h2 class="font-weight-bold pb-3"> {{ $item->subcategory_name}}</h2></a>
										<form action = "{{ route('admin.forum.subcategories.destroy', $item->id) }}" method="post">
											<input type="submit" class="float-right" value="Удалить тему">
											@method('delete')
   											@csrf
										</form>
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

