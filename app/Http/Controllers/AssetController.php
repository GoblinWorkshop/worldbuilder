<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{

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
        if (empty($request->file('filename'))) {
            return response()->json([
                'success' => false,
                'message' => __('No file added.')
            ]);
        }
        $asset = new Asset();
        $asset->filename = $request->file('filename')->store('public/assets');
        $asset->name = $request->file('filename')->getFilename();
        if (!$asset->save()) {
            return response()->json([
                'success' => false,
                'message' => __('Asset not saved.')
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => __('Asset saved.'),
            'data' => $asset
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
        $asset = Asset::where('id', $id)
            ->first();
        if (!empty($request->file('filename'))) {
            if ($asset->filename !== '') {
                Storage::delete($asset->filename);
            }
            $asset->filename = $request->file('filename')->store('public/assets');
        }
        $asset->save();
        return redirect('/assets');
    }
}
