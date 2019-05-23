<div class="nav-collapse collapse pull-right">
    <ul class="nav" id="top-navigation">
        <li class="active">
            <a href="{{ route('home.index') }}#home">Home</a>
        </li>
        @if($menu && $menu->isNotEmpty())
            @include(config('theme.desktop') . '.layouts.navigation_childs', ['items' => $menu->where('parent_id', null)->sortBy('sort')])
        @endif
    </ul>
</div>



