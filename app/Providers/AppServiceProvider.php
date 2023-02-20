<?php

namespace App\Providers;
use App\Blade\Directives\RoleDirective;
use Illuminate\Support\Facades\Blade;
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
        //
        //Blade::directive('role', [RoleDirective::class, 'handle']);
        /*Blade::if('role', function ($role) {
           return auth()->check() && auth()->user()->role == $role;
        });*/
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });
    }
}
