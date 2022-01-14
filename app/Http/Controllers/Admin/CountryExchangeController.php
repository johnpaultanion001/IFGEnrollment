<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountryExchange;
use App\Models\CountryExchangeRecord;
use Illuminate\Http\Request;
use Validator;
use Gate; 
use Symfony\Component\HttpFoundation\Response;

class CountryExchangeController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries   = CountryExchange::latest()->get();
        return view('administration.staff.exchange_rate.exchange_rate' , compact('countries'));
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

        $record = CountryExchange::updateOrcreate(
            [
                'code'   => $request->input('code'),
            ],
            [
                'country'   => $request->input('country'),
                'code'   => $request->input('code'),
                'exchange'   => $request->input('exchange'),
            ]
        );
        CountryExchangeRecord::create([
            'country_exchange_id'  => $record->id,
            'exchange'             => $record->exchange,
        ]);
        return response()->json(['success' => 'Added Successfully.']);
    }

  
    public function show(CountryExchange $country)
    {
        //
    }

    
    public function edit(CountryExchange $exchange_rate)
    {
        if (request()->ajax()) {
            return response()->json([
                'result' => $exchange_rate,
            ]);
        }
    }

   
    public function update(Request $request, CountryExchange $exchange_rate)
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
        CountryExchange::find($exchange_rate->id)->update(
            [
                'country'   => $request->input('country'),
                'code'   => $request->input('code'),
                'exchange'   => $request->input('exchange'),
            ]
        );
        CountryExchangeRecord::create([
            'country_exchange_id'  => $exchange_rate->id,
            'exchange'             => $request->input('exchange'),
        ]);

        return response()->json(['success' => 'Added Successfully.']);
    }

    public function destroy(CountryExchange $exchange_rate)
    {
        return response()->json(['success' => $exchange_rate->delete()]);
    }

    public function exchange_rate_records(Request $request)
    {
        $records = CountryExchangeRecord::where('country_exchange_id', $request->get('id'))->latest()->get();
        return view('administration.staff.exchange_rate.exchange_rate_records' , compact('records'));
    }
}
