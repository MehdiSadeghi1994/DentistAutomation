<?php

namespace App\Providers;

use App\Group;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

include app_path() . '/jdf.php';

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
        $new_messages_count = tr_num(Message::where('new', '=', '1')->count(), 'fa');
        
        View::share('new_messages_count', $new_messages_count);
    }
}
