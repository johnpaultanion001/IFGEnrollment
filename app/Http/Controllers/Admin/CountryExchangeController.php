<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountryExchange;
use Illuminate\Http\Request;
use Validator;

class CountryExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'country' => ['required'],
            'code' => ['required'],
            'exchange' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        CountryExchange::updateOrcreate(
            [
                'code'   => $request->input('code'),
            ],
            [
                'country'   => $request->input('country'),
                'code'   => $request->input('code'),
                'exchange'   => $request->input('exchange'),
            ]
        );
        return response()->json(['success' => 'Added Successfully.']);
    }

  
    public function show(CountryExchange $country)
    {
        //
    }

    
    public function edit(CountryExchange $country)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' => $country,
            ]);
        }
    }

   
    public function update(Request $request, CountryExchange $country)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'country' => ['required'],
            'code' => ['required'],
            'exchange' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        CountryExchange::find($country->id)->update(
            [
                'country'   => $request->input('country'),
                'code'   => $request->input('code'),
                'exchange'   => $request->input('exchange'),
            ]
        );
        return response()->json(['success' => 'Added Successfully.']);
    }

    public function destroy(CountryExchange $country)
    {
        return response()->json(['success' => $country->delete()]);
    }
}
