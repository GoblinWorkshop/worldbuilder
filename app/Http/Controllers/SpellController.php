<?php

namespace App\Http\Controllers;

use App\Character;
use App\Http\Controllers\Controller;
use App\Spell;
use Intervention\Image\Exception\NotFoundException;

class SpellController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view($name)
    {
        $spell = Spell::get($name);
        if (empty($spell)) {
            throw new NotFoundException(__('Spell not found.'));
        }
    }

    public function stat_block($name) {
        $spell = Spell::get($name);
        if (empty($spell)) {
            throw new NotFoundException(__('Spell not found.'));
        }
        return view('spell.stat-block', [
            'spell' => $spell
        ]);
    }
}
