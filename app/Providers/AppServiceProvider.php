<?php

namespace App\Providers;

use App\Models\Configuration;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        try {
            $query = Configuration::all();


            view()->composer('*', function ($view) use ($query) {
                $user = Auth::user();
                $company = $query->where('label', "=", "CompanyName")->first();

                $guard_admin = Auth::guard("admin")->check();
                $guard_client = Auth::guard("web")->check();
                $logo = $query->where('label', "=", "logo")->first();
                $background = $query->where('label', "=", "background")->first();
                $view->with("company", $company);
                $view->with('user', $user);
                $view->with('guard_web', $guard_client);
                $view->with('guard_admin', $guard_admin);
                $view->with('background', $background->value);
                $view->with('logo', $logo->value);
            });
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
