<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Collective\Html\FormBuilder;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        FormBuilder::component('myText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        FormBuilder::component('mySelect', 'components.form.select', ['name', 'options' => [], 'value' => null, 'attributes' => []]);
        FormBuilder::component('myFile', 'components.form.file', ['name', 'attributes' => []]);
        FormBuilder::component('myTextarea', 'components.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        FormBuilder::component('myPassword', 'components.form.text', ['name', 'attributes' => [
            'type' => 'password'
        ]]);
        FormBuilder::component('mySubmit', 'components.form.submit', ['value' => __('Save'), 'attributes' => []]);
    }
}
