@extends('admin.common.confirm_destroy')

@section('about_destroy')
    <div class="col-sm-12 bg-success">
        @lang('products.count'): {{ $item->getCountProducts() }}<br>
        @lang('categories.children_count'): {{ $item->getCountDirectChildren() }}
    </div>
    <div class="col-sm-12 alert-danger">
        @lang('categories.danger_before_destroy')
    </div>
@endsection