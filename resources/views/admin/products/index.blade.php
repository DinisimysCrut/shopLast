@extends('layouts.app_admin')
@section('head_links')
    <b>@lang('products.list')</b>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.products.create') }}">
                <button type="button" class="btn btn-success">@lang('submit.create')</button>
            </a>
        </div>
    </div>
    @if(count($products)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    @lang('products.name')
                </td>
                <td>
                    @lang('products.price')
                </td>
                <td>
                    @lang('products.parent_category')
                </td>
                <td>
                    @lang('submit.control')
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $product->id }}
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {!! Product::showInAdminPrice($product->price) !!}
                    </td>
                    <td>
                        {!! Product::showInAdminCategory($product) !!}
                    </td>
                    <td>
                        @include('admin.common.button_control',['model' => $product])
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $products->links() }}
    @else
        @lang('products.list_null')
    @endif
@endsection