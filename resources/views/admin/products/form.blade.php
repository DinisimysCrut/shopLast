@extends('layouts.app_admin')

@section('head_links')
    <b>@lang($directory.'.'.$method)</b>
@endsection

@section('content')
    @include('layouts.error_form')
    @if($method=='edit')
        {!! Form::model($product,route('admin.products.update',[$product]),'put',null,true,['enctype'=>'multipart/form-data']) !!}
    @else
        {!! Form::open(route('admin.products.store'),'post',null,true,['enctype'=>'multipart/form-data']) !!}
    @endif
    <div class="row">
        <label class="col-sm-2 control-label">@lang('products.name')</label>
        <div class="col-sm-10">
            {!! Form::text('name') !!}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 control-label">@lang('products.about')</label>
        <div class="col-sm-10">
            {!! Form::textarea('about') !!}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 control-label">@lang('products.price')(@lang('admin.currency'))</label>
        <div class="col-sm-10">
            {!! Form::number('price') !!}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 control-label">@lang('products.parent_category')</label>
        <div class="col-sm-10">
            <select name="category_id">
                <option value="" {{ $method == 'edit' ? (isset($product->category)? '' : 'selected') : 'selected' }}>
                    @lang('products.not_have_category')
                </option>
                @if(count($categories)>0)
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $method == 'edit' ? (isset($product->category)? ($product->category->id == $category->id ? 'selected' : '') : '') : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 control-label">@lang('products.images')</label>
        <div class="col-sm-10">
            @if($method=='edit')
                @forelse($product->images() as $image)
                    <img src="{{ Storage::url($image) }}">
                    <input type="checkbox" name="imagesDelete[]" value="{{ $image }}"> @lang('submit.delete')<hr>
                @empty
                    @lang('products.images_not')
                @endforelse
            @endif
            <div id="inputFiles">
                <input type="file" name="images[]"><br>
            </div>
            <div id="addInputFile" class="btn btn-info">@lang('submit.add_image')</div>
            <hr>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit(trans('submit.'.$method)) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@push('scripts')
<script src="{{ asset('js/addInputFiles.js') }}"></script>
@endpush
