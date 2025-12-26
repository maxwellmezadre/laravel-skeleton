<?php

declare(strict_types=1);

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

arch('controllers')
    ->expect('App\Http\Controllers')
    ->toExtendNothing()
    ->toExtend(Controller::class)
    ->not->toBeUsed()
    ->ignoring(Controller::class);

arch('middleware')
    ->expect('App\Http\Middleware')
    ->not->toBeUsed();

arch('requests')
    ->expect('App\Http\Requests')
    ->toExtend(FormRequest::class)
    ->toHaveMethod('rules');
