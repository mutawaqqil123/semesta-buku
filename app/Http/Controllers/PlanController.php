<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Requests\PlanRequest as Request;

class PlanController extends Controller
{
    public function index()
    {
        $data = [
            'plans' => Plan::with('subscription')->get()
        ];

        return view('admin.plan.plan-index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validated();

        Plan::create($validatedData);

        return redirect()->back()->with('success', 'Plan created successfully.');
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $request->validated();

        $plan->update($data);

        return redirect()->back()->with('success', 'Plan Updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        if($plan->subscription()->count() > 0){
            return redirect()->back()->with('error', "Tidak dapat di hapus karena masih memiliki subscription aktif");
        }else {
            $plan->delete();
            return redirect()->back()->with('success', "Plan Berhasil dihapus");
        }
    }
}
