
@extends('layouts.app');
@section('content')
    @lang('orders.id') - №{{ $order->id }}<hr>
    @lang('all.phone'): +380{{ $order->phone }}<hr>
    @lang('products.list'):<br>
    @forelse($order->products as $product)
        {!! Order::showNameProduct($product->name,$product->id) !!} |
        {!! Order::showPriceOneProduct($product->pivot->price) !!} |
        {!! Order::showCountProduct($product->pivot->count) !!} |
        {!! Order::showTotalPriceProduct($product->pivot->price,$product->pivot->count) !!}
        <hr>
    @empty
        @lang('products.list_null')<hr>
    @endforelse
    {{ Order::showCreateDate($order->created_at) }}<hr>
    @lang('all.status'): @lang('orders.status.'.$order->status)<hr>
    <b>@lang('all.total_price'):{{ Product::showPrice($order->price()) }}</b>
@endsection