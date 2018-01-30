@extends('layouts.app');
@section('content')
    @include('layouts.error_form')
    @if(Basket::is())
        @lang('basket.products_in'):<hr>
        @foreach(Basket::all() as $item)
            {!! Order::showNameProduct($item['product']->name,$item['product']->id) !!} |
            {!! Order::showPriceOneProduct($item['price']) !!} |
            {!! Order::showCountProduct($item['count']) !!} |
            {!! Order::showTotalPriceProduct($item['price'],$item['count']) !!}
            {!! Order::showFormEditCountProduct('public.basket.store',old('count',$item['count']),[$item['product']]) !!}
            {!! SuperForm::deleteForm('public.basket.destroy',[$item['product']]) !!}
        @endforeach
        @lang('basket.total_price'): <b>{{ Basket::price() }}</b><hr>
        <a href="{{ route('public.orders.create') }}"><button class="btn btn-info">@lang('submit.create_order')</button></a>
        <hr><hr><hr>
    @else
        @lang('basket.not_have_products')!<hr>
    @endif
    @if(isset($product))
        @if(Basket::has($product->id))
            <div class="bg-success">
            @lang('basket.this_product_is')
            </div>
        @else
            <b>@lang('basket.add_new_product_in')  </b><br>
            @lang('products.name'): {{ $product->name }}<hr>
            @lang('products.price'): {{ Product::showPrice($product->price) }}<hr>
            {!! Form::open(route('public.basket.store',[$product])) !!}
            @lang('products.count'): {!! Form::number('count') !!}<hr>
            {!! Form::submit(trans('submit.add_to_basket')) !!}
            {!! Form::close() !!}
        @endif
    @endif
@endsection