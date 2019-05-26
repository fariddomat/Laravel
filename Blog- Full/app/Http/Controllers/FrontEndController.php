<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use App\Category;
use App\Post;
use App\Tag;
use App\email_subscribes;
use Session;

class FrontEndController extends Controller
{
    public function index()
    {
        $title=Settings::first()->site_name;
        $settings=Settings::first();

        $categories=Category::take(5)->get();

        //first viewed one is the last added post to db
        $firstPost=Post::orderBy('created_at','desc')->first();
        $secondPost=Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first();
        $thirdPost=Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first();
        
        $career=Category::find(7);
        $tutorial=Category::find(6);
        return view('index',compact('title','settings','categories','firstPost','secondPost','thirdPost','career','tutorial'));
    }



    public function singlePost($slug)
    {
        $post=Post::where('slug',$slug)->first();

        $next_id=Post::where('id','>',$post->id)->min('id');
        $next=Post::find($next_id);
        $prev_id=Post::where('id','<',$post->id)->max('id');
        $prev=Post::find($prev_id);

        $title=$post->title;
        $categories=Category::take(5)->get();
        $settings=Settings::first();
        $tags=Tag::all();
        return view('single',compact('post','next','prev','title','categories','settings','tags'));
    }

    public function category($id)
    {
        $category=Category::find($id);
        $title=$category->name;
        $settings=Settings::first();
        $categories=Category::take(5)->get();

        return view('category',compact('category','title','settings','categories'));
    }
    public function tag($id)
    {
        $tag=Tag::find($id);
        $category=Category::find($id);
        $title=$tag->tag;
        $settings=Settings::first();
        $categories=Category::take(5)->get();

        return view('tag',compact('tag','category','title','settings','categories'));
    }

    public function search(Request $request)
    {
        
    //dd(request('query'));
    $posts=Post::where('title','like','%'.request('query').'%')->get();
    
    $settings=Settings::first();
    $title='Search results :'.request('query');
    $categories=Category::take(5)->get();
    //dd($posts);
    return view('results',compact('posts','title','settings','categories'));
    }

    public function email_subscripe(Request $request)
    {
        $this->validate($request,[
            'email'=>'required | email',
        ]);

        $email_s= email_subscribes::create([
            'email'=>$request->email,
        ]);

        Session::flash('success','Your email have been subscribed successfully.');
        return redirect()->back();
    }
}