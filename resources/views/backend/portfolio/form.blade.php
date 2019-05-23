{{ Form::open([
    'url' => (isset($portfolio->id)) ? route('backend.portfolios.update', ['id' => $portfolio->id]) : route('backend.portfolios.store'),
    'class' => 'form-control',
    'method' => 'post',
    'enctype' => 'multipart/form-data']) }}

<ul>
    <li>
        {{ Form::label('title', 'Enter title', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::text('title', isset($portfolio->title) ? $portfolio->title : old('title'), [
                    'id' => 'title',
                    'placeholder' => 'title',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('title') }}
    </li>

    <li>
        {{ Form::label('customer', 'Enter customer', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::text('customer', isset($portfolio->customer) ? $portfolio->customer : old('customer'), [
                    'id' => 'customer',
                    'placeholder' => 'customer',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('customer') }}
    </li>

    <li>
        {{ Form::label('site', 'Enter site', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::text('site', isset($portfolio->site) ? $portfolio->site : old('site'), [
                    'id' => 'site',
                    'placeholder' => 'site',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('site') }}
    </li>

    <li>
        {{ Form::label('skills', 'Enter skills', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::text('skills', isset($portfolio->skills) ? $portfolio->skills : old('skills'), [
                    'id' => 'skills',
                    'placeholder' => 'skills',
                    'class' => 'form-control'
            ]) }}
        </div>
        {{ $errors->first('skills') }}
    </li>

    <li>
        {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::number('sort', isset($portfolio->sort) ?? $portfolio->sort, ['min' => 0]) }}
        </div>
        {{ $errors->first('sort') }}
    </li>

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('text[' . $locale . ']', 'Enter text (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('text[' . $locale . ']', isset($portfolioLangs[$locale]->text) ? $portfolioLangs[$locale]->text : old('text[' . $locale . ']'), [
                        'id' => 'text[' . $locale . ']',
                        'placeholder' => 'Text ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('text.' . $locale) }}
        </li>
    @endforeach

    @if($filtersLang && current($filtersLang))
        <li>
            {{ Form::label('filter_id', 'Select filter', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
                {{ Form::select('filter_id', $filtersLang, $portfolio->filter_id ?? '') }}
            </div>
            {{ $errors->first('filter_id') }}
        </li>
    @endif

    <li>
        {{ Form::label('img', 'Select image', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::file('img') }}
        </div>
        {{ $errors->first('img') }}
    </li>

    @if(isset($portfolio->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.portfolio') . DIRECTORY_SEPARATOR . $portfolio->img))
        <li>
            <div class="span6">
                <img src="{{ asset(config('img.portfolio') . '/' . $portfolio->img) }}" alt="{{ $portfolio->title }}"/>
            </div>

        </li>
    @endif

</ul>
@if(isset($portfolio->id))
    {!! Form::hidden('_method', 'PUT') !!}
@endif
<div class="span">
    {{ Form::submit((isset($portfolio->id)) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}

</div>

{{ Form::close() }}

