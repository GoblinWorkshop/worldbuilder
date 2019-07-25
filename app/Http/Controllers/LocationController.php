<?php

namespace App\Http\Controllers;

use App\Location;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    use CrudTrait;

    public $crudConfig = [
        'create' => [
            'relatedModels' => [
                'parents' => 'App\\Location'
            ]
        ],
        'edit' => [
            'relatedModels' => [
                'parents' => 'App\\Location'
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
    public function api_index() {
        if (empty(request('q'))) {
            return response()->json([]);
        }
        $locations = Location::query()
            ->select([
                'id',
                'name'
            ])
            ->where('name', 'like', request('q') .'%')
            ->limit(10)
            ->get();
        return response()->json($locations->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location();
        $location->name = $request->name;
        $location->parent_id = $request->parent_id;
        if (!empty($request->file('filename'))) {
            $location->filename = $request->file('filename')->store('public/locations');
        }
        $location->save();
        return redirect('/locations');
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
        $location = Location::where('id', $id)
            ->first();
        $location->name = $request->name;
        $location->parent_id = $request->parent_id;
        if (!empty($request->file('filename'))) {
            if ($location->filename !== '') {
                Storage::delete($location->filename);
            }
            $location->filename = $request->file('filename')->store('public/locations');
        }
        $location->save();
        return redirect('/locations');
    }
}
