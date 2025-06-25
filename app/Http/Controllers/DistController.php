<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor; 


class DistController extends Controller
{
    
    # function to load distributor
   public function addDist()
   {
    return view('distributor.add');
   }

  #function to insert distributor
   public function insertDist(Request $request)
   {
    $request->validate([
       
        'phone' => 'required', 
        'password' => 'required',
    ]);

    ////
    $param = $request->all();
    unset($param['_token']);
    Distributor::create($param);
   
    return redirect()->route('add-dist')->with('success',"Distributor added successfully.");
    
   }

    #function to view distributor detail
    public function showDist()
    {
       $dist = Distributor::all();
       return view('distributor.show', compact('dist'));
    }

 # for active button
    public function updateStatus(Request $request)
{
   
    $request->validate([
        'id' => 'required|integer',
        'active' => 'required|boolean',
    ]);

   
    $distributor = Distributor::find($request->id);
    if ($distributor) {
        // Update the active status
        $distributor->active = $request->active;
        $distributor->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    } else {
        return response()->json(['success' => false, 'message' => 'Distributor not found!'], 404);
    }
}

     #function to edit distributor
     public function editDist($id)
     {    $dist = Distributor::find($id);
          return view('distributor.edit' , compact('dist') );
     }
             #function to update
             public function updateDist($id,Request $request)
             {
                 $dist= $request->all();
                 unset($dist['_token']);
                 Distributor::where('id', $id)->update($dist);
                 return redirect()->route('show-dist')->with('success',"Distributor updated successfully.");
         
             }
               #for delete
            public function index()
            {
                $dist = Distributor::all(); 
                return view('distributor.show', compact('dist')); 
            }
        
            public function destroy($id)
            {
                $dist = Distributor::findOrFail($id); // Find the user by ID
                $dist->delete(); // Delete the user
        
                return redirect()->route('show-dist')->with('success', 'Distributor deleted successfully.');
            }
            // DistController.php
public function updateDists(Request $request, $id)
{
    $request->validate([
        'active' => 'required|boolean',
    ]);

    $distributor = Distributor::findOrFail($id); // Assuming you're using a Distributor model
    $distributor->active = $request->active; // Update the active status
    $distributor->save();

    return redirect()->back()->with('success', 'Distributor status updated successfully.');
}

    #function to view dist. details
    public function viewDistDetails($id)
    {
        $dist = Distributor::findOrFail($id);
        return view('distributor.view', compact('dist'));
    }

}
