<?php

declare(strict_types=1);

use Illuminate\Mail\Mailable;

arch('mailables')
    ->expect('App\Mail')
    ->toHaveConstructor()
    ->toExtend(Mailable::class);
