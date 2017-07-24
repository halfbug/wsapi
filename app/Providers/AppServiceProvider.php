<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // // bug fix : https://laravel-news.com/laravel-5-4-key-too-long-error 
 +        Schema::defaultStringLength(191);
        $notify = array();
        if (\Auth::guest()) {
            $guest_ip = (strpos(request()->ip(), ':'))? strstr(request()->ip(),':',true) : request()->ip();
            $notify = \App\File::where([['user_id',null],['ipaddress',$guest_ip],['status', 3]])->get();
        }
        view()->share('notify',$notify);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
