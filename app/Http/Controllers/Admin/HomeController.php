<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\Beneficiary;
use App\Models\CountryExchange;
use App\Models\Bank;
use App\Models\Transaction;
use App\Models\PlanCodeForIFGModel;
use App\Models\MemberDetail;
use File;
use Illuminate\Support\Facades\Storage;

class HomeController
{
    public function index()
    {
        $userid = auth()->user()->id;
  
        $dependents = MemberDetail::where('principal_id', auth()->user()->memberDetail->id ?? "")->where('isSaveByUser', true)->count();

        return view('home.home', compact('dependents'));
    }
}
