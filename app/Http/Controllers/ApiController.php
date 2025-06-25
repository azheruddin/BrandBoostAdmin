<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Users;
use App\Models\Category;
use App\Models\Post;
use App\Models\Migration;
use App\Models\Distributor;
use App\Models\City;
use App\Models\State;
use App\Models\Profile;
use App\Models\Plans;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ApiController extends Controller
{
    
     # function to get all cateories
     public function getAllCategory(Request $request)
     {
        //  $categories = Category::all();
 
        //  return response()->json(['status' => true, 'categories' => $categories]);

            $category = Category::where('active', '1')->orderBy('id', 'asc')->get();
            $data = array();
            foreach($category as $row )
            {
                $data[]=[
                    'id'=> $row->id,
                    'category'=> $row->category,
                    'active'=> $row->active,
                ];
            }
            $array = json_encode($data);
            $array = json_decode($array);

            if ($category != null  ) {
                return response()->json([
                    'status' => 'True',
                    'data' =>  $array,
         
                ], 200, [], JSON_NUMERIC_CHECK);
            } else {
                return response()->json(['status' => 'F', 'errorMsg' => 'data Not found'], 200);
            }

     }

     public function insertCategory(Request $request)
{
    // Insert the category into the database
    $category = new Category();
    $category->category = $request->category;
    $category->active = $request->active;
    $category->save();

    // Return a success response
    return response()->json([
        'status' => 'True',
        'message' => 'Category inserted successfully.',
        'data' => $category
    ], 200);
}


     # function to add user
    //  public function createUser(Request $request)
    //  {
    //      $request->validate([
    //          'name' => 'required|string|max:255',
    //         //  'phone' => 'required|digits:10',
    //         'phone' => 'required|digits:10|unique:users,phone',
    //          'password' => 'required',
    //      ]);
     
    //      $user = new Users();
    //      $user->name = $request->name;
    //      $user->phone = $request->phone;
    //      $user->password = bcrypt($request->password);
    //      $user->user_type = $request->user_type;
    //      if ($user->save()) {
    //          #Create a profile linked to the user
    //          $profile = new Profile();
    //          $profile->type = 'personal'; 
    //          $profile->user_id = $user->id; 
    //          $profile->save();
     
    //          return response()->json([
    //              'status' => true,
    //              'message' => 'User and profile created successfully.',
    //              'user' => $user,
    //              'profile' => $profile,
    //          ], 200);
    //      }
     
    //      return response()->json([
    //          'status' => false,
    //          'message' => 'Something went wrong.',
    //      ], 400);
    //  }
    public function createUser(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => 'required',
        ]);

        $user = new Users();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;

        if ($user->save()) {
            $profile = new Profile();
            $profile->type = 'personal'; 
            $profile->user_id = $user->id; 
            $profile->save();

            return response()->json([
                'status' => true,
                'message' => 'User and profile created successfully.',
                'user' => $user,
                'profile' => $profile,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong.',
        ], 400);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => false,
            'message' => 'User already exists',
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'An unexpected error occurred.',
        ], 500);
    }
}

     
     


       # function to get all users
       public function showUsers()
       {    try{
           $users = Users::all();
           $result=array('status'=>true,'message'=>count($users)." users fetched.",'data'=>$users);
           $responseCode=200;
   
           return response()->json($result,$responseCode);
       }catch(Exception $e)
       {
        $result=array('status'=>false,'message'=>"API failed.",'error'=>$e->getMessage());
        return response()->json($result,500);
       }
       }


       # function to get  user by id
       public function getUser(Request $request )
       {    try{
           $user = Users::where('id',$request->user_id)->get();
           $responseCode=200;
   
           return response()->json($user,$responseCode);
       }catch(Exception $e)
       {
        $result=array('status'=>false,'message'=>"API failed.",'error'=>$e->getMessage());
        return response()->json($result,500);
       }
       }

       
       public function show_post(Request $request)
       {
           try {
               $query = Post::query();
       
               if ($request->category_id) {
                   $query->where('category_id', $request->category_id);
               }
       
               $posts = $query->paginate(10);
       
               return response()->json([
                   'status' => true,
                   'message' => $posts->total() . " Posts fetched.",
                   'data' => $posts->items(),
                   'pagination' => [
                       'total' => $posts->total(),
                       'per_page' => $posts->perPage(),
                       'current_page' => $posts->currentPage(),
                       'last_page' => $posts->lastPage(),
                       'from' => $posts->firstItem(),
                       'to' => $posts->lastItem(),
                   ],
               ]);
           } catch (Exception $e) {
               return response()->json([
                   'status' => false,
                   'message' => "Api Failed.",
                   'error' => $e->getMessage(),
               ]);
           }
       }
        
        #  function for custom post
        public function customPost(Request $request,$id)
        {
-            $validatedData = $request->validate([
                'type' => 'required|string',
                'path_url' => 'required|string',
                'text_color' => 'nullable|string', 
            ]);
        
            if (in_array($validatedData['type'], ['custom_post', 'custom_video'])) {
                $post = Post::create([
                    'type' => $validatedData['type'],
                    'path_url' => $validatedData['path_url'],
                    'text_color' => $validatedData['text'] ?? null, 
                ]);
        
                if ($post->id) {
                    $result = array(
                        'status' => true,
                        'message' => "Custom Post Added Successfully.",
                        'data' => $post,
                    );
                    $responseCode = 200;
                } else {
                    $result = array(
                        'status' => false,
                        'message' => "Something went wrong.",
                    );
                    $responseCode = 400;
                }
            } else {
                $result = array(
                    'status' => false,
                    'message' => "Invalid type. Only 'custom_post' and 'custom_video' are allowed.",
                );
                $responseCode = 400;
            }
        
            return response()->json($result, $responseCode);
        }
        
        #function for show custom post
        public function show_custom_post(Request $request, $id)
{
    $post = Post::where('id', $id)->first();

    if (!$post) {
        return response()->json(['status' => false, 'message' => "Post not found."], 404);
    }

    $data = [
        'id' => $post->id,
        'type' => $post->type,
        'path_url' => $post->path_url,
        'text' => $post->text,
    ];

    return response()->json(['status' => true, 'data' => $data], 200, [], JSON_NUMERIC_CHECK);
}
    #function to update custom post
    public function updateCustomPost(Request $request, $id)
{
    $post = Post::find($id);
    if (!$post) {
        return response()->json(['status' => false, 'message' => "Post not found"], 404);
    }

    $post->update([
        'type' => $request->input('type'),
        'path_url' => $request->input('path_url'),
        'text' => $request->input('text'),
    ]);

    $data = [
        'id' => $post->id,
        'type' => $post->type,
        'path_url' => $post->path_url,
        'text' => $post->text,
    ];

    return response()->json([
        'status' => true,
        'message' => "Post updated successfully.",
        'data' => $data,
    ], 200, [], JSON_NUMERIC_CHECK);
}

       

       # function to add post
       public function addPost(Request $request)
       {

        $post = Post::create([
            'type' => $request->type, 
            'path_url' => $request->path_url, 
            'category_id' => $request->category_id, 
            'type' => $request->type, 
        ]);

        if($post->id)
        {
            $result = array('status'=>true,'message'=>"Post Added Successfully.",'data'=>$post);
            $responseCode=200;
        }
        else{
            $result = array('status'=>false,'message'=>"something went wrong.");
            $responseCode=400;
        }


        return response()->json($result,$responseCode);


       }
       #function to add distributor
     public function addDist(Request $request)
     {
         $dist = Distributor::create([
             'phone' => $request->phone, 
             'password' => $request->password, 
             'user_type' => $request->user_type, 
         ]);
 
         if($dist->id)
         {
             $result = array('status'=>true,'message'=>"Distributor created.",'data'=>$dist);
             $responseCode=200;
         }
         else{
             $result = array('status'=>false,'message'=>"something went wrong.");
             $responseCode=400;
         }
 
 
         return response()->json($result,$responseCode);
     }

        # function to get all Distributor
        public function showDist()
        {
            $dist = Distributor::all();
    
            return response()->json(['status' => true, 'categories' => $dist]);
        }

    


    # function to login
    // public function loginUser(Request $request)
    // {
    
        
    //     $user = Users::where('phone',$request->input('phone'))->where('password',$request->input('password'))->first();
    //     if($user->id)
    //     {
    //         $result = array('status'=>true,'message'=>"Login Successfully.",'data'=>$user);
    //         $responseCode=200;
    //     }
    //     else{
    //         $result = array('status'=>false,'message'=>"something went wrong.");
    //         $responseCode=400;
    //     }


    //     return response()->json($result,$responseCode);
    // }
        
    
        # function to login
    public function loginUser(Request $request)
{
    try {
        $user = Users::where('phone', $request->input('phone'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            $result = [
                'status' => true,
                'message' => "Login Successfully.",
                'data' => $user,
            ];
            $responseCode = 200;
        } else {
            $result = [
                'status' => false,
                'message' => "Invalid phone or password.",
            ];
            $responseCode = 400;
        }
    } catch (\Exception $e) {
        $result = [
            'status' => false,
            'message' => "An error occurred during login.",
            'error' => $e->getMessage(),
        ];
        $responseCode = 500;
    }

    return response()->json($result, $responseCode);
}



        #function for get Address
    // public function getAddress($addressId)
    // {
    //     $address = Address::with(['state', 'city'])->find($addressId);

    //     if (!$address) {
    //         return response()->json([
    //             'message' => 'Address not found'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'address' => [
    //             'state' => $address->state->state_name,  
    //             'city' => $address->city->city_name     
    //         ]
    //     ]);
    // }

            #function for add profile
        public function addProfile(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'profile_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // validate image upload
        // you can add other validations as needed for other fields
    ]);

    $profile = Profile::where('user_id', $request->user_id)->first();

    $data = [
        'type' => $request->type,
        'whatsappno' => $request->whatsappno,
        'website' => $request->website,
        'instagram_facebook' => $request->instagram_facebook,
        'bussiness_name' => $request->bussiness_name,
        'tagline' => $request->tagline,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
    ];

    // Handle profile_logo upload if present
    if ($request->hasFile('profile_logo')) {
        $file = $request->file('profile_logo');

        // Define folder path relative to storage/app/public
        $folderPath = 'logo';

        // Store the file and get the relative path
        $path = $file->store($folderPath, 'public');  // uses 'public' disk

        // Save the stored path in the data array
        $data['profile_logo'] = $path;  // e.g. videos/plogo/filename.jpg
    }

    if ($profile) {
        // Update existing profile
        $profile->update($data);
        $message = "Profile updated.";
    } else {
        // Create new profile
        $data['user_id'] = $request->user_id;
        $profile = Profile::create($data);
        $message = "Profile created.";
    }

    if ($profile) {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $profile
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => "Something went wrong."
        ], 400);
    }
}


       


            #function for get profile
            public function getProfile($id)
            {
                try{
                $profile = Profile::where('user_id', $id)->first();

                if (!$profile) {
                    return response()->json([
                        'status' => 'False',
                        'errorMsg' => 'Profile not found for the given user_id',
                    ], 404);
                }
             
                $data = [
                    'id' => $profile->id,
                    'type' => $profile->type,
                    'profile_logo' => $profile->profile_logo,
                    'whatsappno' => $profile->whatsappno,
                    'website' => $profile->website,
                    'instagram_facebook' => $profile->instagram_facebook,
                    'bussiness_name' => $profile->bussiness_name,
                    'tagline' => $profile->tagline,
                    'state' => $profile->state,
                    'city' => $profile->city,
                    'address' => $profile->address,
                ];
            
                return response()->json([
                    'status' => 'True',
                    'data' => $data,
                ], 200, [], JSON_NUMERIC_CHECK);
                }catch(Exception $e){
                $result=array('status'=>false,'message'=>"API failed.",'error'=>$e->getMessage());
                return response()->json($result,500);
               }
                
            }
            
            #function for edit profile
            public function updateProfile(Request $request, $id)
            {
                $profile = Profile::find($id);
                if(!$profile)
                {
                    return response()->json(['status'=>false, 'message'=>"Profile not found"],404);
                }

            $profile->update([
                'type'=>$request->input('type'),
                'profile_logo'=>$request->input('profile_logo'),
                'whatsappno'=>$request->input('whatsappno'),
                'website'=>$request->input('website'),
                'instagram_facebook'=>$request->input('instagram_facebook'),
                'bussiness_name'=>$request->input('bussiness_name'),
                'tagline'=>$request->input('tagline'),
                'state'=>$request->input('state'),
                'city'=>$request->input('city'),
                'address'=>$request->input('address'),
            ]);
                $data = [
                    'id'=>$profile->id,
                    'type' => $profile->type,
                    'profile_logo' => $profile->profile_logo, 
                    'whatsappno' => $profile->whatsappno, 
                    'website' => $profile->website, 
                    'instagram_facebook' => $profile->instagram_facebook, 
                    'bussiness_name' => $profile->bussiness_name, 
                    'tagline' => $profile->tagline, 
                    'state' => $profile->state, 
                    'city' => $profile->city, 
                    'address' => $profile->address, 
                ];
                return response()->json(['status'=>true, 'message'=>"Profile updated successfully.",'data'=>$data,],200,[],JSON_NUMERIC_CHECK);

            }
       
            public function contactUs()
            {
                return response()->json(['email'=>"support@gmail.com",'no'=>"7058225560"]);
            }


            #function to create plan
            public function addPlans(Request $request)
            {
                $plans = Plans::create([
                    'plan'=>$request->plan,
                    'price'=>$request->price,
                    'duration'=>$request->duration,
                    'active'=>$request->active,
                   
                ]);

                if($plans->id)
                {
                    $result = array('status'=>true,'message'=>"plans created.",'data'=>$plans);
                    $responseCode=200;
                }else{
                    $result = array('status'=>false,'message'=>"Something went wrong.");
                    $responseCode=400;
                }
                return response()->json($result,$responseCode);



            }

            #function for get plans
            public function showAllPlans()
            {
                // $plans = Plans::where('active','1')->get();

                $plans = Plans::all();
                $data = array();
            foreach($plans as $row )
            {
                $data[]=[
                    'id'=> $row->id,
                    'plan'=> $row->plan,
                    'price'=> $row->price,
                    'duration'=> $row->duration,
                    'active'=> $row->active,
                    
                ];
            }
            $array = json_encode($data);
            $array = json_decode($array);

            if ($plans != null  ) {
                return response()->json([
                    'status' => 'True',
                    'message'=>count($plans)." plans fetched.",
                    'data' =>  $array,
         
                ], 200, [], JSON_NUMERIC_CHECK);
            } else {
                return response()->json(['status' => 'F', 'errorMsg' => 'data Not found'], 200);
            }
            }
            #function for active plans
            public function show_plan()
            {
                $plans = Plans::where('active','1')->get();
                foreach($plans as $row )
                {
                    $data[]=[
                        'id'=> $row->id,
                        'plan'=> $row->plan,
                        'price'=> $row->price,
                        'duration'=> $row->duration,
                        'active'=> $row->active,
                        
                    ];
                }
                $array = json_encode($data);
                $array = json_decode($array);
    
                if ($plans != null  ) {
                    return response()->json([
                        'status' => 'True',
                        'message'=>count($plans)." plans fetched.",
                        'data' =>  $array,
             
                    ], 200, [], JSON_NUMERIC_CHECK);
                } else {
                    return response()->json(['status' => 'F', 'errorMsg' => 'data Not found'], 200);
                }

            }   

            #function for edit Plans
            public function updatePlans(Request $request, $id)
            {
                $plans = plans::find($id);
                if(!$plans)
                {
                    return response()->json(['status'=>false, 'message'=>"plans not found"],404);
                }

            $plans->update([
                'plan'=>$request->input('plan'),
                'price'=>$request->input('price'),
                'duration'=>$request->input('duration'),
                'active'=>$request->input('active'),
               
            ]);
                $data = [
                    'id'=>$plans->id,
                    'plan' => $plans->plan,
                    'price' => $plans->price, 
                    'duration' => $plans->duration, 
                    'active' => $plans->active, 
                     
                ];
                return response()->json(['status'=>true, 'message'=>"Subscription updated successfully.",'data'=>$data,],200,[],JSON_NUMERIC_CHECK);

            }

           #function to create Subscription
           public function addSubscription(Request $request)
           {
               $sub = Subscription::create([
                   'user_id'=>$request->user_id,
                   'plan_id'=>$request->plan_id,
                   'start_date'=>$request->start_date,
                   'end_date'=>$request->end_date,
                  
               ]);

               if($sub->id)
               {
                   $result = array('status'=>true,'message'=>"Subscription created.",'data'=>$sub);
                   $responseCode=200;
               }else{
                   $result = array('status'=>false,'message'=>"Something went wrong.");
                   $responseCode=400;
               }
               return response()->json($result,$responseCode);



            }




             #function for get Subscription
             public function getSubscription()
             {
                 $sub = Subscription::all();
                 $data = array();
             foreach($sub as $row )
             {
                 $data[]=[
                     'id'=> $row->id,
                     'user_id'=> $row->user_id,
                     'plan_id'=> $row->plan_id,
                     'start_date'=> $row->start_date,
                     'end_date'=> $row->end_date,
                     
                 ];
             }
             $array = json_encode($data);
             $array = json_decode($array);
 
             if ($sub != null  ) {
                 return response()->json([
                     'status' => 'True',
                     'data' =>  $array,
          
                 ], 200, [], JSON_NUMERIC_CHECK);
             } else {
                 return response()->json(['status' => 'F', 'errorMsg' => 'data Not found'], 200);
             }
             }

              #function for edit Subscription
            public function updateSubscription(Request $request, $id)
            {
                $sub = Subscription::find($id);
                if(!$sub)
                {
                    return response()->json(['status'=>false, 'message'=>"Subscription not found"],404);
                }

            $sub->update([
                'user_id'=>$request->input('user_id'),
                'plan_id'=>$request->input('plan_id'),
                'start_date'=>$request->input('start_date'),
                'end_date'=>$request->input('end_date'),
               
            ]);
                $data = [
                    'id'=>$sub->id,
                    'user_id' => $sub->user_id,
                    'plan_id' => $sub->plan_id, 
                    'start_date' => $sub->start_date, 
                    'end_date' => $sub->end_date, 
                     
                ];
                return response()->json(['status'=>true, 'message'=>"Subscription updated successfully.",'data'=>$data,],200,[],JSON_NUMERIC_CHECK);

            }





            #function to fetch All state 
                public function getAllStates()
                {
                    $states = State::all(); 
            
                    return response()->json([
                        'success' => true,
                        'Count'=>count($states)." States are present.",
                        'states' => $states,
                    ], 200);
                }
            
                    # function to fetch all cities of a perticular state
        public function getCitiesByState(Request $request)
{
    $stateId = $request->get('state_id'); 

    
    if (!$stateId) {
        return response()->json([
            'success' => false,
            'message' => 'State ID is required.',
        ], 400);
    }
    $state = State::with('cities')->find($stateId);

    if (!$state) {
        return response()->json([
            'success' => false,
            'message' => 'State not found for the given ID.',
        ], 404);
    }
    # fetching all cities related to the state
    $cities = $state->cities; 

    return response()->json([
        'success' => true,
        'state_name' => $state->state_name, # Fetching  state name
        'message' => count($cities) . " cities are present in ". $state->state_name,
        'cities' => $cities,
    ], 200);
}
        # function to check user status
        public function userStatus(Request $request)
        {
            try {
                $request->validate([
                    'user_id' => 'required|exists:users,id',
                ]);
        
                $user = Users::select('active', 'subscription_id')
                    ->where('id', $request->user_id)
                    ->first();
        
                if ($user) {
                    return response()->json([
                        'status' => true,
                        'message' => 'User status fetched successfully.',
                        'data' => $user,
                    ], 200);
                }
        
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error.',
                    'errors' => $e->errors(),
                ], 422);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'An unexpected error occurred.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }



