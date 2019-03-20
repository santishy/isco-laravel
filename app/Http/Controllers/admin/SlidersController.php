<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Validator;
use App\Slider;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('dashboard.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages=['image'=>'El :attribute tiene que ser una imagen',
                    'dimensions'=>'Las dimensiones de :attribute tienen que ser de 3200 x 800 width-height','required'=>'El :attribute es un campo requerido'];
        $validator=Validator::make($request->all(),[
            'slider'=>['image','required','dimensions:width=3200,height=800'],
            'name'=>['required'],
            ],$messages);
        if(!$validator->fails()){
            if($request->hasFile('slider'))
                if($request->file('slider')->isValid()){
                    $slider=Slider::create(['name'=>$request->name,'extension'=>$request->slider->extension(),'link'=>$request->link]);              
                    \Storage::disk('public')->putFileAs('sliders',$request->file('slider'),$request->name.'.'.$request->slider->extension());
                    //\Storage::setVisibility('sliders/'.$request->file('slider'),'public');

                }
        }
        
        return view('dashboard.sliders.create',['errors'=>$validator->errors()]);
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
        //
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
    }
}
