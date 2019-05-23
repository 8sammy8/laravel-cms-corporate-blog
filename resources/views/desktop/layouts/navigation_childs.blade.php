@foreach($items as $item)
    <li>
        <a href="{{ $item->path }}">{{ $item->menuLang->title }}</a>

        @if($menu->where('parent_id', $item->id))
            <ul class="sub-menu" style="display: none">
                @include(config('theme.desktop') . '.layouts.navigation_childs', ['items' => $menu->where('parent_id', $item->id)->sortBy('sort')])
            </ul>
        @endif
    </li>
@endforeach