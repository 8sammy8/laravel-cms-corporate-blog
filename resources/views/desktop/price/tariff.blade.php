@if($tariffs && $tariffs->isNotEmpty())
    <div id="price" class="section secondary-section">
        <div class="container">
            <div class="title">
                <h1>Price</h1>

                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>

            @foreach($tariffs as $key => $tariff)
                @if($key == 0 || $key%3 == 0)
                    <div class="price-table row-fluid">
                        @endif
                        <div class="span4 price-column">
                            <h3>{{ $tariff->priceLang->title }}</h3>
                            <ul class="list">
                                <li class="price">{{ $tariff->price }}</li>
                                @foreach($tariff->priceLang->bonus as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                                @foreach($tariff->priceLang->options as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @if(($key + 1)%3 == 0 || $loop->last)
                    </div>
                @endif
            @endforeach
            <div class="centered">
                <p class="price-text">We Offer Custom Plans. Contact Us For More Info.</p>
                <a href="#contact" class="button">Contact Us</a>
            </div>
        </div>
    </div>
@endif