//         public function overlayOnPostVideo(Request $request, $id)
// {
//     $request->validate([
//         'user_id' => 'required|exists:profile,user_id',
//         'position' => 'nullable|string|in:1,2'
//     ]);

//     $userId = $request->input('user_id');
//     $position = $request->input('position', '1'); // Default to top-left

//     $post = Post::find($id);
//     if (!$post || !in_array(strtolower($post->type), ['video', 'custom_video'])) {
//         return response()->json(['status' => false, 'message' => 'Invalid or missing video post.'], 404);
//     }

//     $originalPath = public_path(str_replace(asset(''), '', $post->path_url));
//     if (!file_exists($originalPath)) {
//         return response()->json(['status' => false, 'message' => 'Original video file not found.'], 404);
//     }

//     $profile = Profile::where('user_id', $userId)->first();
//     if (!$profile) {
//         return response()->json(['status' => false, 'message' => 'Profile not found for given user.'], 404);
//     }

//     // Get the full path of the profile_logo image (assuming stored in storage/app/public)
//     if (!$profile->profile_logo) {
//         return response()->json(['status' => false, 'message' => 'Profile logo not found.'], 404);
//     }

//     $profileLogoPath = storage_path('app/public/' . $profile->profile_logo);
//     if (!file_exists($profileLogoPath)) {
//         return response()->json(['status' => false, 'message' => 'Profile logo file not found.'], 404);
//     }

