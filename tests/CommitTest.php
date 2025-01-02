<?php

declare(strict_types=1);

test('correct commit message', function (): void {
    File::put('tests/commit_message.txt', 'feat: add new feature');

    $result = Process::run('./vendor/bin/captainhook hook:commit-msg tests/commit_message.txt');

    File::delete('tests/commit_message.txt');

    expect($result->successful())->toBeTrue();
});

test('incorrect commit message', function (): void {
    File::put('tests/commit_message.txt', 'add new feature');

    $result = Process::run('./vendor/bin/captainhook hook:commit-msg tests/commit_message.txt');

    File::delete('tests/commit_message.txt');

    expect($result->failed())->toBeTrue();
});
