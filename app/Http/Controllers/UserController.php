<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users; 
use App\Models\User; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    # function to load user
   public function addUser()
   {
    return view('user.add');
   }

  #function to insert User
  public function insertUser(Request $request)
  {
      $request->validate([
          'phone' => 'required|digits:10',
          'password' => 'required|string', // Add stronger password rules
      ]);
  
      // Hash the password
      $param = $request->all();
      $param['password'] = Hash::make($param['password']); // Securely hash the password
  
      // Save the user
      Users::create($param); 
  
      return redirect()->route('add-user')->with('success', "User added successfully.");
  }
     #function to view User detail
     public function showUser()
     {
        $user = Users::all();
        return view('user.show', compact('user'));
     }

           #function to edit user
    public function editUser($id)
    {    $user = Users::find($id);
         return view('user.edit' , compact('user') );
    }
            #function to update
            public function updateUser($id,Request $request)
            {
               

                $user= $request->all();
                unset($user['_token']);
                Users::where('id', $id)->update($user);
                return redirect()->route('show-user')->with('success',"User updated successfully.");
        
            }
                #for delete
            public function index()
            {
                $user = Users::all(); 
                return view('user.show', compact('user')); // Pass to view
            }
        
            public function destroy($id)
            {
                $user = Users::findOrFail($id); 
                $user->delete(); 
        
                return redirect()->back()->with('success', 'User deleted successfully.');
            }
       
            # function for view User Details
            public function viewUserDetails($id)
            {
                $user = Users::findOrFail($id);
                return view('user.viewUser', compact('user'));

            }

 # for active button
 public function activeUser(Request $request)
 {
    $request->validate([
        'active' => 'required|boolean',
    ]);

    $user = User::findOrFail($id); // Assuming you're using a User model
    $user->active = $request->active; // Update the active status
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully.');
    
 }

  # function to login -> to access login page
 public function login()
 {
  return view('user.login');
 }

  # function to login the web
  public function loginUser(Request $request)
  {
      $request->validate([
          'phone' => 'required|string',
          'password' => 'required|string',
      ]);
  
      $user = Users::where('phone', $request->phone)->first();
  
      if (!$user || !Hash::check($request->password, $user->password)) {
          return response()->json(['error' => 'Invalid credentials'], 401);
      }
  
      // Generate a token if using Sanctum
      $token = $user->createToken('API Token')->plainTextToken;
  
      return response()->json([
          'message' => 'Login successful',
          'token' => $token,
          'user' => $user,
      ]);
  }
public function dashboardPage()
{
    return view('dashboard');
}
public function logout()
{
    // Auth::logout();

    session()->forget('user'); 

    return redirect()->route('login-page')->with('success', "Logged out successfully.");
}
   

}
