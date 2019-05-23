{{ Form::open([
    'url' => (isset($slider->id)) ? route('backend.sliders.update', ['id' => $slider->id]) : route('backend.sliders.store'),
    'class' => 'form-control',
    'method' => 'post',
    'enctype' => 'multipart/form-data']) }}

<ul>
    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('first_title[' . $locale . ']', 'Enter first title (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('first_title[' . $locale . ']', isset($sliderLangs[$locale]->first_title) ? $sliderLangs[$locale]->first_title : old('first_title[' . $locale . ']'), [
                        'id' => 'first_title[' . $locale . ']',
                        'placeholder' => 'First title ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('first_title.' . $locale) }}
        </li>
    @endforeach

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('second_title[' . $locale . ']', 'Enter second title (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('second_title[' . $locale . ']', isset($sliderLangs[$locale]->second_title) ? $sliderLangs[$locale]->second_title : old('second_title[' . $locale . ']'), [
                        'id' => 'second_title[' . $locale . ']',
                        'placeholder' => 'Second title ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('second_title.' . $locale) }}
        </li>
    @endforeach

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('desc[' . $locale . ']', 'Enter description (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('desc[' . $locale . ']', isset($sliderLangs[$locale]->desc) ? $sliderLangs[$locale]->desc : old('desc[' . $locale . ']'), [
                        'id' => 'desc[' . $locale . ']',
                        'placeholder' => 'Description ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('desc.' . $locale) }}
        </li>
    @endforeach

    <li>
        {{ Form::label('path', 'Enter path', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::text('path', isset($slider->path) ? $slider->path : old('path'), [
                    'id' => 'path',
                    'placeholder' => 'Path',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('path') }}
    </li>

    <li>
        {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::number('sort', isset($slider->sort) ?? $slider->sort, ['min' => 0]) }}
        </div>
        {{ $errors->first('sort') }}
    </li>

    <li>
        {{ Form::label('img', 'Select image', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::file('img') }}
        </div>
        {{ $errors->first('img') }}
    </li>

    @if(isset($slider->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.slider') . DIRECTORY_SEPARATOR . $slider->img))
        <li>
            <div class="span6">
                <img src="{{ asset(config('img.slider') . '/' . $slider->img) }}" alt="{{ $slider->path }}"/>
            </div>

        </li>
    @endif

</ul>
@if(isset($slider->id))
    {!! Form::hidden('_method', 'PUT') !!}
@endif
<div class="span">
    {{ Form::submit((isset($slider->id)) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}

</div>

{{ Form::close() }}

