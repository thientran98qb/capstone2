<?php

namespace App\Providers;

use App\Components\Recusive;
use App\Model\Category;
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
        $recusive = new Recusive(Category::all());
        $htmlOptionSearchHeader = $recusive->recusiveCategory($parentId = '');
        View::share('htmlOptionSearchHeader', $htmlOptionSearchHeader);
        $settingContact = Setting::where('scope','contact')->get();
        $settingSocial = Setting::where('scope','social')->get();
        view()->share('contacts', $settingContact);

        view()->share('socials', $settingSocial);
    }
}