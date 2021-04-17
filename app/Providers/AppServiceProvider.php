<?php

namespace App\Providers;

use App\Model\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settingContact = Setting::where('scope','contact')->get();
        $settingSocial = Setting::where('scope','social')->get();
        view()->share('contacts', $settingContact);

        view()->share('socials', $settingSocial);
    }
}