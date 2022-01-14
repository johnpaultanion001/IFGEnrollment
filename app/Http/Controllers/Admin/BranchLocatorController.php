<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Bank;
use db;
use Validator;

class BranchLocatorController extends Controller
{
    public function branch_locator(Request $request , $status)
    {
        $provincies = Province::orderBy('province_description', 'asc')->get();
        $cities = City::orderBy('city_municipality_description', 'asc')->get();
        $locations = Bank::where('status', $status)->latest()->get();
        
        
        return view('admin.admin.branch_locator.branch_locator' , compact('provincies', 'cities','locations'));
    }
   public function province(Request $request){
        $cities = City::where('province_code', $request->get('province'))->orderBy('city_municipality_description', 'asc')->get();
        $banks  = Bank::where('province_code', $request->get('province'))->where('status', $request->get('status'))->latest()->get();

        return response()->json([
            'cities' => $cities,
            'banks'  => $banks,
        ]);
   }
   public function city(Request $request){
        $banks  = Bank::where('city_municipality_code', $request->get('city'))->where('status', $request->get('status'))->latest()->get();
        return response()->json([
            'banks'  => $banks,
        ]);
   }
   
   public function address(Request $request){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'address' => ['required'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $banks  = Bank::where('address', 'LIKE','%'.$request->input('address')."%")->where('status', $request->get('status'))->latest()->get();

        return response()->json([
            'banks'  => $banks,
        ]);

   }
   
}
