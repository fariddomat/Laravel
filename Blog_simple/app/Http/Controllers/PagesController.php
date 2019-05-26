<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Role;
use App\Like;
use DB;
class PagesController extends Controller
{
    //
     public function posts()
    {
        $posts=Post::all();
        
        //dd($posts->first()->user->name);
        return view('content.posts',compact('posts'));
    }

    public function post($id)
    {
        $post=Post::all()->find($id); 
        $stop_comment=DB::table('settings')->where('name','stop_comment')->value('value');
        
        $user =  User::find($post->user_id);
        return view('content.post',compact('post','stop_comment'));
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'title'=>'required | min:5',
            'body'=>'required',
            'url'=>'required| image | mimes:jpg,jpeg,gif,png|max:2048',
            
        ]);

        $img_name=time().'.'.$request->url->getClientOriginalExtension();

        $request->url->move(public_path('upload'),$img_name);

        //Post::create(request()->all());



        
        $post = new Post;
        $post->title=request('title');
        $post->body=request('body');
        $post->url=$img_name;
        $post->user_id= Auth::user()->id;
        $post->save();
        
        return redirect('/posts');
        
    }
    public function category( $name)
    {
        
        $cat=DB::table('categories')->where('name',$name)->value('id');
        $posts=DB::table('posts')->where('category_id',$cat)->get();
        return view('content.category',compact('posts'));
    }

    public function admin( )
    {
        $users=User::all();
        $stop_comment=DB::table('settings')->where('name','stop_comment')->value('value');
        return view('content.admin',compact('users','stop_comment'));
    }
    public function addrole(Request $request)
    {
        $user = User::where('email',$request['email'])->first();
       
        $user->roles()->detach();
        
        if($request['role_user']){
            //dd('farid');
            $user->roles()->attach(Role::where('name','User')->first());

        }
        if($request['role_editor']){
            $user->roles()->attach(Role::where('name','Editor')->first());
        }
        if($request['role_admin']){
            $user->roles()->attach(Role::where('name','Admin')->first());
        }

        return redirect()->back();

    }
    public function editor( )
    {
        
        return view('content.editor');
    }

    public function accessDenied()
    {
        return view('content.access_denied');
    }

    public function like(Request $request)
    {
        
        $like_s=$request->like_s;
        $post_id=$request->post_id;
        
        $change_like=0;
       
        $like=DB::table('likes')
            ->where('post_id',$post_id)
            ->where('user_id',Auth::user()->id)
            ->first();
        
        if(!$like){
            

            $new_like=Like::create([
                'user_id'=> Auth::user()->id,
                'post_id'=>request('post_id'),
                'like'=>'1',
            ]);
            
            $is_like=1;
            
        }
        elseif($like->like==1){
            DB::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->delete();

            $is_like=0;
        }
        elseif($like->like==0){
            Db::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->update(['like'=>'1']);
            $is_like=1;

            $change_like=1;
        }

        $response=array(
            'is_like'=> $is_like,
            'change_like'=>$change_like,
        );
        //send data to javascript
        return response()->json($response,200);
    }

    public function dislike(Request $request)
    {
        
        $like_s=$request->like_s;
        $post_id=$request->post_id;
        $change_dislike=0;
       
        $dislike=DB::table('likes')
            ->where('post_id',$post_id)
            ->where('user_id',Auth::user()->id)
            ->first();
        
        if(!$dislike){
            

            $new_like=Like::create([
                'user_id'=> Auth::user()->id,
                'post_id'=>request('post_id'),
                'like'=>'0',
            ]);
            $is_dislike=1;
            
        }
        elseif($dislike->like==0){
            DB::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->delete();

            $is_dislike=0;
        }
        elseif($dislike->like==1){
            Db::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',Auth::user()->id)
                ->update(['like'=>'0']);
                
            $is_dislike=1;
            $change_dislike=1;
        }

        $response=array(
            'is_dislike'=> $is_dislike,
            'change_dislike'=>$change_dislike,
        );
        //send data to javascript
        return response()->json($response,200);
    }

    public function statistics()
    {
        $users=DB::table('users')->count();
        $posts=DB::table('posts')->count();
        $comments=DB::table('comments')->count();

        $most_comments=User::withCount('comments')
            ->orderBy('comments_count','desc')
            ->first();

        $likes_count_1=DB::table('likes')->where('user_id',$most_comments->id)->count();
        $user_1_count= $most_comments->comments_count + $likes_count_1;      
        
        $most_likes=User::withCount('likes')
            ->orderBy('likes_count','desc')
            ->first();
        $comments_count_2=DB::table('comments')->where('user_id',$most_likes->id)->count();
        $user_2_count= $most_likes->likes_count + $comments_count_2;      
            
        if($user_1_count >$user_2_count){
            $active_user=$most_comments->name;
            $active_user_likes= $likes_count_1;
            $active_user_comments=$most_comments->comments_count;
        }else{
            $active_user=$most_likes->name;
            $active_user_likes= $most_likes->likes_count ;
            $active_user_comments=$comments_count_2;

        }
        $statistics=array(
            'users'=>$users,
            'posts'=>$posts,
            'comments'=>$comments,
            'active_user'=>$active_user,
            'active_user_likes'=>$active_user_likes,
            'active_user_comments'=>$active_user_comments,
            
        );
        //dd($statistics);
        

        return view('content.statistics',compact('statistics'));
    }

    public function stop_comment(Request $request)
    {
       if( $request->stop_comment){
            DB::table('settings')
                ->where('name','stop_comment')
                ->update(['value'=>1]);
       }else{
            DB::table('settings')
                ->where('name','stop_comment')
                ->update(['value'=>0]);
       }
        return redirect()->back();
    }
}








