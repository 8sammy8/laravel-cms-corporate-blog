@foreach($items as $item)
    <tr>
        <td>{{ $parent . $item->menuLang->title }}</td>
        <td>{{ Html::link(route('backend.menus.edit', ['id' => $item->id]), $item->menuLang->title) }}</td>
        <td>{{ $item->path }}</td>
        <td>{{ $item->sort }}</td>
        <td>
            {{ Form::open(['url' => route('backend.menus.destroy', ['id'=> $item->id]), 'method'=>'post']) }}
            @csrf
            @method('delete')
            {{ Html::link(route('backend.menus.show', ['id' => $item->id]), 'show', ['class' => 'btn btn-warning']) }}
            {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
            {{ Form::close() }}
        </td>
    </tr>
    @if($menu->where('parent_id', $item->id)->isNotEmpty())
        @include('backend.menu.child', [
        'items' => $menu->where('parent_id', $item->id)->sortBy('sort'),
        'parent' => $item->parent_id ? $parent . $item->menuLang->title . ' > ' : $item->menuLang->title . ' > '
        ])
    @endif
@endforeach
