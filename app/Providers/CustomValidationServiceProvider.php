<?php

namespace ProgramPlanner\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('credit_points', function($attribute, $value, $parameters, $validator) {
           $baseCreditPoints = 15.0;
            return $value % $baseCreditPoints == 0;
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
