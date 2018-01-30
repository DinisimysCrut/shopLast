
@extends('layouts.app');
@section('content')
    @lang('orders.id') - №{{ $order->id }}<hr>
    @lang('all.phone'): +380{{ $order->phone }}<hr>
    @lang('products.list'):<br>
    @include('layouts.error_form')
    @include('admin.common.message')
    @forelse($order->products as $product)
        {!! Order::showNameProduct($product->name,$product->id) !!} |
        {!! Order::showPriceOneProduct($product->pivot->price) !!} |
        {!! Order::showCountProduct($product->pivot->count) !!} |
        {!! Order::showTotalPriceProduct($product->pivot->price,$product->pivot->count) !!}
        {!! Order::showFormEditCountProduct('admin.orders.update_product',old('count',$product->pivot->count),['product'=>$product->id,'order'=>$order->id]) !!}
        {!! SuperForm::deleteForm('admin.orders.delete_product',['product'=>$product->id,'order'=>$order->id]) !!}
        <hr>
    @empty
        @lang('products.list_null')<hr>
    @endforelse
    {{ Order::showCreateDate($order->created_at) }}<hr>
    @lang('all.status'): @lang('orders.status.'.$order->status)
    {!! Form::open(route('admin.orders.update_status',[$order])) !!}
    <select name="status">
        @foreach(Order::allTextStatus() as $textStatus)
            <option value="{{$textStatus}}" {{ $order->status==$textStatus ? 'selected' : '' }}> @lang('orders.status.'.$textStatus)</option>
        @endforeach
    </select>
    {!! Form::submit(trans('submit.update_status')) !!}
    {!! Form::close() !!}
    <hr>
    <b>@lang('all.total_price'):{{ $order->price() }}</b>
    {!! SuperForm::confirmDeleteButton('admin.orders.confirm_destroy',$order) !!}
@endsection