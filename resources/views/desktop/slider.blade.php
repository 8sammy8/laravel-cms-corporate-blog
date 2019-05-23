@if($sliders && $sliders->isNotEmpty())

    <div id="da-slider" class="da-slider">
        <div class="triangle"></div>
        <!-- mask elemet use for masking background image -->
        <div class="mask"></div>
        <!-- All slides centred in container element -->
        <div class="container">
            <!-- Start slide -->

            @foreach($sliders as $slider)
                <div class="da-slide">
                    <h2>{{ $slider->sliderLang->first_title }}</h2>
                    <h4>{{ $slider->sliderLang->second_title }}</h4>

                    <p>{{ $slider->sliderLang->desc }}</p>
                    <a href="{{ $slider->path }}" class="da-link button">Read more</a>

                    <div class="da-img">
                        @if(file_exists(public_path() .  DIRECTORY_SEPARATOR . config('img.slider') . DIRECTORY_SEPARATOR . $slider->img))
                            <img src="{{ asset(config('img.slider')) }}/{{ $slider->img }}" alt="" width="320">
                        @endif
                    </div>
                </div>
        @endforeach
        <!-- End slide -->

            <!-- Start cSlide navigation arrows -->
            <div class="da-arrows">
                <span class="da-arrows-prev"></span>
                <span class="da-arrows-next"></span>
            </div>
            <!-- End cSlide navigation arrows -->
        </div>
    </div>

@endif