//     $ffmpegPath = 'C:\\ffmpeg\\ffmpeg-7.1.1-essentials_build\\bin\\ffmpeg.exe';

//     $fileName = uniqid('video_overlay_') . '.mp4';
//     $processedRelPath = "videos/processed/{$fileName}";
//     $processedAbsPath = public_path("uploads/{$processedRelPath}");

//     if (!file_exists(dirname($processedAbsPath))) {
//         mkdir(dirname($processedAbsPath), 0777, true);
//     }

//     // Positions for overlay image
//     // Note: x,y coordinates for FFmpeg overlay filter
//     $positions = [
//         '1' => '10:10',              // top-left
//         '2' => '10:H-h-10',          // bottom-left
//     ];
//     $positionCmd = $positions[$position] ?? $positions['1'];

//     // FFmpeg command:
//     // -i original video
//     // -i profile logo image
//     // -filter_complex "overlay=x:y"
//     // copy audio stream without re-encoding: -c:a copy

//     $cmd = "\"{$ffmpegPath}\" -y -i \"{$originalPath}\" -i \"{$profileLogoPath}\" -filter_complex \"overlay={$positionCmd}\" -c:a copy \"{$processedAbsPath}\" 2>&1";

//     try {
//         exec($cmd, $output, $return);
//         if ($return !== 0) {
//             throw new \Exception("FFmpeg error: " . implode("\n", $output));
//         }

