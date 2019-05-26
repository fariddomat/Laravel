<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;
use App\Tag;
use Auth;

class PostsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();

        if($categories->count()==0){
            Session::flash('update','you must have some categories before create a post');
            return redirect()->back();
        }

        else
        if($tags->count()==0){
            Session::flash('update','you must have some Tags before create a post');
            return redirect()->back();
        }
    
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required | max:255',
            'featured'=>'required | image',
            'content'=>'required',
            'category_id'=>'required',
            'tags'=>'required'
        ]);

        $featured=$request->featured;
        $featured_new_name=time().$featured->getClientOriginalName();
        $featured->move('uploads/posts',$featured_new_name);
        
        $post= Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'featured'=>'uploads/posts/'.$featured_new_name,
            'category_id'=>$request->category_id,
            'slug'=>str_slug($request->title),
            'user_id'=>Auth::id()
        ]);

        $post->tags()->attach($request->tags);

        Session::flash('success','Post created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $tags=Tag::all();

        $categories=Category::all();
        return view('admin.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'category_id'=>'required',
            'tags'=>'required'
        ]);

        $post=Post::find($id);
        

        if($request->hasFile('featured')){
            $featured=$request->featured;
            $featured_new_name=time().$featured->getClientOriginalName();
            $featured->move('uploads/posts',$featured_new_name);
            $post->featured='uploads/posts/'.$featured_new_name;
        }
        $post= Post::whereId($id)->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'featured'=>$post->featured,
            'category_id'=>$request->category_id,
            'slug'=>str_slug($request->title)
        ]);
        $post=Post::find($id);

        $post->tags()->sync($request->tags,false);

        Session::flash('success','Your Post was just Updated');


        return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        $post->delete();

        Session::flash('success','Your Post was just trashed');

        return redirect()->back();
    }

    //get Trashed Post
    public function trashed()
    {
        $posts=Post::onlyTrashed()->get();

        return view('admin.post.trashed',compact('posts'));
    }

    //permanetly delete
    public function kill($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();

        $post->forceDelete();
        

        Session::flash('success','Your Post was just deleted permanetly');

        return redirect()->back();

    }

    public function restore($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();

        $post->restore();
        
        Session::flash('success','Your Post restored successfully');

        return redirect()->back();

    }
}
