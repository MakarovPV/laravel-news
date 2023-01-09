			<div class="comments">
					<h3 class="title-comments m-1">Комментарии</h3>
				
						<ul class="list-group m-1 " id ="ulcom">
							@foreach($showComments as $comment)
								<li class="list-group-item col-12">
									@if($comment->is_banned == 1)
									<h4>
										<strong>
										 Пользователь, оставивший этот комментарий, приказал долго жить
										</strong> 
									</h4>
								</li>
								@else
									<h4>
										<strong>
											{{ $comment->name }}
										</strong> 
									</h4>
									<div>{{ $comment->published_at }}</div>
									<h5>{{ $comment->comment }}</h5>
								</li>
								@endif
							@endforeach
						</ul> 
				
					<div class="card m-1"> 
						<div class="card-block col-12"> 
							@if( $auth )
								@if( $banCheck->is_banned == 1 )
									<div>Ваш аккаунт заблокирован</div>
								@else
								<form method="POST" name="comments" class="pt-4" id="form-comments" action="">
									@csrf 
									<div class="form-group"> 
										<input type="hidden" name="user_id" id="user_id" value="{{ $auth }}">
										<input type="hidden" name="id" id="id" value="{{$id}}">
										<textarea name="comment" id="comment" placeholder="Ваш комментарий" class="form-control"></textarea>
									</div>
									<div class="form-group"> 
										<button type="submit" id="addComment" class="btn btn-primary">Добавить комментарий</button>
									</div>
								</form>
								@endif
							@else
							<div>Оставлять комментарии могут только зарегистрированные пользователи</div>
							@endif
						</div>
					</div>