//         $publicUrl = asset("uploads/{$processedRelPath}");
//         $post->update([
//             'path_url' => $publicUrl,
//             'overlay_text' => null // or set any text you want here
//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Profile logo overlay applied successfully.',
//             'updated_video_url' => $publicUrl
//         ]);

//     } catch (\Exception $e) {
//         return response()->json([
//             'status' => false,
//             'message' => 'Failed to process video.',
//             'error' => $e->getMessage(),
//             'command' => $cmd
//         ], 500);
//     }
// }

// public function overlayOnPostVideo(Request $request, $id)
// {
//     $request->validate([
//         'user_id' => 'required|exists:profile,user_id',
//         'position' => 'nullable|string|in:1,2',
//         'logo_position' => 'nullable|string|in:1,2,3,4', // New: positions like 1=top-left, 2=bottom-left etc.
//     ]);

//     $userId = $request->input('user_id');
//     $position = $request->input('position', '1');
//     $logoPosition = $request->input('logo_position', '1');

//     $post = Post::find($id);
//     if (!$post || !in_array(strtolower($post->type), ['video', 'custom_video'])) {
//         return response()->json(['status' => false, 'message' => 'Invalid or missing video post.'], 404);
//     }

//     $originalPath = public_path(str_replace(asset(''), '', $post->path_url));
//     if (!file_exists($originalPath)) {
//         return response()->json(['status' => false, 'message' => 'Original video file not found.'], 404);
//     }

