{{ Form::open([
    'url' => (isset($price->id)) ? route('backend.prices.update', ['id' => $price->id]) : route('backend.prices.store'),
    'class' => 'form-control',
    'method' => 'post',
    'enctype' => 'multipart/form-data']) }}

<ul>
    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('title[' . $locale . ']', 'Enter title (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('title[' . $locale . ']', isset($priceLangs[$locale]->title) ? $priceLangs[$locale]->title : old('title[' . $locale . ']'), [
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
            {{ Form::label('bonus[' . $locale . ']', 'Enter bonus (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('bonus[' . $locale . ']',
                (isset($priceLangs[$locale]->bonus) && current($priceLangs[$locale]->bonus)) ? implode(',', $priceLangs[$locale]->bonus) : old('bonus[' . $locale . ']'), [
                        'id' => 'bonus[' . $locale . ']',
                        'placeholder' => 'Bonus ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('title.' . $locale) }}
        </li>
    @endforeach

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('options[' . $locale . ']', 'Enter options (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('options[' . $locale . ']',
                (isset($priceLangs[$locale]->options) && current($priceLangs[$locale]->options)) ? implode(',', $priceLangs[$locale]->options) : old('options[' . $locale . ']'), [
                        'id' => 'options[' . $locale . ']',
                        'placeholder' => 'Options ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('title.' . $locale) }}
        </li>
    @endforeach

    <li>
        {{ Form::label('price', 'Enter price', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::number('price', isset($price->price) ? $price->price : old('price'), [
                    'id' => 'price',
                    'placeholder' => 'price',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('price') }}
    </li>

    <li>
        {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::number('sort', isset($price->sort) ?? $price->sort, ['min' => 0]) }}
        </div>
        {{ $errors->first('sort') }}
    </li>

    @if($filtersLang && current($filtersLang))
        <li>
            {{ Form::label('filter_id', 'Select filter', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
                {{ Form::select('filter_id', $filtersLang, $price->filter_id ?? '') }}
            </div>
            {{ $errors->first('filter_id') }}
        </li>
    @endif

</ul>
@if(isset($price->id))
    {!! Form::hidden('_method', 'PUT') !!}
@endif
<div class="span">
    {{ Form::submit((isset($price->id)) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}

</div>

{{ Form::close() }}

