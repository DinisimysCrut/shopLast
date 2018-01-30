@extends('layouts.app')

@section('content')
    @if(count($categories)>0)
        <h2>
            @if(count($category)>0)
                @lang('categories.list_for_name',['name'=>$category->name])
            @else
                @lang('categories.list')
            @endif
        </h2>:
        <table class="table table-hover">
            <thead>
            <tr>
                <td>
                    @lang('categories.name')
                </td>
                <td>
                    @lang('categories.children_count')
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                       <a href="{{ route('public.categories.show',[$category]) }}">
                           {{ $category->name }}
                       </a>
                    </td>
                    <td>
                        {{ $category->children()->count()}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    @else
        @lang('categories.list_null')
    @endif
@endsection