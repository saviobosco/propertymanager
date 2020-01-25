<?php

namespace App\Http\Controllers;

use App\Property;
use App\SMSGateWay;
use App\Tenant;
use Illuminate\Http\Request;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::with(['property'])
            ->get();
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::pluck('name', 'id');

        return view('tenants.create', compact('properties'));
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
            'property_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'lease_starts' => 'required',
            'lease_ends' => 'required',
        ]);

        if (Tenant::create($request->input())) {
            session()->flash('success', 'Tenant was successfully added');
        } else {
            session()->flash('error', 'Tenant could not be added');
            return back();
        }
        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        $properties = Property::pluck('name', 'id');

        return view('tenants.edit', compact('tenant', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'property_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'lease_starts' => 'required',
            'lease_ends' => 'required',
        ]);

        if ($tenant->update($request->input())) {
            session()->flash('success', 'Tenant was successfully updated');
        } else {
            session()->flash('error', 'Tenant could not be updated');
            return back();
        }
        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        if ($tenant->delete()) {
            session()->flash('success', 'tenant was successfully deleted!');
        } else {
            session()->flash('error', 'tenant could not be deleted');
        }
        return back();
    }

    public function notifyTenant($id)
    {
        // get the tenant
        // and notify the tenant
        // log the request
        $tenant = Tenant::with('property')
            ->find($id);
        $message = 'This is a short reminder that your rent at '.
            $tenant->property->name. ' expires on '. $tenant->lease_ends. '.';

        $response = (new SMSGateWay())->sendMessage($tenant->phone_number, $message)
            ->sendRequestToSMSServer();
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['status']) && !empty($data['status'])) {
                // save to the database;
                session()->flash('success', 'Tenant was successfully notified');
            } else {
            }
        } else {
            session()->flash('error', 'Error occurred. please try again later');
        }
        return back();
    }
}
