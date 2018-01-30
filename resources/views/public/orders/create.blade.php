
@extends('layouts.app');
@section('content')
    @lang('basket.products_in'):<hr>
    @foreach(Basket::all() as $item)
        {!! Order::showNameProduct($item['product']->name,$item['product']->id) !!} |
        {!! Order::showPriceOneProduct($item['price']) !!} |
        {!! Order::showCountProduct($item['count']) !!} |
        {!! Order::showTotalPriceProduct($item['price'],$item['count']) !!}
    @endforeach
    <hr>
    @lang('basket.total_price') <b>{{ Basket::price() }}</b><hr>
    @include('layouts.error_form')
    @lang('orders.create_on_this_phone_number')!
    {!! Form::open(route('public.orders.store')) !!}
    @lang('all.phone'): +380 <input type="tel" name="phone" value="{{ old('phone') }}"><hr>
    {!! Form::submit(trans('submit.create_order')) !!}
    {!! Form::close() !!}
@endsection