//     $profile = Profile::where('user_id', $userId)->first();
//     if (!$profile || !$profile->profile_logo) {
//         return response()->json(['status' => false, 'message' => 'Profile or profile logo not found.'], 404);
//     }

//     $profileLogoPath = storage_path('app/public/' . $profile->profile_logo);
//     if (!file_exists($profileLogoPath)) {
//         return response()->json(['status' => false, 'message' => 'Profile logo file not found.'], 404);
//     }

//     $ffmpegPath = 'C:\\ffmpeg\\ffmpeg-7.1.1-essentials_build\\bin\\ffmpeg.exe';
//     $fileName = uniqid('video_overlay_') . '.mp4';
//     $processedRelPath = "videos/processed/{$fileName}";
//     $processedAbsPath = public_path("uploads/{$processedRelPath}");

//     if (!file_exists(dirname($processedAbsPath))) {
//         mkdir(dirname($processedAbsPath), 0777, true);
//     }

//     // 🎯 Define logo overlay positions
//     $logoPositions = [
//         '1' => '10:10',               // top-left
//         '2' => '10:H-h-10',           // bottom-left
//         '3' => 'W-w-10:10',           // top-right
//         '4' => 'W-w-10:H-h-10',       // bottom-right
//     ];
//     $logoOverlayPos = $logoPositions[$logoPosition] ?? $logoPositions['1'];

