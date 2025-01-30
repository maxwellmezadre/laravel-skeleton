<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureModels();
        $this->configureCommands();
        $this->configureVite();
        $this->configureUrl();
        $this->configureDates();
        $this->configureExtraPermissions();
        $this->configureStringMacros();
        $this->configureNumberMacros();
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();

        Model::unguard();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction()
        );
    }

    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    private function configureUrl(): void
    {
        URL::forceHttps();
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureExtraPermissions(): void
    {
        Gate::define('viewLogViewer', fn (?User $user): bool => true);
    }

    private function configureStringMacros(): void
    {
        Str::macro('onlyNumbers', fn (string $value): Stringable => Str::of($value)
            ->replaceMatches('/[^0-9]/', ''));

        Str::macro('toPhone', fn (string $value): Stringable => Str::onlyNumbers($value)
            ->replaceMatches('/^(\d{2})(\d{4,5})(\d{4})$/', '($1) $2-$3'));

        Str::macro('toPostalCode', fn (string $value): Stringable => Str::onlyNumbers($value)
            ->replaceMatches('/^(\d{5})(\d{3})$/', '$1-$2'));

        Str::macro('toDocument', function (string $value): Stringable {
            $value = Str::onlyNumbers($value);

            if ($value->length() <= 11) {
                return $value->replaceMatches('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4');
            }

            return $value->replaceMatches('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$23.$4/$5-$6');
        });
    }

    private function configureNumberMacros(): void
    {
        Number::macro('toMoney', fn (float $value): string => Number::format($value, precision: 2, locale: 'pt_BR'));

        Number::macro('moneyToFloat', fn (string $value): float => Str::onlyNumbers($value)
            ->replaceMatches('/^(\d+)(\d{2})$/', '$1.$2')
            ->toFloat());
    }
}
