@extends('layouts.app')

@section('content')
<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@foreach($showCategories as $item)
					<div class="card m-3"> 
						<div class="card-body"> 
							<div class="container-rem">
								<div class="card-body"> 
										<a href="{{ route('admin.forum.subcategories.index', $item->id) }}"><h2 class="font-weight-bold pb-3"> {{ $item->category_name}}</h2></a> 
									
								</div> 
							</div>
						</div>
					</div>
				@endforeach
		</div>
	</div>
</div>
	@component('layouts.footer')
	@endcomponent
@endsection

