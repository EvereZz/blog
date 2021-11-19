<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        
        Gate::define('admin', function (User $user){
           return $user->username === 'admin'; 
        });
        
        Blade::if('admin', function(){
            return request()->user()?->can('admin');
        });
    }
}
