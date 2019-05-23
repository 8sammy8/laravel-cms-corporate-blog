@if(($portfolios && $portfolios->isNotEmpty()) && ($filters && $filters->isNotEmpty()))
    <!-- Portfolio section start -->
    <div class="section secondary-section " id="portfolio">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Have You Seen our Works?</h1>

                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>
            <ul class="nav nav-pills">
                <li class="filter" data-filter="all">
                    <a href="#noAction">All</a>
                </li>

                @foreach($filters as $filter)
                    <li class="filter" data-filter="{{ $filter->filterLang->title }}">
                        <a href="#noAction">{{ $filter->filterLang->title }}</a>
                    </li>
                @endforeach

            </ul>
            <!-- Start details for portfolio project -->
            <div id="single-project">
                @foreach($portfolios as $portfolio)
                    <div id="slidingDiv" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            @if(file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.portfolio') . DIRECTORY_SEPARATOR . $portfolio->img))
                                <img src="{{ asset(config('img.portfolio') . '/' . $portfolio->img) }}" alt="{{ $portfolio->title }}"/>
                            @endif
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>{{ $portfolio->title }}</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>{{ $portfolio->customer }}
                                    </div>
                                    <div>
                                        <span>Date</span>July 2013
                                    </div>
                                    <div>
                                        <span>Skills</span>{{ $portfolio->skills }}
                                    </div>
                                    <div>
                                        @if($portfolio->site)
                                            <span>Link</span>{{ $portfolio->site }}
                                        @endif
                                    </div>
                                </div>
                                <p>{{ $portfolio->portfolioLang->text }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project -->

                    @if($loop->first)
                        <ul id="portfolio-grid" class="thumbnails row">
                            @endif
                            <li class="span4 mix {{ $portfolio->filterLang->title }}">
                                <div class="thumbnail">
                                    @if(file_exists(public_path() .  DIRECTORY_SEPARATOR . config('img.portfolio') . DIRECTORY_SEPARATOR . $portfolio->img))
                                        <img src="{{ asset(config('img.portfolio') . '/' . $portfolio->img) }}" alt="{{ $portfolio->title }}">
                                    @endif
                                    <a href="#single-project" class="more show_hide" rel="#slidingDiv">
                                        <i class="icon-plus"></i>
                                    </a>

                                    <h3>{{ $portfolio->title }}</h3>

                                    <p>{{ $portfolio->filterLang->title }}</p>

                                    <div class="mask"></div>
                                </div>
                            </li>

                            @if($loop->last)
                        </ul>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Portfolio section end -->
@endif


