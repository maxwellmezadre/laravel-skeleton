<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

covers(App\Models\User::class);

arch('models')
    ->expect('App\Models')
    ->toHaveMethod('casts')
    ->ignoring('App\Models\Concerns')
    ->toExtend(Model::class)
    ->ignoring('App\Models\Concerns')
    ->toOnlyBeUsedIn([
        'App\Concerns',
        'App\Console',
        'App\EventActions',
        'App\Filament',
        'App\Http',
        'App\Jobs',
        'App\Livewire',
        'App\Observers',
        'App\Mail',
        'App\Models',
        'App\Notifications',
        'App\Policies',
        'App\Providers',
        'App\Queries',
        'App\Rules',
        'App\Services',
        'App\Enums',
        'Database\Factories',
        'Database\Seeders',
    ])->ignoring('App\Models\Concerns');

arch('quantity models')
    ->expect(get_models())
    ->toHaveCount(1);

arch('ensure factories', function (string $model): void {
    /* @var HasFactory $model */
    expect($model::factory())
        ->toBeInstanceOf(Illuminate\Database\Eloquent\Factories\Factory::class);
})->with('models');

arch('ensure datetime casts', function (string $model): void {
    /* @var HasFactory $model */
    $instance = $model::factory()->create();

    expect($instance)->toBeInstanceOf(Model::class);

    $dates = collect($instance->getAttributes())
        ->filter(fn ($_, $key): bool => str_ends_with((string) $key, '_at'));

    foreach ($dates as $key => $value) {
        expect($instance->getCasts())->toHaveKey($key, 'datetime');
    }
})->with('models');

arch('ensure hashed casts', function (string $model): void {
    /* @var HasFactory $model */
    $instance = $model::factory()->create();

    expect($instance)->toBeInstanceOf(Model::class);

    $hashes = collect($instance->getAttributes())
        ->filter(fn ($_, $key): bool => str_contains((string) $key, 'pass'));

    foreach ($hashes as $key => $value) {
        expect($instance->getCasts())->toHaveKey($key, 'hashed')
            ->and($instance->getHidden())->toContain($key);
    }
})->with('models');

arch('ensure enum casts', function (string $model): void {
    /* @var HasFactory $model */
    $instance = $model::factory()->create();

    expect($instance)->toBeInstanceOf(Model::class);

    $columns = collect($instance->getAttributes())->keys();

    foreach ($columns as $column) {

        if (config('database.default') === 'sqlite') {
            $createTableSQL = DB::selectOne(<<<SQL
                SELECT sql
                FROM sqlite_master
                WHERE type = 'table'
                    AND name = '{$instance->getTable()}'
            SQL);

            if (str($createTableSQL->sql)->contains('"'.$column.'" varchar check ("'.$column.'" in')) {
                expect($instance->getCasts())->toHaveKey($column)
                    ->and($instance->getCasts()[$column])->toBeEnum();
            }

            continue;
        }

        if (Schema::getColumnType($instance->getTable(), $column) === 'enum') {
            expect($instance->getCasts())->toHaveKey($column)
                ->and($instance->getCasts()[$column])->toBeEnum();
        }
    }
})->with('models');
