<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountProductRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class MyOrderController extends Controller
{
    public function index() {
        return view('admin.orders.index',['orders' => Order::paginate(10)]);
    }

    public function show(Order $order) {
        return view('admin.orders.show',['order' => $order]);
    }

    public function confirmDestroy(Order $order) {
        return view('admin.orders.confirm_destroy',[
            'directory' => 'orders',
            'item' => $order
        ]);
    }

    public function destroy(Order $order)
    {
        $order->deleteOne();
        return redirect()->route('admin.orders.index')->with('message',trans('admin.destroy_element',['name' => trans('orders.id').$order->id, 'type' => trans('orders.one')]));
    }

    public function updateStatus(StatusOrderRequest $request, Order $order)
    {
        $order->status=$request->status;
        $order->save();
        return redirect()->route('admin.orders.show',[$order])->with('message',trans('orders.message.update_status'));
    }

    public function updateProduct(CountProductRequest $request, Order $order, Product $product)
    {
        $order->updateProduct($request,$product);
        return redirect()->route('admin.orders.show',[$order])->with('message',trans('orders.message.update_product'));
    }

    public function deleteProduct(Order $order, Product $product)
    {
        $order->deleteProduct($product);
        return redirect()->route('admin.orders.show',[$order])->with('message',trans('orders.message.delete_product'));
    }
}
