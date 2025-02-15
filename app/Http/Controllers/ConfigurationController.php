<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(Configuration $configuration,$id)
    {
        if (Auth::user()->role == 'Admin') {
            $profile = Configuration::find($id);
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.configurations.editconfiguration', compact('profile','config'));
        } else {
            return Redirect('/admin');
        }
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'address' => 'required',
            'site_title' =>'required',
            'site_name' => 'required',
            'zipcode' => 'required',
            'mobno' => 'required'
        ]);
        $profile = Configuration::find($id);
        if ($request->site_logo == "") {
            $imageName = $profile->site_logo;
        } else {
            $imageName = $request->site_logo->getClientOriginalName();
            $imagexxName = time() . '.' . $request->site_logo->extension();
            $request->site_logo->move(public_path('images/profile'), $imageName);
            $profile->site_logo = $imageName;
        }
        if ($request->favicon_icon == "") {
            $imageName1 = $profile->favicon_icon;
        } else {
            $imageName1 = $request->favicon_icon->getClientOriginalName();
            $imagexxName1 = time() . '.' . $request->favicon_icon->extension();
            $request->favicon_icon->move(public_path('images/profile'), $imageName1);
            $profile->favicon_icon = $imageName1;
        }
        $profile->company_name = $request->get('company_name');
        $profile->vat_number = $request->get('vat_number');
        $profile->city = $request->get('city');
        $profile->mobno = $request->get('mobno');
        $profile->state = $request->get('state');
        $profile->country = $request->get('country');
        $profile->address = $request->get('address');
        $profile->site_name = $request->get('site_name');
        $profile->site_title = $request->get('site_title');
        $profile->zipcode = $request->get('zipcode');
        $profile->save();
        return redirect('configuration1')->with('message', 'Record updated successfully!');
    }


    public function destroy(Configuration $configuration)
    {
        //
    }
}
