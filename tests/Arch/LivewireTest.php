<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use Livewire\Component;

arch('livewire components')
    ->expect('App\Livewire')
    ->toBeClasses()
    ->ignoring('App\Livewire\Concerns')
    ->toExtend(Component::class)
    ->ignoring('App\Livewire\Concerns')
    ->toHaveMethod('render')
    ->ignoring('App\Livewire\Concerns')
    ->toOnlyBeUsedIn([
        'App\Http\Controllers',
        'App\Http\Livewire',
        AppServiceProvider::class,
    ])
    ->ignoring('App\Livewire\Concerns')
    ->not->toUse(['redirect', 'to_route', 'back']);

arch('livewire concerns')
    ->expect('App\Livewire\Concerns')
    ->toBeTraits();
