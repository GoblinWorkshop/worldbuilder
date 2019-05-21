<?php

namespace App\Providers;

use App\Article;
use App\Asset;
use App\Location;
use App\Observers\Auth;
use App\Scopes\AuthScope;
use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        FormBuilder::component('myText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        FormBuilder::component('mySelect', 'components.form.select', ['name', 'options' => [], 'value' => null, 'attributes' => []]);
        FormBuilder::component('myFile', 'components.form.file', ['name', 'attributes' => []]);
        FormBuilder::component('myTextarea', 'components.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        FormBuilder::component('myPassword', 'components.form.text', ['name', 'attributes' => [
            'type' => 'password'
        ]]);
        FormBuilder::component('mySubmit', 'components.form.submit', ['value' => __('Save'), 'attributes' => []]);

        $this->setAuthScopes();
    }

    /**
     * Set auth checks and callbacks on the Table objects.
     */
    private function setAuthScopes() {
        // Custom auth for managing entities
        Location::observe(Auth::class);
        Article::observe(Auth::class);
        Asset::observe(Auth::class);

        Location::addGlobalScope(new AuthScope);
        Article::addGlobalScope(new AuthScope);
        Asset::addGlobalScope(new AuthScope);
    }
}
