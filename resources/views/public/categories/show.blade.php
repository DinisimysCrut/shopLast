@extends('layouts.app')

@section('content')
    <h2>
        @lang('categories.name'): {{ $category->name }}
    </h2>
    @if(count($products)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <td>
                    @lang('products.name')
                </td>
                <td>
                    @lang('products.price')
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <a href="{{ route('public.products.show',[$product]) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>
                        {{ $product->price }}
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