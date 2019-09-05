<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use DB;
use App\Models\Cases;
use App\Models\CasePayment;
use Carbon\Carbon;

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
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $dates = [];
        $casePayment = [];
            while ($start->lte($end)) {
                  $date = $start->copy();
                  $start->addDay();
                  $casePayment[] =CasePayment::where('date',$date->format('Y-m-d'))->sum('amount');
                  $dates[]=$date->format('d');
            }
        

            $cases = Cases::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();
            $chart = Charts::database($cases, 'bar', 'highcharts')
                  ->title("Monthly new Case Register")
                  ->elementLabel("Total Cases")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);
            //         
            $line=Charts::multi('areaspline', 'highcharts')
                    ->title(date('F, Y').' Income Chart')
                    ->colors(['#ff0000'])
                    ->responsive(true)
                    ->labels($dates)
                    ->dataset('Income', $casePayment);
                    // ->dataset('Expense',  [1, 3, 4, 3, 3, 5, 4]);     
        return view('home',compact('chart','line'));
    }
}
