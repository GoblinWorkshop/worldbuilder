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
        $this->app->bind('path.public', function() {
            return base_path(env('PUBLIC_DIR', 'public'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
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
