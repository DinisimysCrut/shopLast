@foreach($categories as $category_item)
    @if(isset($current->id))
        @if($current->id == $category_item->id)
            @continue
        @endif
    @endif
    <option value="{{ $category_item->id }}" {{ ($method == 'edit' AND $current->isParent()) ? ($category_item->id == $current->parent->id ? 'selected' : '') : '' }}>{{ $delimiter }}->{{ $category_item->name }}</option>
    @if(count($category_item->children)>0)
        @include('admin.categories.form_list',['current' => $current, 'categories' => $category_item->children, 'delimiter' => $delimiter.'--', 'method' => $method])
    @endif
@endforeach