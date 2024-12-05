<?php

use Illuminate\Support\Facades\Route;

use App\Models\Skill;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 123;
});

Route::get('/skills/{category}', function ($category) {
    $title = "Навыки в категории $category";

    $skills = Skill::where('category', $category)->get();

    return view('skills')
        ->with('title', $title)
        ->with('skills', $skills);
});

Route::get('/skills', function () {
    $title = 'Навыки';

    $skills = Skill::all();

    return view('skills')
        ->with('title', $title)
        ->with('skills', $skills);
});

Route::get('/portfolio', function () {
    $title = 'Портфолио Terricon';

    $jobs = [
        [
            'name' => 'Разработка сайта для ЖК',
            'price' => 1000,
            'val' => '$'
        ],
        [
            'name' => 'Разработка сайта для Клиники',
            'price' => 1500,
            'val' => '$'
        ],
        [
            'name' => 'Разработка сайта для Terricon',
            'price' => 2000,
            'val' => '$'
        ]
    ];

    return view('portfolio')
        ->with('title', $title)
        ->with('jobs', $jobs);
});

Route::get('/news', function () {
    $title = 'Новости';

    return view('news')->with('title', $title);
}); 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
