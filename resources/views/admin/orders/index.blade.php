
@extends('layouts.app');
@section('content')
    @if(session('message'))
        <div class="bg-success">
            {!! session('message') !!}
        </div>
    @endif
    @if(count($orders)>0)
        @lang('orders.list')<hr>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>
                    @lang('orders.id')
                </td>
                <td>
                    @lang('users.email')
                </td>
                <td>
                    @lang('all.status')
                </td>
                <td>
                    @lang('orders.created_at')
                </td>
            </tr>
            </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    <a href="{{ route('admin.orders.show',[$order]) }}">@lang('orders.one') №{{ $order->id }}</a>
                </td>
                <td>
                    {{ $order->user->email }}
                </td>
                <td>
                    @lang('orders.status.'.$order->status)
                </td>
                <td>
                    {{ $order->created_at }}
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
        {{ $orders->links() }}
    @else
        @lang('orders.list_null')
    @endif

@endsection