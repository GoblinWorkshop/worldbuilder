<?php

namespace App\Observers;

class Auth
{
    public function creating($model) {
        $model->user_id = auth()->id();
    }
}
