@extends('layouts.app-pages')
@section('title', 'Андрей Тищенко - Веб-разработчик с опытом 7 лет')

@section('content')

    <div id="content">
        <div class="ic">More Website Templates @ TemplateMonster.com - April 15, 2013!</div>
        <div id="slider">
            <div class="container_12">
                <div class="grid_12">
                <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
                    @foreach($sliders as $slider)
                        <div data-src="storage/{{ $slider->image }}">
                            <div class="camera_caption fadeIn">
                                <h2>{{ $slider->title }}</h2>
                                    {{ $slider->description }}
                                    <p><a href="{{ $slider->btn_link }}" class="button">{{ $slider->btn_name }}</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
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
                    <div class="block">
                        <div class="grid_8">
                            <div class="grid-inner">
                            <h2>Привет!</h2>
                                <div class="wrapper">
                                    <figure class="img-indent"><img src="images/image1.jpg" alt=""></figure>
                                    Меня зовут Андрей, я веб-разработчик с опытом 7 лет, знаю следующие языки программирования: PHP, JavaScript, Golang
                                </div>
                                <p class="pad">Мои скиллы: </p>
                                @if($skills)
                                    @foreach($skills as $skill)
                                        <span class="badge"><b>{{ $skill->name }}</b> ({{ $skill->lvl }}%)</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="grid_4">
                            <h2>Мой девиз</h2>
                            <div class="testimonial-block">
                                <em>Делай хорошо, плохо не делай</em><p><strong>— Андрей Тищенко</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper">
                    <div class="grid_12">
                        <h2 class="h-pad">Мои клиенты</h2>
                        <ul class="clients-list">
                            <li><a href="#"><img src="images/client1.png" alt=""></a></li>
                            <li><a href="#"><img src="images/client2.png" alt=""></a></li>
                            <li><a href="#"><img src="images/client3.png" alt=""></a></li>
                            <li><a href="#"><img src="images/client4.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>			
        </div>
    </div>

@endsection