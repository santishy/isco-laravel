<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utility; 
use Illuminate\Validation\Rule;
use Validator;

class UtilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilities = Utility::orderBy('id_utilidad','desc')->paginate(25);
        return view('dashboard.utilities.index',['utilities'=>$utilities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.utilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateUtility($request);
        if(!$validator->fails())
        {
            Utility::create($request->all());
        }
        return back()->withErrors($validator)
                        ->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryFilter(Request $request)
    {
        $utilities = Utility::where('categoria','like','%'.$request->categoria.'%')->paginate(25);
        return view('dashboard.utilities.index',['utilities'=>$utilities]);
    }
    public function show($id)
    {
      
    }

    public function validateUtility($request){

        $rules=['categoria'=>['required',"createUtility:$request->desde,$request->hasta"],
                'desde'=>['required'],
                'hasta'=>['required','numeric'],
                'ut'=>['required']];
        $messages=['required'=>'El campo  :attribute  requerido ','createUtility'=>'Esta utilidad ya existe'];
        return Validator::make($request->all(),$rules,$messages);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $utility = Utility::find($id);
        return view('dashboard.utilities.edit',["utility"=>$utility]);
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
        $rules=['categoria'=>['required',"updateUtility:$request->desde,$request->hasta,$id"],
                'desde'=>['required'],
                'hasta'=>['required','numeric'],
                'ut'=>['required']];
        $messages=['required'=>'El campo  :attribute  requerido ','update_utility'=>'Esta utilidad ya esta dentro de el rango de otra.'];
        $validator = Validator::make($request->all(),$rules,$messages);
        if(!$validator->fails()){
            $utility = Utility::find($id);
            $utility->categoria = $request->categoria;
            $utility->ut = $request->ut;
            $utility->desde = $request->desde;
            $utility->hasta = $request->hasta;
            $utility->save();
            return redirect('utilities');
        }
        return back()->withErrors($validator)
                        ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['result'] = Utility::destroy($id);
        return json_encode($data);
    }
}
