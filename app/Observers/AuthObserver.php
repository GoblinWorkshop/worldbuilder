<?php

namespace App\Observers;

class AuthObserver
{
    public function creating($model) {
        $model->user_id = auth()->id();
    }
}
