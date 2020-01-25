<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();

        return view('properties.index')->with(compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);
        $data = $request->input();
        $data['user_id'] = auth()->user()->id;
        $newData = Property::create($data);
        if ($newData) {
            session()->flash('success', 'Property was successfully added.');
        } else {
            session()->flash('error', 'property could not be added. please try again');
            return back();
        }
        //
        return redirect()->route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('properties.show')->with(compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('properties.edit')->with(compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        if ($property->update($request->input())) {
            session()->flash('success', 'Property was successfully updated');
        } else {
            session()->flash('error', 'Could not update record');
            return back();
        }
        return redirect()->route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if ($property->delete()) {
            session()->flash('success', 'property was successfully deleted!');
        } else {
            session()->flash('error', 'property could not be deleted');
        }
        return back();
    }
}
