<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;



class CategoryController extends Controller
{
    #function to show categiry
    public function showCategroy()
    {
        $cat = Category::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        return view('category', compact('cat'));
    }
   
    #function to load categiry
    public function addCategroy()
   {        $categories = Category::all(); 
    return view('addCategory', compact('categories')); 

        // return view('addCategory');
   }

     #function to insert category
    //  public function createCategroy(Request $request)
    //  {    
    //      $param = $request->all();
    //      unset($param['_token']);
    //      Category::create($param);
        
    //      //  return redirect()->route('create-category')->withStatus("Category added successfully.");

    //      return redirect()->route('adding-category')->with('success',"Category added successfully.");
         
    //  }  

    public function createCategroy(Request $request)
    {    
        $param = $request->all();
        unset($param['_token']);
    
        // Handle image upload (store path in DB)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/cat_images'), $imageName);
            $param['image'] = 'uploads/cat_images/' . $imageName; // Save path in DB
        }
    
        Category::create($param);
    
        return redirect()->route('adding-category')->with('success', "Category added successfully.");
    }
    
    




       #function to edit categiry
    public function editCategroy($id)
    {   
    //  $cat = Category::find($id);
    //      return view('editCategory' , compact('cat') );

        $allCategories = Category::where('active', 1)->get();
        $cat = Category::find($id); 
        return view('editCategory', compact('allCategories', 'cat'));

    }
    // public function updateCategroy($id,Request $request)
    // {
    //     $cat= $request->all();
    //     unset($cat['_token']);
    //     Category::where('id', $id)->update($cat);
    //     return redirect()->route('category.show')->with('success',"Category updated successfully.");

    // }
    public function updateCategroy($id, Request $request)
{
    $cat = $request->except('_token');

    // Handle image upload if a new image is selected
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/cat_images'), $imageName);
        $cat['image'] = 'uploads/cat_images/' . $imageName;
    }

    Category::where('id', $id)->update($cat);

    return redirect()->route('category.show')->with('success', "Category updated successfully.");
}

    
 #for delete
 public function index()
 {
     $category = Category::all(); 
     return view('category', compact('category')); 
 }

 public function destroy($id)
 {
     $category = Category::findOrFail($id); 
     $category->delete(); 

     return redirect()->route('category.show')->with('success', 'Category deleted successfully.');
 }


      #function to show post
      public function getPost()
      {
          $post = Post::all();
          return view('post', compact('post'));
      }
    
      # for active button
      public function updateStatus(Request $request)
      {
          $request->validate([
              'id' => 'required|integer',
              'active' => 'required|boolean',
          ]);
      
          // Use the correct variable name
          $category = Category::find($request->id);
      
          if ($category) {
              // Update the active status
              $category->active = $request->active;
              $category->save();
      
              return redirect()->back()->with('success', 'Status updated successfully!');
            } else {
                // Redirect back with an error message if not found
                return redirect()->back()->with('error', 'Category not found!');
            }
      }




}
