<div class="nav-collapse collapse pull-right">
    <ul class="nav" id="top-navigation">
        <li class="active">
            <a href="{{ route('backend.index') }}">Home</a>
        </li>
        @if($menuAdmin && current($menuAdmin))
            @foreach($menuAdmin as $key => $item)
                <li>
                    <a href="{{ $item }}">{{ $key }}</a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
<a class="dropdown-item" href="{{ route('logout') }}" style="color: yellow"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

