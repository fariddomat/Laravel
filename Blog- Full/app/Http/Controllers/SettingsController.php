<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use Session;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $settings=Settings::first();
        return view('admin.settings.settings',compact('settings'));

    }

    public function update()
    {
        $this->validate(request(),[
            'site_name'=>'required',
            'number'=>'required',
            'email'=>'required | email',
            'address'=>'required',
        ]);
        $settings=Settings::first();

        $settings->update([
            'site_name'=>request()->site_name,
            'contact_number'=>request()->number,
            'contact_email'=>request()->email,
            'address'=>request()->address,
        ]);

        
        Session::flash('success','Your Settings was just Updated');


        return redirect()->back();
    }
}
