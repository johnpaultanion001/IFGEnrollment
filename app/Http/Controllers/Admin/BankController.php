<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Validator;
use Illuminate\Http\Request;



class BankController extends Controller
{
   
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

   
   
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'bank_name' => ['required'],
            'province_code' => ['required'],
            'city_municipality_code' => ['required'],
            'address' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Bank::updateOrcreate(
        [
            'address'   => $request->input('address'),
        ],
        [
            'bank_name'   => $request->input('bank_name'),
            'province_code'   => $request->input('province_code'),
            'city_municipality_code'   => $request->input('city_municipality_code'),
            'address'   => $request->input('address'),
            'status'   => $request->input('record_status'),
        ]);
        return response()->json(['success' => 'Added Successfully.']);
    }

   
    public function show(Bank $bank)
    {
        //
    }

    public function edit(Bank $bank)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' => $bank,
                'province'  => $bank->province->province_description,
            ]);
        }
    }

   
    public function update(Request $request, Bank $bank)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'bank_name' => ['required'],
            'province_code' => ['required'],
            'city_municipality_code' => ['required'],
            'address' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        
        Bank::find($bank->id)->update(
        [
            'bank_name'   => $request->input('bank_name'),
            'province_code'   => $request->input('province_code'),
            'city_municipality_code'   => $request->input('city_municipality_code'),
            'address'   => $request->input('address'),
        ]);
        return response()->json(['success' => 'Updated Successfully.']);


    }

   
    public function destroy(Bank $bank)
    {
        return response()->json(['success' => $bank->delete()]);
    }
}
