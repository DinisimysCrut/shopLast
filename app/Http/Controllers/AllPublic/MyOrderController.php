<?php

namespace App\Http\Controllers\AllPublic;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountProductRequest;
use App\Http\Requests\PhoneRequest;
use App\Order;
use App\Product;
use App\Facades\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{


    public function __construct()
    {
        $this->middleware('isbasket',['only'=>['create','store']]);
    }

    public function index()
    {
        $orders=Auth::user()->orders()->latest()->paginate(10);
        return view('public.orders.index',['orders'=>$orders]);
    }

    public function create()
    {
        return view('public.orders.create');
    }

    public function store(PhoneRequest $request)
    {
        $order=new Order;
        $basket=Basket::getSession();
        $order->createOne($basket,$request->all());
        Basket::clear();
        return redirect()->route('public.orders.index')->with('message',trans('orders.create_by_user',['id' => $order->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $this->authorize('show',$order);
        return view('public.orders.show',['order'=>$order]);
    }

    public function panel() {
        $orders=Order::orderBy('status','asc')->latest()->paginate(10);
        return view('orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Order $order) {
        $order->deleteOne();
        return redirect()->route('orders.panel')->with('deletedOrder',$order->id);
    }
}
