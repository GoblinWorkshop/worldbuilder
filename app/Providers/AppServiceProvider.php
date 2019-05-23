<?php

namespace App\Providers;

use App\Article;
use App\Asset;
use App\Character;
use App\Location;
use App\Observers\ArticleObserver;
use App\Observers\AuthObserver;
use App\Organisation;
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
        $this->setArticleScopes();
    }

    /**
     * Set auth checks and callbacks on the Table objects.
     */
    private function setAuthScopes() {
        // Custom auth for managing entities
        Article::observe(AuthObserver::class);
        Asset::observe(AuthObserver::class);
        Character::observe(AuthObserver::class);
        Location::observe(AuthObserver::class);
        Organisation::observe(AuthObserver::class);

        Article::addGlobalScope(new AuthScope);
        Asset::addGlobalScope(new AuthScope);
        Character::addGlobalScope(new AuthScope);
        Location::addGlobalScope(new AuthScope);
        Organisation::addGlobalScope(new AuthScope);
    }

    /**
     * Set the article scopes. This scope will automaticly add articles for the created models
     */
    private function setArticleScopes() {
        Location::observe(ArticleObserver::class);
        Character::observe(ArticleObserver::class);
        Organisation::observe(ArticleObserver::class);
    }
}
