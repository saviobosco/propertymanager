<?php

namespace App\Http\Controllers;

use App\Property;
use App\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalProperties = Property::count();
        $totalTenants = Tenant::count();
        //DB::enableQueryLog();

        $leaseExpiresInAMonth = Tenant::query()
            ->with('property')
            ->select(['id','lease_ends', 'first_name', 'last_name', 'property_id'])
            ->whereBetween('lease_ends',
                [DB::raw('CURDATE()'),
                    DB::raw('CURDATE() + INTERVAL 30 DAY')
                ])
            ->get();
        //dd(DB::getQueryLog()); // Show results of log

        return view('home', compact('totalProperties', 'totalTenants', 'leaseExpiresInAMonth'));
    }
}
