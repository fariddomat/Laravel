<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /*
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts_count=Post::all()->count();
        $trashed_count=Post::onlyTrashed()->get()->count();
        $users_count=User::all()->count();
        $cat_count=Category::all()->count();
        return view('home',compact('posts_count','trashed_count','users_count','cat_count'));
    }
}
