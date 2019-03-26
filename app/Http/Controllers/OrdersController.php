<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Mail;
use Mail\OrderShipped;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('shoppingcart');
    }
    public function index()
    {

        //$this->authorize('admin',Role::class);
        $orders=Order::latest()->get();
        $totalMonth=Order::totalMonth();
        $totalMonthCount=Order::totalMonthCount();
        return view('orders.index',['orders'=>$orders,'totalMonth'=>$totalMonth
            ,'totalMonthCount'=>$totalMonthCount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $shoppingCart = $request->shoppingcart;
        return view('orders.create',compact('shoppingCart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(['line1'=>'required',
                            'state' => 'required',
                            'city' => 'required',
                            'postal_code' => 'required',
                            'recipient_name' => 'required'],
                            ['required' => 'El campo :attribute es requerido']);
        $arr = $request->all();
        $arr['shopping_cart_id'] = $request->shopping_cart->id;
        $order = Order::create($arr);
        Mail::to(Auth::user()->email)->send(new OrderShipped($request));
        return redirect(url('pagos/'.$request->session()->get("shopping_cart_id")));
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
        $order=Order::find($id);
        $field=$request->name;
        $order->$field=$request->value;
        $order->save();
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
