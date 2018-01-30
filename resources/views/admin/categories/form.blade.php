@extends('layouts.app_admin')

@section('head_links')
    <b>@lang($directory.'.'.$method)</b>
@endsection

@section('content')
    @include('layouts.error_form')
    @if($method == 'create')
        {!! Form::open(route('admin.categories.store')) !!}
    @else
        {!! Form::model($category,route('admin.categories.update',[$category]),'PUT') !!}
    @endif
    <div class="row">
        <label class="col-sm-2 control-label">@lang('categories.name')</label>
        <div class="col-sm-10">
            {!! Form::text('name') !!}
        </div>
    </div>

    @if(count($categories)>0)
        <div class="row">
            <label class="col-sm-2 control-label">@lang('categories.parent')</label>
            <div class="col-sm-10">
                <select name="parent_id">
                    <option value="" {{ $method == 'edit' ? ($category->parent ? '' : 'selected') : 'selected' }}>
                        @lang('categories.not_have_parent')
                    </option>
                    @include('admin.categories.form_list',['current' => $category, 'categories' => $categories, 'delimiter' => '', 'method' => $method])
                </select>
            </div>
        </div>
    @else
        @lang('categories.list_null')
    @endif
    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit(trans('submit.'.$method)) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
