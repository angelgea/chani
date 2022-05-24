<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Style;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
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
        view()->composer('*', function(View $view) {
            $artists = User::where('role_id', Role::ARTIST)->get();
            $view->with('artists', $artists);
        });

        view()->composer('*', function(View $view) {
            $styles = Style::all(['id', 'name', 'image_path']);

            $view->with('styles', $styles);
        });

        Paginator::useBootstrap();
    }
}
