<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('tags', function ($attribute, $value, $parameters, $validator) {

            if (!is_array($value)) return false;

            foreach ($value as $tagId) {
                if (!is_numeric($tagId))
                    return false;
            }

            return true;
        });

        Validator::replacer('tags', function ($message, $attribute, $rule, $parameters){
            return sprintf("Problème avec l'attribut %s", $attribute);
        });
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
