@extends('layouts.app_admin')
@section('head_links')
    <b>@lang('categories.list')</b>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.categories.create') }}">
                <button type="button" class="btn btn-success">@lang('submit.create')</button>
            </a>
        </div>
    </div>
    @if(count($categories)>0)
        <table class="table table-hover">
            <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    @lang('categories.name')
                </td>
                <td>
                    @lang('categories.children_count')
                </td>
                <td>
                    @lang('products.count')
                </td>
                <td>
                    @lang('submit.control')
                </td>
            </tr>
            </thead>
            <tbody>
            @include('admin.categories.index_list',['categories' => $categories, 'delimiter' => ''])
            </tbody>
        </table>
        {{ $categories->links() }}
    @else
        @lang('categories.list_null')
    @endif
@endsection