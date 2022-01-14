<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Validator;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Province;
use App\Models\City;


class BankController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banks = Bank::latest()->get();
        $provincies = Province::orderBy('province_description', 'asc')->get();
        $cities = City::orderBy('city_municipality_description', 'asc')->get();
        return view('administration.branch_bank_settings.branch_bank_settings', compact('banks','provincies','cities'));
    }
   
    public function create()
    {
        //
    }

   
   
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name'         => ['required'],
            'display_name' => ['required'],
            'address'      => ['required'],
            'status'       => ['required'],
            'province'     => ['required'],
            'city'         => ['required'],
            'lat'          => ['required', 'numeric'],
            'lng'          => ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        Bank::create([
            'name'                   => $request->input('name'),
            'display_name'           => $request->input('display_name'),
            'address'                => $request->input('address'),
            'status'                 => $request->input('status'),
            'province_code'          => $request->input('province'),
            'city_municipality_code' => $request->input('city'),
            'lat'                    => $request->input('lat'),
            'lng'                    => $request->input('lng'),
        ]);
        return response()->json(['success' => 'Added Successfully.']);
     
    }

    public function edit(Bank $bank)
    {
        if (request()->ajax()) {
            return response()->json([
                'result'    => $bank,
            ]);
        }
    }

   
    public function update(Request $request, Bank $bank)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name'         => ['required'],
            'display_name' => ['required'],
            'address'      => ['required'],
            'status'       => ['required'],
            'province'     => ['required'],
            'city'         => ['required'],
            'lat'          => ['required', 'numeric'],
            'lng'          => ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        
        Bank::find($bank->id)->update(
        [
            'name'                   => $request->input('name'),
            'display_name'           => $request->input('display_name'),
            'address'                => $request->input('address'),
            'status'                 => $request->input('status'),
            'province_code'          => $request->input('province'),
            'city_municipality_code' => $request->input('city'),
            'lat'                    => $request->input('lat'),
            'lng'                    => $request->input('lng'),
        ]);
        return response()->json(['success' => 'Updated Successfully.']);


    }

   
    public function destroy(Bank $bank)
    {
        return response()->json(['success' => $bank->delete()]);
    }
}
