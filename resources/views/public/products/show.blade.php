@extends('layouts.app');
@section('content')
    @lang('products.name'):<b>{{ $product->name }}</b><hr>
    @lang('products.about'): {{ $product->about }}<hr>
    @lang('products.price'): {{ $product->price }}<hr>
    {!! Product::showCategory($product) !!}<hr>
    @lang('products.images'):<hr>
    @forelse($product->images() as $image)
        <img src="{{ Storage::url($image) }}"><hr>
    @empty
        @lang('products.images_not')
    @endforelse
    <hr>
    <a href="{{ route('public.basket.store',[$product]) }}"><button class="btn btn-info">@lang('submit.add_to_basket')</button></a><br><br>
@endsection