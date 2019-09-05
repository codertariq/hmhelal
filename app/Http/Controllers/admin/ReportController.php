<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Cases;
use App\Models\CaseHearingDate;
use Illuminate\Validation\ValidationException;
use Charts;

class ReportController extends Controller
{
   
   public function income(Request $request)
   {
   	if ($request->isMethod('get')) {
     return view('admin.report.income.index');
   	}

   	else
   	{
   		$date1 = $request->from;
		  $date2 = $request->to;
        $model =Transaction::where('trans_type','income')
                        ->whereBetween('trans_date', [$date1, $date2])

     					->get();
     	 return view('admin.report.income.show',compact('model','date1','date2'));				
   	}
   }

    public function expense(Request $request)
   {
   	if ($request->isMethod('get')) {
     return view('admin.report.expense.index');
   	}

   	else
   	{
   		$date1 = $request->from;
		  $date2 = $request->to;
        $model =Transaction::where('trans_type','expense')
                        ->whereBetween('trans_date', [$date1, $date2])

     					->get();
     	 return view('admin.report.expense.show',compact('model','date1','date2'));				
   	}
   }


    public function balance(Request $request)
   {
   	if ($request->isMethod('get')) {
     return view('admin.report.balance.index');
   	}

   	else
   	{
   		 $date1 = $request->from;
		 $date2 = $request->to;
         $model =Transaction::where('trans_type','expense')
                        ->whereBetween('trans_date', [$date1, $date2])
     					->get();
     	 $expense =$model->sum('amount');				

     	 $model1 =Transaction::where('trans_type','income')
                        ->whereBetween('trans_date', [$date1, $date2])
     					->get();
     	 $income =$model1->sum('amount');
     	 $balance =$income-$expense;

     	 $line = Charts::create('area', 'highcharts')
                            ->title('Financial Account Balance Chart')
                            ->elementLabel('Financial Account Balance Chart')
                            ->labels(['Income', 'Expense','Balance'])
                            ->values([$income,$expense,$balance])
                            ->dimensions(1000,500)
                            ->responsive(true);								
     	 return view('admin.report.balance.show',compact('model','model1','date1','date2','line'));				
   	}
   }

   public function case(Request $request)
   {
   	if ($request->isMethod('get')) {
     return view('admin.report.case.index');
   	}

   	else
   	{
   		$date1 = $request->from;
		$date2 = $request->to;
		$value =[$date1, $date2];
		$model =CaseHearingDate::with('case')->whereBetween('date', $value)->get();
		// $model=Cases::with(['hearing' => function($q) use($value) {
		// 	    $q->whereBetween('date', $value); 
		// 	}])
		// 	->get();
     	 return view('admin.report.case.show',compact('model','date1','date2'));				
   	}
   }
}
