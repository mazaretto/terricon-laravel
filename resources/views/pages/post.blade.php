@extends('layouts.app-pages')
@section('title', "Блог / $post->name")

@section('content')

<div id="content">
	<div class="ic">More Website Templates @ TemplateMonster.com - April 15, 2013!</div>
	<div class="inner">
		<div class="container_12">
			<div class="wrapper">
				<div class="grid_12">
					<div class="block">
						<div class="info-block">
							<a href="https://t.me/mazaretto" rel="nofollow" class="link">Закажите</a> разработку у меня и получите скидку 15% на все услуги до Нового года.
                                *Только для новых клиентов.
						</div>
						<a href="https://t.me/mazaretto" class="button" rel="nofollow">Заказать</a>
					</div>
				</div>
			</div>
			<div class="wrapper">
				<div class="grid_12">
						<div class="wrapper">
							<div class="grid_12 alpha">
								<div class="grid-inner">
                                <a href="{{ route('pages', 'blog') }}">Назад</a>
								<h2 class="h-pad h-indent">{{ $post->name }} </h2>

								<div class="block">
                                <div class="post">
                                    <div class="wrapper">
                                        <div class="info">
                                            <div class="wrapper">
                                                <div class="date">
                                                    <span>{{ date('M', strtotime($post->created_at)); }}</span>
													<strong>{{ date('d', strtotime($post->created_at)); }}</strong>
                                                </div>
                                            Автор: <strong>{{ \App\Models\User::getName($post->user_id) }}</strong>
                                            </div>
                                            
                                        </div>
                                        <div class="comments">
                                            ({{ $post->getComments()->count(); }}) комментариев <span></span>
                                        </div>
                                    </div>
                                    <figure><a href="#"><img src="{{ $post->preview }}" alt=""></a><figure>
                                        <p>{{ $post->description }}</p>
                                </div>

								<hr/>
								<h2>Комментарии</h2>
								<form action="{{ route('addComment') }}" method="POST">
									@csrf

									<input type="hidden" name="post_id" value="{{ $post->id }}" />
									<input type="text" placeholder="Введите ваше имя" name="author" />
									<textarea name="description" placeholder="Описание"></textarea>
									<button type="submit">Отправить</button>
								</form>
								@foreach($post->getComments() as $comment)
									<p>
										<b>{{ $comment->author }}</b>: 
										{{ $comment->description }} (<small>{{ $comment->created_at }}</small>)
									</p>
								@endforeach

                            </div>
								
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

@endsection
