<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Subscription;
use Auth;

class SubscriptionController extends Controller
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
     * Preview the calculations.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {

        $validator = $this->validate($request, [
            'plans.*.code' => 'bail|required|exists:plans,code',
            'plans.*.subscription_type' => 'required|in:monthly,yearly',
        ]);

        $requested_plans = $request->all();
        $plans = Plan::select('code', 'name', 'monthly_cost', 'yearly_cost')->get()->keyBy('code');

        $data = [];
        $invalid_data = [];
        $total = 0;
        foreach ($requested_plans['plans'] as $req_plan) {

                $plan = $plans[$req_plan['code']];

                if ($req_plan['subscription_type'] == 'monthly') {
                    $cost = $plan['monthly_cost'];
                } elseif ($req_plan['subscription_type'] == 'yearly') {
                    $cost = $plan['yearly_cost'];                
                } else {
                    ; // won't reach here
                }

                $data[] = [
                    'code' => $plan['code'],
                    'type' => $req_plan['subscription_type'],
                    'cost' => $cost
                ];

                $total += $cost;

        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
            'total' => $total
        ]);
    }

    //
    
    
    /**
     * save the subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validate($request, [
            'plans.*.code' => 'bail|required|exists:plans,code',
            'plans.*.subscription_type' => 'required|in:monthly,yearly',
        ]);

        $requested_plans = $request->all();
        $plans = Plan::select('id', 'code', 'name', 'monthly_cost', 'yearly_cost')->get()->keyBy('code');

        $data = [];
        foreach ($requested_plans['plans'] as $req_plan) {
    
            $plan = $plans[$req_plan['code']];

            if ($req_plan['subscription_type'] == 'monthly') {
                $cost = $plan['monthly_cost'];
            } elseif ($req_plan['subscription_type'] == 'yearly') {
                $cost = $plan['yearly_cost'];                
            } else {
                ; // won't reach here
            }

            $data[] = [
                'user_id' => Auth::id(),
                'plan_id' => $plan['id'],
                'type' => $req_plan['subscription_type'],
                'cost' => $cost
            ];
        }

        Subscription::insert($data); // Eloquent approach

        return response()->json([
            'status' => 'success'
        ]);
    }
}
