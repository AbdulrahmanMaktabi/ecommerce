<?php

namespace App\Providers;

use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $generalSettings = GeneralSettings::first();

        // Set Timezone
        Config::set('app.timezone', $generalSettings->timezone);

        // Share Variable For All Views
        view::share('generalSettings', $generalSettings);
    }
}
