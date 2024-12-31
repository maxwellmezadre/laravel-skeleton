<?php

declare(strict_types=1);

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {

    /* @var Command $this */
    /* @phpstan-ignore-next-line */
    $this->comment(Inspiring::quote());

})->purpose('Display an inspiring quote')->hourly();
