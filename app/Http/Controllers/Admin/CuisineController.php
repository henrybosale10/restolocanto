<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CuisineTypeRequest;
use App\Models\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cuisines = Cuisine::all();
        return view('admin.cuisine.index', compact('cuisines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.cuisine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CuisineTypeResquest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuisineTypeRequest $request)
    {
        //
        $image = $request->file('image')->store('public/cuisine');
        Cuisine::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        return to_route('admin.cuisine.index')->with('success', 'Categories créée avec succès.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuisine $cuisine)
    {
        //
        return view('admin.cuisine.edit',compact('cuisine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CuisineTypeResquest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuisine  $cuisine)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $cuisine->image;
        if ($request -> hasFile('image')) {
            Storage::delete($cuisine->image);
            $image = $request->file('image')->store('public/cuisine');
        }
        $cuisine->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);
        return to_route('admin.cuisine.index')->with('success', 'Categorie modifier avec succès.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuisine $cuisine)
    {
        //
        Storage::delete(($cuisine->image));
        $cuisine->delete();

        return to_route('admin.cuisine.index')->with('success', 'Categorie Supprimée avec succès.');;
    }
}
