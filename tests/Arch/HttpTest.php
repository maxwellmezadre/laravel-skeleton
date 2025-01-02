<?php

declare(strict_types=1);

arch('controllers')
    ->expect('App\Http\Controllers')
    ->toExtendNothing()
    ->toExtend(App\Http\Controllers\Controller::class)
    ->not->toBeUsed()
    ->ignoring(App\Http\Controllers\Controller::class);

arch('middleware')
    ->expect('App\Http\Middleware')
    ->not->toBeUsed();

arch('requests')
    ->expect('App\Http\Requests')
    ->toExtend(Illuminate\Foundation\Http\FormRequest::class)
    ->toHaveMethod('rules');
