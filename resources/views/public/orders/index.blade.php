
@extends('layouts.app');
@section('content')
    @if(count($orders)>0)
        @lang('orders.list')<hr>
        @foreach($orders as $order)
            <a href="{{ route('public.orders.show',[$order]) }}">@lang('orders.one') №{{ $order->id }}</a> | @lang('orders.status.'.$order->status) | {{ Order::showCreateDate($order->created_at) }}<hr>
        @endforeach
        {{ $orders->links() }}
    @else
        @lang('orders.list_null')
    @endif

@endsection