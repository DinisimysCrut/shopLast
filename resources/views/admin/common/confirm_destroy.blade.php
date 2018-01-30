@extends('layouts.app_admin')

@section('head_links')
    <b>@lang($directory.'.destroy')</b>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @lang($directory.'.destroy_confirm_text',['item_name' => $item->name])
            {!! Form::open(route('admin.'.$directory.'.destroy',[$item]),'delete') !!}
            <input type="submit" class="btn btn-danger" value="@lang('submit.delete')">
            {!! Form::close() !!}
            <a href="{{ route('admin.'.$directory.'.index') }}">
                <button class="btn btn-success">
                    @lang('submit.no')
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        @yield('about_destroy')
    </div>
@endsection