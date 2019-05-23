{{ Form::open([
    'url' => (isset($filter->id)) ? route('backend.filters.update', ['id' => $filter->id]) : route('backend.filters.store'),
    'class' => 'form-control',
    'method' => 'post',
    'enctype' => 'multipart/form-data']) }}

<ul>
    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('title[' . $locale . ']', 'Enter title (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('title[' . $locale . ']', isset($filterLangs[$locale]->title) ? $filterLangs[$locale]->title : old('title[' . $locale . ']'), [
                        'id' => 'title[' . $locale . ']',
                        'placeholder' => 'Title ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('title.' . $locale) }}
        </li>
    @endforeach

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('desc[' . $locale . ']', 'Enter description (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('desc[' . $locale . ']', isset($filterLangs[$locale]->desc) ? implode(',', $filterLangs[$locale]->desc) : old('desc[' . $locale . ']'), [
                        'id' => 'desc[' . $locale . ']',
                        'placeholder' => 'Description ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('desc.' . $locale) }}
        </li>
    @endforeach

    <li>
        {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::number('sort', isset($filter->sort) ?? $filter->sort, ['min' => 0]) }}
        </div>
        {{ $errors->first('sort') }}
    </li>

    <li>
        {{ Form::label('price', 'Enter price', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::number('price', isset($filter->price) ?? $filter->price, ['min' => 0]) }}
        </div>
        {{ $errors->first('price') }}
    </li>

</ul>
@if(isset($filter->id))
    {!! Form::hidden('_method', 'PUT') !!}
@endif
<div class="span">
    {{ Form::submit((isset($filter->id)) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}

</div>

{{ Form::close() }}

