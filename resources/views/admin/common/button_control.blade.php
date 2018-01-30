<a href="{{ route('admin.'.$directory.'.edit',[$model]) }}">
    <button type="button" class="btn btn-success">@lang('submit.edit')</button>
</a>
<a href="{{ route('admin.'.$directory.'.confirm_destroy',[$model]) }}">
    <button type="button" class="btn btn-danger">@lang('submit.delete')</button>
</a>