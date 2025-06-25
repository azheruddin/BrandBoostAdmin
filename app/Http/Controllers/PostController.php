<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 
use App\Models\CustomPost; 
use App\Models\Category; 


class PostController extends Controller
{
      #show post
      public function showPost(Request $request)
      {
          $categoryFilter = $request->input('category_id'); 
          $allCategories = Category::where('active', 1)->get();
          $post = Post::with('category')
                      ->when($categoryFilter, function ($query) use ($categoryFilter) {
                          return $query->whereHas('category', function ($query) use ($categoryFilter) {
                              $query->where('id', $categoryFilter);
                          });
                      })
                      ->where('type', 'image')
                      ->orderBy('id', 'DESC')
                      ->get();
          return view('post.show', compact('post', 'allCategories'));
  
  
              
  
      }
    
    
    #show Video
    public function showVideo()
    {
       
        // $post = Post::where('type', 'video')->orderBy('id', 'DESC')->get();
        $post=Post::with('category')->where('type','video')->orderBy('id','DESC')->get();

        return view('post.showvideo', compact('post'));
    }

     # function to load custom Post
   public function addCp()
   {
    // $categories = Category::where('active', 1  )->get();
    
    return view('post.customPost'); 

  
   }

#function to insert custom post
public function storeCustomPost(Request $request)
{
    $request->validate([
        'type' => 'required|string|max:255',
        'image' => 'required|image|max:2048', 
    ]);

    try {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/images'), $imageName);
            $imagePath = url('uploads/images/' . $imageName); 
        } else {
            $imagePath = null;
        }

        $customPost = CustomPost::create([
            'type' => $request->type,
            'image' => $imagePath, 
        ]);

        return redirect()->back()->with('success', 'Custom post added successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Failed to add custom post.'])->withInput();
    }
}



   public function addPost()
   {
    $categories = Category::where('active', 1  )->get();
    
    return view('post.add', compact('categories')); 

  
   }
   public function insertPost(Request $request)
{
    $param = $request->all();
    
    // Handle the image and video upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/images'), $imageName);
        $param['image'] = 'uploads/images/' . $imageName;
    }
    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('uploads/videos'), $videoName);
        $param['path_url'] = 'uploads/videos/' . $videoName; 
    }

    

    Post::create($param);

    return redirect()->route('add-post')->with('success', "Post added successfully.");
}




    #for delete
    public function index()
    {
        $post = Post::all(); 
        return view('post.show', compact('post')); 
    }

    public function destroyPost($id)
    {   
        $post = Post::findOrFail($id); 
        $post->delete(); 

        return redirect()->route('show-post')->with('success', 'Post deleted successfully.');
    }
      #for delete video
      public function indexVid()
      {
          $post = Post::all(); 
          return view('post.showvideo', compact('post')); 
      }
    public function destroyVideo($id)
    {   
        $post = Post::findOrFail($id); 
        $post->delete(); 

        return redirect()->route('show-video')->with('success', 'Post deleted successfully.');
    }

    #filter
// public function filterPosts(Request $request)
// {
//     $categoryFilter = $request->input('category'); // Use 'category' as it's referenced in the form
//     $allCategories = Category::where('active', 1)->get();

//     $posts = $categoryFilter 
//                 ? Post::whereHas('category', function ($query) use ($categoryFilter) {
//                     $query->where('category', $categoryFilter);
//                   })->get()
//                 : Post::all();

//     return view('post.show', compact('posts', 'allCategories'));
// }





   
   
}
