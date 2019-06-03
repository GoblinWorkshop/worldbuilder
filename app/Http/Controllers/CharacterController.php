<?php

namespace App\Http\Controllers;

use App\Character;
use App\Http\Controllers\Controller;
use App\Location;
use App\Organisation;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\Collection;

class CharacterController extends Controller
{
    use CrudTrait;

    public $crudConfig = [
        'create' => [
            'relatedModels' => [
                'organisations' => 'App\\Organisation',
                'locations' => 'App\Location'
            ]
        ]
    ];

    public function __construct()
    {
        $this->middleware('auth');
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
        $character->location_id = $request->location_id;
        if (!empty($request->file('filename'))) {
            $character->filename = $request->file('filename')->store('public/characters');
        }
        $character->save();
        $character->organisations()->sync($request->input('organisations'));
        $character->locations()->sync($request->input('locations'));
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
        $organisations = Organisation::get()
            ->pluck('name', 'id');
        $locations = Location::get()
            ->pluck('name', 'id');
        return view('character.form', [
            'character' => $character,
            'characters' => $characters,
            'organisations' => $organisations,
            'locations' => $locations
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
        $character->location_id = $request->location_id;
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
        $character->organisations()->sync($request->input('organisations'));
        $character->locations()->sync($request->input('locations'));
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
