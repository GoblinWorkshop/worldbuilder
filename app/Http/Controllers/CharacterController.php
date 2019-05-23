<?php

namespace App\Http\Controllers;

use App\Character;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\Collection;

class CharacterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::get();
        return view('character.index', [
            'characters' => $characters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $character = new Character();
        return view('character.form', [
            'character' => $character
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $character = new Character();
        $character->name = $request->name;
        $character->type = $request->type;
        if (!empty($request->file('filename'))) {
            $character->filename = $request->file('filename')->store('public/characters');
        }
        $character->save();
        return redirect('/characters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $character = Character::where('id', $id)
            ->first();
        return view('character.show', [
            'character' => $character
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $character = Character::where('id', $id)
            ->first();
        $characters = Character::where('id', '!=', $id)
            ->pluck('name', 'id');
        return view('character.form', [
            'character' => $character,
            'characters' => $characters
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $character = Character::where('id', $id)
            ->first();
        $character->name = $request->name;
        $character->type = $request->type;
        if (!empty($request->file('filename'))) {
            if ($character->filename !== '') {
                Storage::delete($character->filename);
            }
            $character->filename = $request->file('filename')->store('public/characters');
        }
        $character->save();
        foreach ($request->input('relation') as $relation) {
            if (isset($relation['id']) && empty($relation['character_2_id'])) {
                $character->relations()->where('id', $relation['id'])->delete();
                continue;
            }
            if (empty($relation['character_2_id'])) {
                continue;
            }
            $character->relations()->updateOrCreate($relation);
        }
        return redirect('/characters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
