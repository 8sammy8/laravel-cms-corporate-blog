<div class="section primary-section" id="about">
    <div class="triangle"></div>
    <div class="container">
        <div class="title">
            <h1>Who We Are?</h1>

            <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
        </div>
        <div class="row-fluid team">
            <div class="span4" id="first-person">
                <div class="thumbnail">
                    <img src="{{ asset('images/team/Team1.png') }}" alt="team 1">

                    <h3>John Doe</h3>
                    <ul class="social">
                        <li>
                            <a href="">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="mask">
                        <h2>Copywriter</h2>

                        <p>When you stop expecting people to be perfect, you can like them for who they are.</p>
                    </div>
                </div>
            </div>
            <div class="span4" id="second-person">
                <div class="thumbnail">
                    <img src="{{ asset('images/team/Team2.png') }}" alt="team 1">

                    <h3>John Doe</h3>
                    <ul class="social">
                        <li>
                            <a href="">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="mask">
                        <h2>Designer</h2>

                        <p>When you stop expecting people to be perfect, you can like them for who they are.</p>
                    </div>
                </div>
            </div>
            <div class="span4" id="third-person">
                <div class="thumbnail">
                    <img src="{{ asset('images/team/Team3.png') }}" alt="team 1">

                    <h3>John Doe</h3>
                    <ul class="social">
                        <li>
                            <a href="">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="mask">
                        <h2>Photographer</h2>

                        <p>When you stop expecting people to be perfect, you can like them for who they are.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-text centered">
            <h3>About Us</h3>

            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor
                in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at
                vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis
                dolore te feugait nulla facilisi.</p>
        </div>
        <h3>Projects</h3>

        <div class="row-fluid">
            @if($filters && $filters->isNotEmpty())
                <div class="span6">
                    <ul class="skills">
                        @foreach($filters as $filter)
                            <li>
                                <span class="bar" data-width="100%"></span>

                                <h3>{{ $filter->filterLang->title }}</h3>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="span6">
                <div class="highlighted-box center">
                    <h1>We're Hiring</h1>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt
                        everything...</p>
                    <button class="button button-sp">Join Us</button>
                </div>
            </div>
        </div>
    </div>
</div>

