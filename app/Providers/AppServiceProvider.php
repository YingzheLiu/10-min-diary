<?php

namespace App\Providers;

use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('maxwords', function ($attribute, $value, $parameters, $validator) {
            $words = preg_split('@\s+@i', trim($value));
            if (count($words) <= $parameters[0]) {
                return true;
            }
            return false;
        });
        Validator::replacer('maxwords', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':maxwords', $parameters[0], $message);
        });
    }
}
