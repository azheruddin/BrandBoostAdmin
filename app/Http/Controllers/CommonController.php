<?php

namespace App\Http\Controllers;
use App\Models\Users; 
use App\Models\User; 
use App\Models\Category;
use App\Models\Post;
use App\Models\Plans;
use App\Models\Distributor;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function dash()
    {
        if (!auth()->check()) {
            dd('User not logged in!');
        }
        $totalUserCount = Users::count();
        $userActiveCount = Users::where('active',1)->count();
        $userInactiveCount = Users::where('active',0)->count();
        $catActiveCount = Category::where('active',1)->count();
        $catInactiveCount = Category::where('active',0)->count();
        $totalCatCount = Category::count();
        $distActiveCount = Distributor::where('active',1)->count();
        $distInactiveCount = Distributor::where('active',0)->count();
        $totalDistCount  = Distributor::count();
        $imageCount = Post::where('type','image')->count();
        $videoCount = Post::where('type','video')->count();
        $totalPostCount = Post::count();
        $activePlans = Plans::where('active','1')->count();
        $inActivePlans = Plans::where('active','1')->count();
        $totalPlans = Plans::count();
        return view('dashboard', compact('totalUserCount','userActiveCount','userInactiveCount', 'catActiveCount','catInactiveCount','totalCatCount'
        , 'totalDistCount','distInactiveCount','distActiveCount','imageCount','videoCount','totalPostCount','activePlans','inActivePlans','totalPlans'));

        




    }

}
