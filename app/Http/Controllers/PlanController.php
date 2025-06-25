<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plans;


class PlanController extends Controller
{

    #function to insert plan
    public function addPlan()
    {
        $plans = Plans::all(); 
        return view('plan.insert', compact('plans'));
    }
    public function createPlan(Request $request)
{
    $request->validate([
        'plan' => 'required',
        'price' => 'required',
        'duration' => 'required|string', 
    ]);



    $param = $request->all();
    unset($param['_token']); 
    $param['active'] = 0; 
    Plans::create($param);

    return redirect()->route('adding-plan')->with('success', "Plan added successfully.");
}


 #function to show plans
//  public function showPlans()
//  {
//     $plans = Plans::orderBy('id', 'DESC')->get();
    
//     return view('plan.show', compact('plans'));
//  }

 #function for active button status update
 public function updateStatus(Request $request, $id)
 {
     $plan = Plans::find($id);
     
     if ($plan) {
         // Toggle active status
         $plan->active = $request->active;
         $plan->save();

         return redirect()->back()->with('success', 'Plan status updated successfully!');
     }

     return redirect()->back()->with('error', 'Plan not found.');
 }

#function to edit plans
public function editPlans($id)
{   


    $plan = Plans::find($id); 
    return view('plan.edit', compact('plan'));

}
public function updatePlans(Request $request, $id)
{
    

    $plan = Plans::find($id);

    if ($plan) {
        $plan->plan = $request->plan;
        $plan->price = $request->price;
        $plan->duration = $request->duration;
        $plan->save();

        return redirect()->route('show_plans')->with('success', 'Plan updated successfully!');
    }

}
 #function to show plans
public function index()
{
    $plans = Plans::orderBy('id', 'DESC')->get();
    $activePlans = Plans::where('active', '1')->count();
      
    return view('plan.show', compact('plans','activePlans'));
}

public function destroy($id)
{
    $plan = Plans::findOrFail($id); 
    $plan->delete();

    return redirect()->route('show_plans')->with('success', 'Plan deleted successfully.');
}

// public function planView()
// {
//     $activePlans = Plans::where('active', '1')->count();
//     return $activePlans ;
//     // Pass the variable to the plan.show view
//     return view('plan.show', compact('activePlans'));
// }      
    
    
}
