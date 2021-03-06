<?php

namespace App\Http\Controllers;

use App\Character;
use App\Http\Controllers\Controller;
use App\Location;
use App\Organisation;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\Collection;

class CharacterController extends Controller
{
    use CrudTrait;

    public $crudConfig = [
        'edit' => [
            'relatedModels' => [
                'organisations' => 'App\\Organisation',
                'characters' => 'App\\Character',
                'locations' => 'App\Location',
                'races' => 'App\Race'
            ]
        ],
        'create' => [
            'relatedModels' => [
                'organisations' => 'App\\Organisation',
                'characters' => 'App\\Character',
                'locations' => 'App\Location',
                'races' => 'App\Race'
            ]
        ]
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @todo make a private api request routing
     */
    public function api_index()
    {
        if (empty(request('q'))) {
            return response()->json([]);
        }
        $characters = Character::query()
            ->select([
                'id',
                'name'
            ])
            ->where('name', 'like', request('q') . '%')
            ->limit(10)
            ->get();
        return response()->json($characters->toArray());
    }

    public function stat_block($id)
    {
        $character = Character::query()
            ->where('id', $id)
            ->firstOrFail();
        return view('character.stat-block', [
            'character' => $character
        ]);
    }

    /**
     * Generate a view for all relations of all characters
     */
    public function relations()
    {
        $characters = Character::with('relations')
            ->get();
        $relations = []; // This must be doable through the collections...
        foreach ($characters as $character) {
            foreach ($character->relations as $relation) {
                $relations[] = $relation;
            }
        }
        return view('character.relations', [
            'characters' => $characters,
            'relations' => $relations
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
        $request->validate([
            'name' => 'required|min:1|max:255'
        ]);
        $character = new Character($request->toArray());
        if (!empty($request->file('filename'))) {
            $character->filename = $request->file('filename')->store('public/characters');
        }
        $character->save();
        $character->organisations()->sync($request->input('organisations'));
        $character->locations()->sync($request->input('locations'));
        return redirect('/characters');
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
        $request->validate([
            'name' => 'required|min:1|max:255'
        ]);
        $character = Character::where('id', $id)
            ->first();
        $character->fill($request->all());
        if (!empty($request->file('filename'))) {
            if ($character->filename !== '') {
                Storage::delete($character->filename);
            }
            $character->filename = $request->file('filename')->store('public/characters');
        }
        $character->update();
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
        if ($request->get('article.body')) {
            
        }
        return redirect('/characters');
    }
}
