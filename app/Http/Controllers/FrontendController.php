<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Models\CaseHearingDate;
use App\Models\Cases;
use App\Models\Employee\Employee;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
   public function index()
   {
   	$date = date('Y-m-d');
   	$model =Cases::with('hearing')->paginate(15);
    return view('frontend.welcome',compact('model'));
   }

   public function next()
   {
   		$date = date('Y-m-d');
   		$model=Cases::with(['hearing' => function($q) use($date) {
			    $q->where('date','>=', $date); 
			}])
			->paginate(15);
   	return view('frontend.next',compact('model'));
   }

   public function search(Request $request)
   {
   	if (!$request->q) {
   		return redirect()->route('index');
   	}
   	$model = Cases::search($request->q)
            ->with('court','case_categories','case_act','client_category','hearing','case_payment','case_study')
            ->groupBy('case_no')->paginate(20);

        return view('frontend.search',compact('model'));    
   }

}
