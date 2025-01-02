<?php

declare(strict_types=1);

arch('factories', function (string $factory): void {
    expect($factory)
        ->toUseTrait(Database\Factories\Concerns\RefreshOnCreate::class)
        ->toExtend(Illuminate\Database\Eloquent\Factories\Factory::class)
        ->toHaveMethod('definition')
        ->toOnlyBeUsedIn([
            'App\Models',
        ]);

})->with('factories');