//     // 🎯 Set logo size (default 100x100)
//     $logoWidth = $profile->logo_width ?? 100;
//     $logoHeight = $profile->logo_height ?? 100;

//     // ✅ FFmpeg Command with scale and overlay
//     $cmd = "\"{$ffmpegPath}\" -y -i \"{$originalPath}\" -i \"{$profileLogoPath}\" " .
//            "-filter_complex \"[1:v]scale={$logoWidth}:{$logoHeight}[logo];[0:v][logo]overlay={$logoOverlayPos}\" " .
//            "-c:a copy \"{$processedAbsPath}\" 2>&1";

//     try {
//         exec($cmd, $output, $return);
//         if ($return !== 0) {
//             throw new \Exception("FFmpeg error: " . implode("\n", $output));
//         }

//         $publicUrl = asset("uploads/{$processedRelPath}");
//         $post->update([
//             'path_url' => $publicUrl,
//             'overlay_text' => null
//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Profile logo overlay applied successfully.',
//             'updated_video_url' => $publicUrl
//         ]);

//     } catch (\Exception $e) {
//         return response()->json([
//             'status' => false,
//             'message' => 'Failed to process video.',
//             'error' => $e->getMessage(),
//             'command' => $cmd
//         ], 500);
//     }
// }

           


// public function overlayOnPostVideo(Request $request, $id)
// {
//     $request->validate([
//         'user_id' => 'required|exists:profile,user_id',
//         'position' => 'nullable|string|in:1,2',
//     ]);

//     $userId = $request->input('user_id');
//     $position = $request->input('position', '2'); // 1 = top, 2 = bottom

//     // Fetch post
//     $post = Post::find($id);
//     if (!$post || !in_array(strtolower($post->type), ['video', 'custom_video'])) {
//         return response()->json(['status' => false, 'message' => 'Invalid or missing video post.'], 404);
//     }

//     // Resolve video path
//     $originalPath = public_path(str_replace(asset(''), '', $post->path_url));
//     if (!file_exists($originalPath)) {
//         Log::error("Original video file not found: {$originalPath}");
//         return response()->json(['status' => false, 'message' => 'Original video file not found.'], 404);
//     }

//     // Fetch profile
//     $profile = Profile::where('user_id', $userId)->first();
//     if (!$profile || !$profile->profile_logo) {
//         return response()->json(['status' => false, 'message' => 'Profile or profile logo not found.'], 404);
//     }

//     // Resolve logo path
//     $profileLogoPath = Storage::disk('public')->path($profile->profile_logo);
//     if (!file_exists($profileLogoPath)) {
//         Log::error("Profile logo file not found: {$profileLogoPath}");
//         return response()->json(['status' => false, 'message' => 'Profile logo file not found.'], 404);
//     }

//     // Text styling
//     $textColor = $post->text_color ?? 'white';
//     $bgColor = $post->background_color ?? 'black@0.5'; // transparent dark background
//     $textSize = $post->text_size ?? 20;
//     $fontSizeMap = [1 => 24, 2 => 28, 3 => 32, 4 =>36 , 5 => 40];
//     $fontSize = $fontSizeMap[$textSize] ?? 24;

//     // FFmpeg path
//     $ffmpegPath = env('FFMPEG_PATH', 'C:\\ffmpeg\\ffmpeg-7.1.1-essentials_build\\bin\\ffmpeg.exe');
//     $fileName = uniqid('video_overlay_') . '.mp4';
//     $processedRelPath = "videos/processed/{$fileName}";
//     $processedAbsPath = public_path("uploads/{$processedRelPath}");

//     if (!file_exists(dirname($processedAbsPath))) {
//         mkdir(dirname($processedAbsPath), 0755, true);
//     }

//     // Fetch logo position from post
//     $logoPosition = $post->logo_position ?? '1';
//     $logoPositions = [
//         '1' => '10:10',
//         '3' => '10:main_h-overlay_h-10',
//         '2' => 'main_w-overlay_w-10:10',
//         '4' => 'main_w-overlay_w-10:main_h-overlay_h-10',
//     ];
//     $logoOverlayPos = $logoPositions[$logoPosition] ?? $logoPositions['1'];

//     // Logo size
//     $logoWidth = $profile->logo_width ?? 200;
//     $logoHeight = $profile->logo_height ?? 200;

