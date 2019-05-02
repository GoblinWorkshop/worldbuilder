<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
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
        $locations = Location::all()
            ->where('user_id', Auth::id());
        return view('location.index', [
            'locations' => $locations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = new Location();
        $parents = DB::table('locations')
            ->where('user_id', Auth::id())
            ->pluck('name', 'id');
        return view('location.form', [
            'location' => $location,
            'parents' => $parents
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
        $location = new Location();
        $location->name = $request->name;
        $location->parent_id = $request->parent_id;
        if (!empty($request->file('filename'))) {
            $location->filename = $request->file('filename')->store('public/locations');
        }
        $location->user_id = Auth::id();
        $location->save();
        return redirect('/locations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id)
            ->where('id', $id)// @todo Find out why....
            ->where('user_id', Auth::id())
            ->first();
        return view('location.show', [
            'location' => $location
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
        $location = Location::find($id)
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        $parents = DB::table('locations')
            ->where('user_id', Auth::id())
            ->where('id', '!=', $id)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', '!=', $id)
                    ->orWhereNull('parent_id');
            })
            ->pluck('name', 'id');
        return view('location.form', [
            'location' => $location,
            'parents' => $parents
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
        $location = Location::find($id)
            ->where('id', $id)
            ->where('user_id', Auth::id())
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
