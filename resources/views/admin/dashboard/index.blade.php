@extends('layouts.app_admin')
@section('head_links')
    <b>@lang('admin.list_modules')</b>
@endsection
@section('content')
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <td>
               @lang('admin.modules')
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <a href="{{ route('admin.categories.index') }}">@lang('admin.indexes.categories')</a>  (@lang('categories.count'):{{ $categories_count }})
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('admin.products.index') }}">@lang('admin.indexes.products')</a> (@lang('products.count'):{{ $products_count }})
            </td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('admin.orders.index') }}">@lang('admin.indexes.orders')</a> (@lang('orders.count'):{{ $orders_count }})
            </td>
        </tr>
        </tbody>
    </table>
@endsection