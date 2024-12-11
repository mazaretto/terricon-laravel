@extends('layouts.app-pages')
@section('title', 'Блог')

@section('content')

<div id="content">
	<div class="ic">More Website Templates @ TemplateMonster.com - April 15, 2013!</div>
	<div class="inner">
		<div class="container_12">
			<div class="wrapper">
				<div class="grid_12">
					<div class="block">
						<div class="info-block">
							<a href="http://bayguzin.ru/assets/files/2014/08/biznes.zip" rel="nofollow" class="link">Click here</a> for more info about this free website template created by Template 
Monster. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.
						</div>
						<a href="http://bayguzin.ru/assets/files/2014/08/biznes.zip" class="button" rel="nofollow">Click here!</a>
					</div>
				</div>
			</div>
			<div class="wrapper">
				<div class="grid_12">
						<div class="wrapper">
							<div class="grid_8 alpha">
								<div class="grid-inner">
								<h2 class="h-pad h-indent">Последние посты</h2>

								@if($posts)
									@foreach($posts as $post)
										<div class="block">
											<div class="post">
												<div class="wrapper">
													<div class="info">
														<div class="wrapper">
															<div class="date">
																<span>may</span><strong>15</strong>
															</div>
															<a href="#"><strong>{{ $post->name }}</strong></a><br>
														Author: <a href="#"><strong>{{ $post->user_id }}</strong></a>
														</div>
														
													</div>
													<div class="comments">
														No comments<span></span>
													</div>
												</div>
												<figure><a href="#"><img src="{{ $post->preview }}" alt=""></a><figure>
													<p>{{ $post->description }}</p>
													<a href="#" class="button1">Подробнее</a>
											</div>
										</div>
									@endforeach
								@endif
								
							</div>
						</div>
							<div class="grid_4 omega">
								<div class="block block-pad">
									<h2>Категории</h2>
									<ul class="list">	
										@if($categories)
											@foreach($categories as $category)
												<li><a href="{{ route('pages', [
													'name' => 'blog',
													'category_id' => $category->id
												]) }}">{{ $category->name }}</a></li>
											@endforeach
										@endif
									</ul>
								</div>
								<a href="{{ route('pages', 'blog') }}" class="button1">Сбросить</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

@endsection
