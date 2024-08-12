<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        // $this->configureRateLimiting();

        // $this->routes(function () {
        //     Route::middleware('web')
        //         ->group(base_path('routes/web.php'));

        //     Route::middleware('api')
        //         ->prefix('api')
        //         ->group(base_path('routes/api.php'));

        //     Route::middleware('panel')
        //         ->prefix('panel')
        //         ->group(base_path('routes/panel.php'));
        // });
    }
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapPanelRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */


     public function mapWebRoutes()
     {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

     }

     public function mapApiRoutes()
     {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));

     }

     public function mapPanelRoutes()
     {
        Route::prefix('panel')
            ->middleware(['web','auth'])
            ->namespace("{$this->namespace}\panel")
            ->group(base_path('routes/panel.php'));

     }


    // protected function configureRateLimiting()
    // {
    //     RateLimiter::for('api', function (Request $request) {
    //         return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    //     });
    // }
}
