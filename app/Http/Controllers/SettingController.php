<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       $settings = Setting::all()->toArray();
        if(count($settings)>0)
        {$setting = Setting::find($settings[0]['id']);}
        else
        {$setting=0;}
        return view('setting.index')->with(compact('setting', 'settings'));
    }

    public function index_listing()
    {
       $settings = Setting::all()->toArray();
       return view('setting.index_listing', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings = new Setting;
        $settings->name=$request->name;
        $settings->value=$request->value;
        $settings->option=(is_null($request->option) || empty($request->option) || strlen($request->option) < 1 ? NULL : $request->option);
        $settings->section=$request->section;
        $settings->status=$request->status;
        $settings->save();
        return redirect('/setting/index_listing');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        //
        $setting = Setting::find($id);
        $settings = Setting::all()->toArray();
        return view('setting.index')->with(compact('setting', 'settings'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit
        $setting = Setting::find($id);

        return view('setting.edit', compact('setting','id'));
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
        //
        $setting = Setting::find($id);
        $setting->name = $request->get('name');
        $setting->value = $request->get('value');
        $setting->status = $request->get('status');
        $setting->option=(is_null($request->get('option')) || empty($request->get('option')) || strlen($request->get('option')) < 1 ? NULL : $request->get('option'));
        $setting->section = $request->get('section');
        $setting->save();
        return redirect('/setting/index_listing');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $setting = Setting::find($id);
        $setting->delete();

        return redirect('/setting/index_listing');
    }
}
