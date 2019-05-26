<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Session;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function make(Request $request)
    {
        
        $this->validate($request,[
            'url' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);

        $exists=Link::where('url',$request->url);
        $code=null;
        if($exists->count()>0){
            $code=$exists->first()->code;
        }
        else{
            $created= Link::create([
                'url'=>$request->url,
                'code'=>""
            ]);

            $code=base_convert($created->id,10,36);
                Link::where('id',$created->id)->update(array(
                    'code'=>$code
                ));
            
        }
        return redirect('/')->with('code',$code);

    }

    public function get($code)
    {
        $link=Link::where('code',$code);
        if($link->count()>0){
            return Redirect::to($link->first()->url);
        }
        else{
            return redirect('/')->with('bad','bad request');
        }
    }
}