//     // Sanitize paths
//     $originalPath = escapeshellarg($originalPath);
//     $profileLogoPath = escapeshellarg($profileLogoPath);
//     $processedAbsPath = escapeshellarg($processedAbsPath);

//     // Base FFmpeg command
//     $cmd = "\"{$ffmpegPath}\" -y -i {$originalPath} -i {$profileLogoPath} ";
//     $filterComplex = "[1:v]scale={$logoWidth}:{$logoHeight}[logo];[0:v][logo]overlay={$logoOverlayPos}";

//     // Text fields combined in one line
//     $textFields = [
//         $profile->bussiness_name,
//         $profile->website,
//         $profile->instagram_facebook,
//         $profile->address,
//         $profile->whatsappno,
//     ];
//     $inlineText = collect($textFields)->filter()->implode(' | ');
//     $escapedText = $this->escapeForDrawtext($inlineText);

//     // Set Y position
//     $textY = $position === '1' ? 50 : 'main_h-60';

//     // Add drawtext
//     $filterComplex .= ",drawtext=text='{$escapedText}':x=10:y={$textY}:fontsize={$fontSize}:fontcolor={$textColor}:box=1:boxcolor={$bgColor}:boxborderw=5";

//     // Final command
//     $cmd .= "-filter_complex \"{$filterComplex}\" -c:a copy {$processedAbsPath} 2>&1";

//     try {
//         exec($cmd, $output, $return);
//         if ($return !== 0) {
//             Log::error("FFmpeg failed: " . implode("\n", $output));
//             throw new \Exception("FFmpeg processing failed: " . implode("\n", $output));
//         }

//         $publicUrl = asset("uploads/{$processedRelPath}");
//         $post->update([
//             'path_url' => $publicUrl,
//             'overlay_text' => null,
//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Profile logo and user info overlaid successfully.',
//             'updated_video_url' => $publicUrl,
//         ], 200);

