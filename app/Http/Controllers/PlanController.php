<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Auth;

class PlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plans = Plan::select('code', 'name', 'monthly_cost', 'yearly_cost')->get()->keyBy('code');
        return response()->json(['status' => 'success', 'result' => $plans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $plan = Plan::select('code', 'name', 'monthly_cost', 'yearly_cost')
            ->where('code', $code)
            ->get();

        if ($plan) {
            return response()->json(['status' => 'success', 'data' => $plan]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function calc(Request $request)
    {

        $validator = $this->validate($request, [
            'plans.*.code' => 'required',
            'plans.*.subscription_type' => 'required',
        ]);

        $requested_plans = $request->all();
        $plans = Plan::select('code', 'name', 'monthly_cost', 'yearly_cost')->get()->keyBy('code');

        $data = [];
        $invalid_data = [];
        $total = 0;
        foreach ($requested_plans as $req_plan) {

            if (isset($plans[$req_plan['code']])) {
                $plan = $plans[$req_plan['code']];

                if ($req_plan['type'] == 'monthly') {
                    $cost = $plan['monthly_cost'];
                } elseif ($req_plan['type'] == 'yearly') {
                    $cost = $plan['yearly_cost'];                
                } else {
                    $invalid_data[] = $req_plan['code'];
                }

                $data[] = [
                    'code' => $plan['code'],
                    'type' => $req_plan['type'],
                    'cost' => $cost
                ];

                $total += $cost;
            } else {
                $invalid_data[] = $req_plan['code'];
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
            'invalid_data' => $invalid_data,
            'total' => $total
        ]);
    }

    //
}
