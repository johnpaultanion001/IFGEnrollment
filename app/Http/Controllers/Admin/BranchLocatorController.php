<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Bank;
use db;


class BranchLocatorController extends Controller
{
    public function branch_locator()
    {
        $provincies = Province::all();
        $cities = City::all();

        return view('admin.admin.branch_locator.branch_locator' , compact('provincies', 'cities'));
    }
    public function cities_province(Request $request)
    {
        $query = City::query();
        if($request->get('province'))
        {
            $query->where('province_code', $request->get('province'));
        }
        $cities = $query->latest()->get();
        return view('admin.admin.branch_locator.cities_provincies' , compact('cities'));
    }
    public function cities_province_banks(Request $request)
    {
        $query = Bank::query();
        if($request->get('province'))
        {
            $query->where('province_code', $request->get('province'));
        }
        if($request->get('city'))
        {
            $query->where('city_municipality_code', $request->get('city'));
        }
        $banks = $query->where('status', $request->get('status'))->latest()->get();
        return view('admin.admin.branch_locator.cities_provincies_banks' , compact('banks'));
    }

    
   
}
