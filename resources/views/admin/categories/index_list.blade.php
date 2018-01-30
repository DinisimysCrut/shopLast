@foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ !empty($delimiter) ? $delimiter.'> ' : ''}}{{ $category->name }}</td>
        <td>
            {{ $category->getCountAllChildren() }}
        </td>
        <td>
            {{ $category->products()->count() }}
        </td>
        <td>
            @include('admin.common.button_control',['model' => $category])
        </td>
    </tr>
    @if(count($category->children)>0)
        @include('admin.categories.index_list',['categories' => $category->children, 'delimiter' => '---'.$delimiter])
    @endif
@endforeach