<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
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
        view()->composer(['web.*'],function ($view){

            $empresaGeneral = DB::table('empresa')->first();
            $contactoGeneral = DB::table('contacto')->first();

            $menuGeneral = Menu::query()
                ->where('pariente',0)
                ->where('estado',1)
                ->orderBy('posicion')
                ->get();




            $view->with(compact('empresaGeneral','contactoGeneral','menuGeneral'));


        });

        view()->composer(['panel.*'],function ($view){

            $empresaGeneral = DB::table('empresa')
                ->first();


            $view->with(compact('empresaGeneral'));

        });
    }
}
