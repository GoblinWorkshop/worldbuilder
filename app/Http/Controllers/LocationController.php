<?php

namespace App\Http\Controllers;

use App\Article;
use App\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $locations = Location::get();
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
        $parents = Location::pluck('name', 'id');
        $articles = Article::pluck('name', 'id');
        return view('location.form', [
            'location' => $location,
            'parents' => $parents,
            'articles' => $articles
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
        $location->article_id = $request->article_id;
        if (!empty($request->file('filename'))) {
            $location->filename = $request->file('filename')->store('public/locations');
        }
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
        $location = Location::where('id', $id)
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
        $location = Location::where('id', $id)
            ->first();
        $parents = Location::where('id', '!=', $id)
            ->where(function ($query) use ($id) {
                $query->where('parent_id', '!=', $id)
                    ->orWhereNull('parent_id');
            })
            ->pluck('name', 'id');
        $articles = Article::pluck('name', 'id');
        return view('location.form', [
            'location' => $location,
            'parents' => $parents,
            'articles' => $articles
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
        $location = Location::where('id', $id)
            ->first();
        $location->name = $request->name;
        $location->parent_id = $request->parent_id;
        $location->article_id = $request->article_id;
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
