<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\SidebarComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;


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
        View::composer('*', SidebarComposer::class);
        Hash::extend('plain',function(){
            return new class{
                public function make($value, array $options =[]){
                    return $value;
                }

                public function check($value, $hashedValue, array $options=[]){
                    return $value === $hashedValue;

                }

                public function needsRehash($hashedValue, array $options=[]){
                    return false;
                }
            };
        });
    }
}
