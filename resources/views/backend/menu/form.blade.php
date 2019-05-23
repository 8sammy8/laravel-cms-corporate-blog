{{ Form::open([
    'url' => (isset($menu->id)) ? route('backend.menus.update', ['id' => $menu->id]) : route('backend.menus.store'),
    'class' => 'form-control',
    'method' => 'post',
    'enctype' => 'multipart/form-data']) }}

<ul>
    <li>
        {{ Form::label('path', 'Enter path', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::text('path', isset($menu->path) ? $menu->path : old('path'), [
                    'id' => 'path',
                    'placeholder' => 'path',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('path') }}
    </li>

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('title[' . $locale . ']', 'Enter title (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('title[' . $locale . ']', isset($menuLangs[$locale]->title) ? $menuLangs[$locale]->title : old('title[' . $locale . ']'), [
                        'id' => 'title[' . $locale . ']',
                        'placeholder' => 'Title ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('title.' . $locale) }}
        </li>
    @endforeach

    <li>
        {{ Form::label('parent_id', 'Select parent', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::select('parent_id', $menuArray, $menu->parent_id ?? '') }}
        </div>
        {{ $errors->first('parent_id') }}
    </li>

    <li>
        {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::number('sort', isset($menu->sort) ?? $menu->sort, ['min' => 0]) }}
        </div>
        {{ $errors->first('sort') }}
    </li>

</ul>
@if(isset($menu->id))
    {!! Form::hidden('_method', 'PUT') !!}
@endif

{{ Form::submit((isset($menu->id)) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}

