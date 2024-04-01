<?php

namespace App\Http\Controllers;

use App\Enums\BillingPeriods;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $records = Plan::all();
        $periods = BillingPeriods::cases();
        return view('admin.plans.index', compact('records', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'billing_period' => 'required',
            'api_calls' => 'required',
            'stripe_id' => 'required_unless:price,0',
        ]);
        try {
            Plan::create($data);
            return back()->with('success', 'Plan added successfully');
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }


    public function show()
    {
        //
        $records = Plan::all();
        return view('admin.plans.show', compact('records'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
        $periods = BillingPeriods::cases();
        return view('admin.plans.edit', compact('plan', 'periods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'billing_period' => 'required',
            'api_calls' => 'required',
            'stripe_id' => 'required_unless:price,0',
        ]);
        try {
            $plan->update($data);
            return redirect()->route('plans.index')->with('success', 'Plan updated successfully');
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
        try {
            $plan->delete();
            return back()->with('success', 'Plan deleted successfully');
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function subscribe($id)
    {
        return view('plans.subscribe', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }

    public function do_subscribe(Request $request, $id)
    {
        $data = $request->validate([
            'token' => 'required',
        ]);
        $plan = Plan::find($id);
        auth()->user()->newSubscription('default', $plan->stripe_id)->create($data['token']);
        auth()->user()->update([
            'subscription_id' => $plan->id
        ]);

        return redirect()->route('plans.user_index')->with('success', 'Plan subscribed successfully');
    }
}
