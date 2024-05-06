<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Projet;

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
    public function boot()
    {
        View::composer('*', function ($view) {
            $projetsTerrestres = Projet::whereHas('plateforme', function ($query) {
                $query->where('type', '=', 'Terrestre');
            })->get();
            
            $projetsDrones = Projet::whereHas('plateforme', function ($query) {
                $query->where('type', '=', 'Drone');
            })->get();
            
            $view->with('projetsTerrestres', $projetsTerrestres)
                 ->with('projetsDrones', $projetsDrones);
        });
        Paginator::useBootstrap();
    }
}