//     } catch (\Exception $e) {
//         Log::error("Overlay processing error: {$e->getMessage()}");
//         return response()->json([
//             'status' => false,
//             'message' => 'Failed to process video.',
//             'error' => $e->getMessage(),
//             'command' => $cmd,
//         ], 500);
//     }
// }
        
     private function escapeForDrawtext(string $text): string
    {
        $text = str_replace(
            ['\\', "'", ':', ',', '%', '|', '\n'],
            ['\\\\', "\\'", '\\:', '\\,', '\\%', '\\|', '\\n'],
            $text
        );
        // Remove unsupported characters (e.g., emojis)
        $text = preg_replace('/[\x{1F600}-\x{1F6FF}]/u', '', $text);
        return $text;
    }

    public function overlayOnPostVideo(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:profile,user_id',
            'position' => 'nullable|string|in:1,2',
        ]);

        $userId = $request->input('user_id');
        $position = $request->input('position', '2'); // 1 = top, 2 = bottom

        // Fetch post
        $post = Post::find($id);
        if (!$post || !in_array(strtolower($post->type), ['video', 'custom_video'])) {
            Log::error("Invalid or missing video post: {$id}");
            return response()->json(['status' => false, 'message' => 'Invalid or missing video post.'], 404);
        }

        // Resolve video path
        $originalPath = public_path(str_replace(asset(''), '', $post->path_url));
        if (!file_exists($originalPath)) {
            Log::error("Original video file not found: {$originalPath}");
            return response()->json(['status' => false, 'message' => 'Original video file not found.'], 404);
        }

        // Fetch profile
        $profile = Profile::where('user_id', $userId)->first();
        if (!$profile || !isset($profile->profile_logo)) {
            return response()->json(['status' => false, 'message' => 'Profile or profile logo not found.'], 404);
        }

        // Resolve logo path
        $profileLogoPath = Storage::disk('public')->path($profile->profile_logo);
        if (!file_exists($profileLogoPath)) {
            Log::error("Profile logo not found: {$profileLogoPath}");
            return response()->json(['status' => false, 'message' => 'Profile logo not found.'], 404);
        }

        // Fetch video resolution
        $ffprobePath = env('FFPROBE_PATH', 'C:\\ffmpeg\\ffprobe.exe');
        $probeCmd = "\"{$ffprobePath}\" -v error -select_streams v:0 -show_entries stream=width,height -of json {$originalPath}";
        $probeOutput = shell_exec($probeCmd);
        $videoInfo = json_decode($probeOutput, true);
        $videoWidth = $videoInfo['streams'][0]['width'] ?? 1280;
        $videoHeight = $videoInfo['streams'][0]['height'] ?? 720;

        // Text styling
        $textColor = $post->text_color ?? 'blue'; // Default to blue (#0000FF)
        // Convert text color to hex
        $colorMap = [
            'white' => '#FFFFFF',
            'black' => '#000000',
            'red' => '#FF0000',
            'blue' => '#0000FF',
            'green' => '#00FF00',
            'yellow' => '#FFFF00',
        ];
        $textColor = $colorMap[strtolower(trim($textColor))] ?? (preg_match('/^#[0-9A-Fa-f]{6}$/', $textColor) ? $textColor : '#0000FF');

        // Background color
        $bgColor = $post->bg_color ?? '0x00000000'; // Default to transparent
        if ($bgColor && !preg_match('/^0x[0-9A-Fa-f]{8}$/', $bgColor)) {
            $bgColorMap = [
                'white' => '0xFFFFFF80',
                'black' => '0x00000080',
                'red' => '0xFF000080', // Semi-transparent red
                'blue' => '0x0000FF80',
                'green' => '0x00FF0080',
                'yellow' => '0xFFFF0080',
            ];
            $bgColor = $bgColorMap[strtolower(trim($bgColor))] ?? '0x00000000';
        }

        $textSize = $post->text_size ?? 20;
        $fontSizeMap = [1 => 18, 2 => 22, 3 => 26, 4 => 30, 5 => 34];
        $fontSize = min($fontSizeMap[$textSize] ?? 24, floor($videoWidth * 0.02));

        // FFmpeg setup
        $ffmpegPath = env('FFMPEG_PATH', 'C:\\ffmpeg\\ffmpeg-7.1.1-essentials_build\\bin\\ffmpeg.exe');
        $fileName = uniqid('video_overlay_') . '.mp4';
        $processedRelPath = "videos/processed/{$fileName}";
        $processedAbsPath = public_path("uploads/{$processedRelPath}");

        if (!file_exists(dirname($processedAbsPath))) {
            mkdir(dirname($processedAbsPath), 0755, true);
        }

        // Logo position
        $logoPosition = $post->logo_position ?? '1';
        $logoPositions = [
            '1' => '10:10',
            '2' => 'main_w-overlay_w-10:10',
            '3' => '10:main_h-overlay_h-10',
            '4' => 'main_w-overlay_w-10:main_h-overlay_h-10',
        ];
        $logoOverlayPos = $logoPositions[$logoPosition] ?? $logoPositions['1'];

        // Logo size
        $logoWidth = $profile->logo_width ?? 130;
        $logoHeight = $profile->logo_height ?? 130;

        // Sanitize paths
        $originalPath = escapeshellarg($originalPath);
        $profileLogoPath = escapeshellarg($profileLogoPath);
        $processedAbsPath = escapeshellarg($processedAbsPath);

        // Combined text with line breaks
        $textFields = [
            $profile->business_name ?? '',
            $profile->website ?? '',
            $profile->instagram_facebook ?? '',
            $profile->address ?? '',
            $profile->whatsappno ?? '',
        ];
        $inlineText = collect($textFields)->filter()->implode(' | ');

        // Split text into lines (max 50 chars per line)
        $maxLineLength = 50;
        $words = explode(' ', $inlineText);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            if (strlen($currentLine . ' ' . $word) <= $maxLineLength) {
                $currentLine .= ($currentLine ? ' ' : '') . $word;
            } else {
                $lines[] = $currentLine;
                $currentLine = $word;
            }
        }
        if ($currentLine) {
            $lines[] = $currentLine;
        }

        $escapedText = $this->escapeForDrawtext(implode('\n', $lines));

        // Text position
        $textX = 20;
        $lineCount = count($lines);
        $textY = $position === '1' ? 50 : "main_h-".(50 + ($lineCount * ($fontSize + 10)));

        // Start FFmpeg command
        $cmd = "\"{$ffmpegPath}\" -y -i {$originalPath} -i {$profileLogoPath} ";

        // Filters: overlay logo + text
        $filterComplex = "[1:v]scale={$logoWidth}:{$logoHeight}[logo];[0:v][logo]overlay={$logoOverlayPos}";
        $filterComplex .= ",drawtext=font='Arial':text='{$escapedText}':x={$textX}:y={$textY}:fontsize={$fontSize}:fontcolor={$textColor}:box=1:boxcolor={$bgColor}:boxborderw=5";

        // Final FFmpeg command
        $cmd .= "-filter_complex \"{$filterComplex}\" -c:v libx264 -preset fast -pix_fmt yuv420p -c:a copy {$processedAbsPath} 2>&1";

        Log::debug("FFmpeg Command: {$cmd}");
        Log::debug("Filter Complex: {$filterComplex}");
        Log::debug("Text Color: {$textColor}, Background Color: {$bgColor}");

        try {
            exec($cmd, $output, $return);
            if ($return !== 0) {
                Log::error("FFmpeg failed: " . implode("\n", $output));
                throw new \Exception("FFmpeg processing failed: " . implode("\n", $output));
            }

            $publicUrl = asset("uploads/{$processedRelPath}");
            $post->update([
                'path_url' => $publicUrl,
                'overlay_text' => null,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Profile logo and user info overlaid successfully.',
                'updated_video_url' => $publicUrl,
            ], 200);

        } catch (\Exception $e) {
            Log::error("Overlay processing error: {$e->getMessage()}");
            return response()->json([
                'status' => false,
                'message' => 'Failed to process video.',
                'error' => $e->getMessage(),
                'command' => $cmd,
            ], 500);
        }
    }




}

