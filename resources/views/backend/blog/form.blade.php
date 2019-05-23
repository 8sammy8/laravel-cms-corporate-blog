{{ Form::open([
    'url' => (isset($post->id)) ? route('backend.blog.update', ['id' => $post->id]) : route('backend.blog.store'),
    'class' => 'form-control',
    'method' => 'post',
    'enctype' => 'multipart/form-data']) }}

<ul>

    <li>
        {{ Form::label('menu_id', 'Select menu', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
            {{ Form::select('menu_id', $menuArray, $post->menu_id ?? '') }}
        </div>
        {{ $errors->first('menu_id') }}
    </li>

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('title[' . $locale . ']', 'Enter title (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                {{ Form::text('title[' . $locale . ']', isset($postLangs[$locale]->title) ? $postLangs[$locale]->title : old('title[' . $locale . ']'), [
                        'id' => 'title[' . $locale . ']',
                        'placeholder' => 'Title ' . $locale,
                ]) }}
            </div>
            {{ $errors->first('title.' . $locale) }}
        </li>
    @endforeach

    @foreach(config('settings.locales') as $locale)
        <li>
            {{ Form::label('text[' . $locale . ']', 'Enter text (' . $locale . ')', ['class' => 'control-label']) }}
            <div class="input-prepend">
                {{ Form::text('text[' . $locale . ']', isset($postLangs[$locale]->text) ? $postLangs[$locale]->text : old('text[' . $locale . ']'), [
                        'id' => 'text[' . $locale . ']',
                        'placeholder' => 'Text ' . $locale,
                        'class' => 'form-control'
                ]) }}
            </div>
            {{ $errors->first('text.' . $locale) }}
        </li>
    @endforeach

    <li>
        {{ Form::label('keywords', 'Enter keywords', ['class' => 'control-label']) }}
        <div class="input-prepend">
            {{ Form::text('keywords', isset($post->keywords) ? $post->keywords : old('keywords'), [
                'id' => 'keywords',
                'placeholder' => 'keywords',
            ]) }}
        </div>
        {{ $errors->first('keywords') }}
    </li>

    <li>
        {{ Form::label('meta_desc', 'Enter meta description', ['class' => 'control-label']) }}
        <div class="input-prepend">
            {{ Form::text('meta_desc', isset($post->meta_desc) ? $post->meta_desc : old('meta_desc'), [
                'id' => 'meta_desc',
                'placeholder' => 'meta description',
            ]) }}
        </div>
        {{ $errors->first('meta_desc') }}
    </li>

    <li>
        {{ Form::label('img', 'Select image', ['class' => 'control-label']) }}
        <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
            {{ Form::file('img') }}
        </div>
        {{ $errors->first('img') }}
    </li>

    @if(isset($post->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.post') . DIRECTORY_SEPARATOR . $post->img))
        <li>
            <div class="span6">
                <img src="{{ asset(config('img.post') . '/' . $post->img) }}" alt=""/>
            </div>
        </li>
    @endif

</ul>

@if(isset($post->id))
    {!! Form::hidden('_method', 'PUT') !!}
@endif

{{ Form::submit((isset($post->id)) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}

{{ Form::close() }}

{{--@foreach(config('settings.locales') as $locale)--}}
    {{--<script>--}}
        {{--CKEDITOR.replace('text[{{ $locale }}]');--}}
    {{--</script>--}}
{{--@endforeach--}}

{{--<script>--}}
    {{--CKEDITOR.replace('keywords');--}}
    {{--CKEDITOR.replace('meta_desc');--}}
{{--</script>--}}