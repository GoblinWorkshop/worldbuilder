<?php

namespace App\Http\Controllers;

use App\Organisation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
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
        $organisations = Organisation::get();
        return view('organisation.index', [
            'items' => $organisations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisation = new Organisation();
        return view('organisation.form', [
            'item' => $organisation
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
        $organisation = new Organisation();
        $organisation->name = $request->name;
        $organisation->type = $request->type;
        $organisation->save();
        return redirect('/organisations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organisation = Organisation::where('id', $id)
            ->first();
        return view('organisation.show', [
            'item' => $organisation
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
        $organisation = Organisation::where('id', $id)
            ->first();
        return view('organisation.form', [
            'item' => $organisation
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
        $organisation = Organisation::where('id', $id)
            ->first();
        $organisation->name = $request->name;
        $organisation->type = $request->type;
        $organisation->save();
        return redirect('/organisations');
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
