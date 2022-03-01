@extends('frontend.layout')
@section('content')

    @if (!$connection)

    <div class="not_found">
        <h3>Opps! Something Wrong!</h3>
        <a href="{{ url('/') }}">Retry</a>
    </div>

    @else
        <!-- HERO -->
        <div class="myfolio__section" id="home">
            <canvas id="canvas1"></canvas>
            <div class="myfolio__hero">
                <div class="container">
                    @if ($hero)
                        <div class="content">
                            <div class="texts">
                                <h2>Test</h2>
                                <h4>{{ $hero->subtitle }}</h4>
                                <div class="job">
                                    {{-- <video playsinline autoplay muted loop>
                            <source src="{{ asset('frontend') }}/video/1.mp4" type="video/mp4">
                        </video> --}}
                                    <h3 class="overlay_effect">{{ $hero->title }}</h3>
                                </div>
                                <div class="desc">
                                    <div class="type-wrap">
                                        <div id="typed-strings">
                                            @forelse (explode(',', $hero->skill_list) as $item)
                                                <p><span>{{ $item }}</span></p>
                                            @empty

                                            @endforelse

                                        </div>
                                        <span id="typed"></span>
                                    </div>
                                </div>
                                <div class="short_skills">
                                    <div class="text">
                                        <span>High knowledge on</span>
                                    </div>
                                    <div class="icons">
                                        <ul>
                                            @forelse ($knowledges as $item)
                                                <li><img class="svg"
                                                        src="{{ url('storage/uploads/hero/' . $item->image) }}"
                                                        alt="{{ $item->name }}" title="{{ $item->name }}" /></li>

                                            @empty
                                                <li><img class="svg"
                                                        src="{{ asset('frontend') }}/img/svg/html.svg" alt="" /></li>
                                                <li><img class="svg"
                                                        src="{{ asset('frontend') }}/img/svg/css.svg" alt="" /></li>
                                                <li><img class="svg"
                                                        src="{{ asset('frontend') }}/img/svg/angular.svg" alt="" /></li>
                                                <li><img class="svg"
                                                        src="{{ asset('frontend') }}/img/svg/bootstrap.svg" alt="" /></li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="avatar">
                                <div class="image"
                                    data-img-url="{{ url('/storage/uploads/hero/' . $hero->image) }}">
                                </div>
                            </div>
                        </div>
                    @else
                        <small class="text-center">No Hero Is set up! Please create hero area from backend</small>
                    @endif
                </div>
            </div>
        </div>
        <!-- /HERO -->

        <!-- ABOUT -->
        <div class="myfolio__section" id="about">
            <div class="myfolio__about">
                <div class="container">
                    <div class="about_inner">
                        <div class="left wow fadeInLeft" data-wow-duration="1.5s">
                            <div class="image">
                                <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                <div class="main"
                                    data-img-url="{{ url('/storage/uploads/about/' . $about->thumbnail) }}"></div>
                                <div class="experience">
                                    <h3 class="year"
                                        data-img-url="{{ url('/storage/uploads/about/' . $about->thumbnail) }}">
                                        {{ $about->experience_year }}</h3>
                                    <div id="circle">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px"
                                            height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300"
                                            xml:space="preserve">
                                            <defs>
                                                <path id="circlePath"
                                                    d=" M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 " />
                                            </defs>
                                            <circle cx="150" cy="100" r="75" fill="none" />
                                            <g>
                                                <use xlink:href="#circlePath" fill="none" />
                                                <text fill="#000">
                                                    <textpath xlink:href="#circlePath">{{ $about->experience_text }}
                                                    </textpath>
                                                </text>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right wow fadeInRight" data-wow-duration="1.5s">
                            <div class="myfolio__title">
                                <span>{{ $about->subtitle }}</span>
                                <h3>{!! $about->title !!}</h3>
                            </div>
                            <div class="text">
                                <p>{{ $about->description }}</p>
                            </div>
                            <div class="signature">
                                <img src="{{ url('/storage/uploads/about/' . $about->signature) }}" alt="" />
                            </div>
                            <div class="myfolio__button">
                                <a target="_blank" href="{{ Storage::url('uploads/about/' . $about->cv_link) }}">Download
                                    CV</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /ABOUT -->

        <!-- SERVICES -->
        <div class="myfolio__section" id="service">
            <div class="myfolio__services">
                <div class="container">
                    <div class="services_inner">
                        <div class="left">
                            <div class="myfolio__title">
                                <span>{{ $service->subtitle }}</span>
                                <h3>{{ $service->title }}</h3>
                            </div>
                            <div class="text">
                                <p>{!! $service->description !!}</p>
                            </div>
                            <div class="myfolio_progress">

                                @forelse ($skills as $item)
                                    <div class="progress_inner" data-value="{{ $item->value }}">
                                        <span><span class="label">{{ $item->name }}</span><span
                                                class="number">{{ $item->value . '%' }}</span></span>
                                        <div class="background">
                                            <div class="bar">
                                                <div class="bar_in"></div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div class="progress_inner" data-value="95">
                                        <span><span class="label">HTML &amp; CSS</span><span
                                                class="number">95%</span></span>
                                        <div class="background">
                                            <div class="bar">
                                                <div class="bar_in"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="progress_inner" data-value="80">
                                        <span><span class="label">JavaScript</span><span
                                                class="number">80%</span></span>
                                        <div class="background">
                                            <div class="bar">
                                                <div class="bar_in"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress_inner" data-value="90">
                                        <span><span class="label">WordPress</span><span
                                                class="number">90%</span></span>
                                        <div class="background">
                                            <div class="bar">
                                                <div class="bar_in"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="right">
                            <ul class="grid">

                                @forelse ($services as $index=>$item)


                                    <li class="grid-item wow fadeInUp" data-wow-duration="1.5s"
                                        {{ $index > 0 && $index != count($services) - 1 ? 'data-wow-delay="0.2s" ' : '' }}>
                                        <div class="list_inner">
                                            <img class="svg"
                                                src="{{ url('storage/uploads/services/' . $item->icon) }}"
                                                alt="{{ $item->name }}" />
                                            <h3 class="title">{{ $item->name }}</h3>
                                            <div class="opacity_overlay" style="background-image: url({{ url('storage/uploads/services/' . $item->icon) }})"></div>
                                        </div>
                                    </li>

                                @empty
                                    <li class="grid-item wow fadeInUp" data-wow-duration="1.5s">
                                        <div class="list_inner">
                                            <img class="svg" src="{{ asset('frontend') }}/img/svg/design.svg"
                                                alt="" />
                                            <h3 class="title">Design</h3>
                                        </div>
                                    </li>

                                    <li class="grid-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                        <div class="list_inner">
                                            <img class="svg" src="{{ asset('frontend') }}/img/svg/code.svg"
                                                alt="" />
                                            <h3 class="title">Development</h3>
                                        </div>
                                    </li>
                                    <li class="grid-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                        <div class="list_inner">
                                            <img class="svg" src="{{ asset('frontend') }}/img/svg/award.svg"
                                                alt="" />
                                            <h3 class="title">Quality</h3>
                                        </div>
                                    </li>
                                    <li class="grid-item wow fadeInUp" data-wow-duration="1.5s">
                                        <div class="list_inner">
                                            <img class="svg" src="{{ asset('frontend') }}/img/svg/tools.svg"
                                                alt="" />
                                            <h3 class="title">Maintain</h3>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /SERVICES -->

        <!-- FUN FACTS -->

        <div class="myfolio__section">
            <div class="myfolio__funfacts_area" data-img-url="{{ asset('frontend/img/bg-counter.jpg') }}">
                <div class="container">
                    <div class="myfolio_funfacts">
                        @forelse ( $funfacts as $item)
                            <div class="single_funfact">
                                <img class="svg" src="{{ Storage::url('uploads/funfacts/' . $item->icon) }}"
                                    alt="">
                                <h1><span class="counter">{{ $item->value }}</span>{{ $item->suffix }}</h1>
                                <h4>{{ $item->title }}</h4>
                            </div>
                        @empty


                            <div class="single_funfact">
                                <img class="svg" src="{{ asset('frontend/img/svg/database.svg') }}" alt="">
                                <h1><span class="counter">787</span>+</h1>
                                <h4>Complete Projects</h4>
                            </div>
                            <!--  single_funfact -->

                            <div class="single_funfact">
                                <img class="svg" src="{{ asset('frontend/img/svg/happy.svg') }}" alt="">
                                <h1><span class="counter">347</span>+</h1>
                                <h4>Happy Clients</h4>
                            </div>
                            <!--  single_funfact -->
                            <div class="single_funfact">
                                <img class="svg" src="{{ asset('frontend/img/svg/coffee-cup.svg') }}" alt="">
                                <h1><span class="counter">250</span>+</h1>
                                <h4>Sleepless Night</h4>
                            </div>
                            <!-- single_funfact -->
                            <div class="single_funfact">
                                <img class="svg" src="{{ asset('frontend/img/svg/thumb-up.svg') }}" alt="">
                                <h1><span class="counter">98</span>%</h1>
                                <h4>Positive Rating</h4>
                            </div>
                            <!--  single_funfact -->
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <!--  /FUN FACTS -->

        <!-- EXPERIENCE -->
        <div class="myfolio__section">
            <div class="myfolio__resume">
                <div class="container">
                    <div class="resume_inner">
                        <div class="full_width_title">
                            <div class="myfolio__title">
                                <span>{{ $experience->subtitle }}</span>
                                <h3>{{ $experience->title }}</h3>
                            </div>
                            <div class="text">
                                <p>{{ $experience->description }}</p>
                            </div>
                        </div>
                        <div class="">
                            <div class="main-icon rounded-pill text-center mt-4 pt-2">
                                <img src="{{ asset('frontend/img/svg/star.svg') }}" class="svg" alt="">
                            </div>
                            <div class="timeline-page pt-2 position-relative">

                                @forelse ($experienceList as $index=>$item)

                                    <div class="timeline-item mt-4">
                                        <div class="single_timeline">

                                            <div
                                                class="exp_duration col-6  {{ $index % 2 == 0 ? 'order-sm-1 order-1' : 'order-sm-2 or∂der-2' }}">
                                                <div
                                                    class="duration border rounded p-2 ps-4 pe-4 position-relative shadow text-start{{ $index % 2 == 0 ? ' date-label-left' : ' duration-right' }}">
                                                    {{ $item->start_date }} - {{ $item->end_date }} </div>
                                            </div>
                                            <!--end col-->
                                            <div
                                                class="exp_details col-6 {{ $index % 2 == 0 ? 'order-sm-2 order-2' : 'order-sm-1 order-1' }}">
                                                <div
                                                    class="event rounded p-4 border float-left {{ $index % 2 == 0 ? 'event-description-right text-start' : 'event event-description-left text-end' }}">
                                                    <h5 class="title mb-0 text-capitalize">{{ $item->title }}</h5>
                                                    <small class="company">{{ $item->company_name }} -
                                                        {{ $item->company_tag }}</small>
                                                    <p class="timeline-subtitle mt-3 mb-0 text-muted">
                                                        {{ $item->description }}</p>
                                                </div>
                                            </div>
                                            <!--end col-->

                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end timeline item-->

                                @empty
                                    <div class="timeline-item mt-4">
                                        <div class="single_timeline">
                                            <div class="col-6">
                                                <div
                                                    class="duration date-label-left border rounded p-2 ps-4 pe-4 position-relative shadow text-start">
                                                    2015 - 2018</div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6">
                                                <div
                                                    class="event event-description-right rounded p-4 border float-left text-start">
                                                    <h5 class="title mb-0 text-capitalize">UX Designer</h5>
                                                    <small class="company">Vivo - Senior Designer</small>
                                                    <p class="timeline-subtitle mt-3 mb-0 text-muted">The generated
                                                        injected
                                                        humour, or non-characteristic words etc. Cum sociis natoque
                                                        penatibus et
                                                        magnis dis parturient montes, nascetur ridiculus mus. Donec quam
                                                        felis,</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end timeline item-->

                                    <div class="timeline-item mt-4">
                                        <div class="single_timeline">
                                            <div class="col-6 order-sm-1 order-2">
                                                <div
                                                    class="event event-description-left rounded p-4 border float-left text-end">
                                                    <h5 class="title mb-0 text-capitalize">Web Developer</h5>
                                                    <small class="company">Oppo - HR Manager</small>
                                                    <p class="timeline-subtitle mt-3 mb-0 text-muted">Lorem ipsum dolor sit
                                                        amet,
                                                        consectetur adipiscing elit. Cras lacinia magna vel molestie
                                                        faucibus. Donec
                                                        auctor et urnaLorem ipsum dolor sit amet.</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6 order-sm-2 order-1">
                                                <div
                                                    class="duration duration-right rounded border p-2 ps-4 pe-4 position-relative shadow text-start">
                                                    2012 - 2015</div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end timeline item-->

                                    <div class="timeline-item mt-4">
                                        <div class="single_timeline">
                                            <div class="col-6">
                                                <div
                                                    class="duration date-label-left border rounded p-2 ps-4 pe-4 position-relative shadow text-start">
                                                    2012 - 2010</div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6">
                                                <div
                                                    class="event event-description-right rounded p-4 border float-left text-start">
                                                    <h5 class="title mb-0 text-capitalize">Graphic Designer</h5>
                                                    <small class="company">Apple - Testor</small>
                                                    <p class="timeline-subtitle mt-3 mb-0 text-muted">Therefore always free
                                                        from
                                                        repetition, injected humour, or non-characteristic words etc. Cum
                                                        sociis
                                                        natoque penatibus et magnis dis parturient montes, nascetur
                                                        ridiculus mus.
                                                        Donec quam felis, </p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end timeline item-->
                                @endforelse
                            </div>
                            <!--end timeline page-->
                            <!-- TIMELINE END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /EXPERIENCE -->

 <!-- CTA -->
 <div class="myfolio__section">
    <div class="myfolio__video">
        <div class="background">
            <div class="image jarallax" data-speed="0" data-img-url="{{ asset('frontend') }}/img/hero/1.jpg">
            </div>
            <div class="overlay"></div>
        </div>
        <div class="content">
            <div class="container">
                <div class="content_inner">

                    <h3 class="text wow fadeInUp" data-wow-duration="1.5s">Let's Start Your Next Project!</h3>
                    <div class="myfolio__button wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <a class="popup-youtube" href="https://www.youtube.com/watch?v=ICr_bOuM9Zo">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /CTA -->


        <!-- PORTFOLIO -->
        <div class="myfolio__section" id="portfolio">
            <div class="myfolio__portfolio">
                <div class="container">

                    <div class="portfolio_inner">
                        <div class="myfolio__display_block">
                            <div class="myfolio__title">
                                <span>Portfolio</span>
                                <h3>Each project is a unique piece of development</h3>
                            </div>
                        </div>



                        <div class="portfolio-content-head">
                            <ul
                                class="myfolio-filter controls masonary text-center list-inline has-dynamic-filter-counter">
                                <li class="filter all active" data-filter=".masonary-item"><span>All</span>
                                </li>
                                <li class="filter" data-filter=".web"><span>Web Design</span>
                                </li>
                                <li class="filter" data-filter=".development"><span>Development</span>
                                </li>
                                <li class="filter" data-filter=".branding"><span>Branding</span>
                                </li>
                            </ul>

                        </div>



                        <div class="portfolio_list">



                            <ul class="gallery_zoom myfolio-gallery">
                                <li class="masonary-item web vimeo design">
                                    <div class="list_inner">
                                        <div class="image">
                                            <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                            <div class="main"
                                                data-img-url="{{ asset('frontend') }}/img/portfolio/1.jpg"></div>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="details">
                                            <h3>Water Drops</h3>
                                            <span>Vimeo</span>
                                        </div>
                                        <a class="myfolio__full_link popup-vimeo" href="https://vimeo.com/312334044"></a>
                                    </div>
                                </li>
                                <li class="masonary-item web branding detail">
                                    <div class="list_inner">
                                        <div class="image">
                                            <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                            <div class="main"
                                                data-img-url="{{ asset('frontend') }}/img/portfolio/2.jpg"></div>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="details">
                                            <h3>Sweet Cherry</h3>
                                            <span>Youtube</span>
                                        </div>
                                        <a class="myfolio__full_link popup-youtube"
                                            href="https://www.youtube.com/watch?v=Amq-qlqbjYA"></a>
                                    </div>
                                </li>
                                <li class="masonary-item web development detail">
                                    <div class="list_inner">
                                        <div class="image">
                                            <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                            <div class="main"
                                                data-img-url="{{ asset('frontend') }}/img/portfolio/3.jpg"></div>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="details">
                                            <h3>Red Nike</h3>
                                            <span>Soundcloud</span>
                                        </div>
                                        <a class="myfolio__full_link soundcloude_link mfp-iframe audio"
                                            href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/252739311&amp;color=%23ff5500&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></a>
                                    </div>
                                </li>
                                <li class="masonary-item web detail design">
                                    <div class="list_inner">
                                        <div class="image">
                                            <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                            <div class="main"
                                                data-img-url="{{ asset('frontend') }}/img/portfolio/6.jpg"></div>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="details">
                                            <h3>Blue Lemon</h3>
                                            <span>Detail</span>
                                        </div>
                                        <a class="myfolio__full_link popup_info" href="#"></a>
                                    </div>

                                    <!-- Hidden informations for popup begin -->
                                    <div class="portfolio_hidden_infos">
                                        <div class="popup_details">
                                            <div class="top_image"></div>
                                            <div class="portfolio_main_title"></div>
                                            <div class="main_details">
                                                <div class="textbox">
                                                    <p>The origin of the lemon is unknown, though lemons are thought to
                                                        have first grown in Assam (a region in northeast India),
                                                        northern Burma or China. A genomic study of the lemon indicated
                                                        it was a hybrid between bitter orange and citron.</p>
                                                    <p>The first substantial cultivation of lemons in Europe began in
                                                        Genoa in the middle of the 15th century. The lemon was later
                                                        introduced to the Americas in 1493 when Christopher Columbus
                                                        brought lemon seeds to Hispaniola on his voyages. Spanish
                                                        conquest throughout the New World helped spread lemon seeds.</p>
                                                </div>
                                                <div class="detailbox">
                                                    <ul>
                                                        <li>
                                                            <span class="first">Client</span>
                                                            <span>Alvaro Morata</span>
                                                        </li>
                                                        <li>
                                                            <span class="first">Category</span>
                                                            <span><a href="#">Detail</a></span>
                                                        </li>
                                                        <li>
                                                            <span class="first">Date</span>
                                                            <span>March 07, 2021</span>
                                                        </li>
                                                        <li>
                                                            <span class="first">Share</span>
                                                            <ul class="share">
                                                                <li><a href="#"><img class="svg"
                                                                            src="{{ asset('frontend') }}/img/svg/social/facebook.svg"
                                                                            alt="" /></a></li>
                                                                <li><a href="#"><img class="svg"
                                                                            src="{{ asset('frontend') }}/img/svg/social/twitter.svg"
                                                                            alt="" /></a></li>
                                                                <li><a href="#"><img class="svg"
                                                                            src="{{ asset('frontend') }}/img/svg/social/instagram.svg"
                                                                            alt="" /></a></li>
                                                                <li><a href="#"><img class="svg"
                                                                            src="{{ asset('frontend') }}/img/svg/social/dribbble.svg"
                                                                            alt="" /></a></li>
                                                                <li><a href="#"><img class="svg"
                                                                            src="{{ asset('frontend') }}/img/svg/social/tik-tok.svg"
                                                                            alt="" /></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="additional_images">
                                                <ul>
                                                    <li>
                                                        <div class="list_inner">
                                                            <div class="my_image">
                                                                <img src="{{ asset('frontend') }}/img/thumbs/4-2.jpg"
                                                                    alt="" />
                                                                <div class="main"
                                                                    data-img-url="{{ asset('frontend') }}/img/portfolio/7.jpg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_inner">
                                                            <div class="my_image">
                                                                <img src="{{ asset('frontend') }}/img/thumbs/4-2.jpg"
                                                                    alt="" />
                                                                <div class="main"
                                                                    data-img-url="{{ asset('frontend') }}/img/portfolio/8.jpg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_inner">
                                                            <div class="my_image">
                                                                <img src="{{ asset('frontend') }}/img/thumbs/4-2.jpg"
                                                                    alt="" />
                                                                <div class="main"
                                                                    data-img-url="{{ asset('frontend') }}/img/portfolio/9.jpg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hidden informations for popup end -->

                                </li>
                                <li class="masonary-item web branding">
                                    <div class="list_inner">
                                        <div class="image">
                                            <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                            <div class="main"
                                                data-img-url="{{ asset('frontend') }}/img/portfolio/5.jpg"></div>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="details">
                                            <h3>Pantone</h3>
                                            <span>Image</span>
                                        </div>
                                        <a class="myfolio__full_link zoom" href="img/portfolio/5.jpg"></a>
                                    </div>
                                </li>
                                <li class="masonary-item web detail photography">
                                    <div class="list_inner">
                                        <div class="image">
                                            <img src="{{ asset('frontend') }}/img/thumbs/1-1.jpg" alt="" />
                                            <div class="main"
                                                data-img-url="{{ asset('frontend') }}/img/portfolio/4.jpg"></div>
                                        </div>
                                        <div class="overlay"></div>
                                        <div class="details">
                                            <h3>New Telephone</h3>
                                            <span>Image</span>
                                        </div>
                                        <a class="myfolio__full_link zoom" href="img/portfolio/4.jpg"></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /PORTFOLIO -->

        <!-- VIDEO -->
        <div class="myfolio__section">
            <div class="myfolio__video">
                <div class="background">
                    <div class="image jarallax" data-speed="0" data-img-url="{{ asset('frontend') }}/img/hero/1.jpg">
                    </div>
                    <div class="overlay"></div>
                </div>
                <div class="content">
                    <div class="container">
                        <div class="content_inner">
                            <span class="rounded"><a class="popup-youtube"
                                    href="https://www.youtube.com/watch?v=ICr_bOuM9Zo"></a></span>
                            <h3 class="text wow fadeInUp" data-wow-duration="1.5s">I am delivering beautiful digital
                                products for my clients</h3>
                            <div class="myfolio__button wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                <a class="popup-youtube" href="https://www.youtube.com/watch?v=ICr_bOuM9Zo">Watch
                                    Video</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /VIDEO -->

        <!-- TESTIMONIALS -->
        <div class="myfolio__section">
            <div class="myfolio__testimonials">
                <div id="grouploop">
                    <div class="item-wrap">
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                        <div class="item"><span>Testimonials</span></div>
                    </div>
                </div>
                <div class="container">
                    <div class="testimonials_list">
                        <div class="wrapper owl-carousel">
                            <div class="wr_in item">
                                <div class="list_inner">
                                    <ul class="stars">
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                    </ul>
                                    <div class="text">
                                        <p>I rarely like to write reviews, but the developer truly deserve a standing
                                            ovation for their customer support, customisation and most importantly,
                                            friendliness and professionalism. Very satisfying!!!</p>
                                    </div>
                                    <div class="details">
                                        <h3 class="author"><span>Albert Einstein</span></h3>
                                        <h3 class="job"><span>Freelancer</span></h3>
                                    </div>
                                    <div class="avatar">
                                        <div class="image"
                                            data-img-url="{{ asset('frontend') }}/img/about/2.jpg">
                                        </div>
                                    </div>
                                    <img class="svg myquote" src="{{ asset('frontend') }}/img/svg/quote.svg"
                                        alt="" />
                                </div>
                            </div>
                            <div class="wr_in item">
                                <div class="list_inner">
                                    <ul class="stars">
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                    </ul>
                                    <div class="text">
                                        <p>The quality of the design is very high, and with a bit of knowledge about
                                            HTML and CSS also very easy to customize. Overall a good design, that I am
                                            quite happy with. Really appreciate that.</p>
                                    </div>
                                    <div class="details">
                                        <h3 class="author"><span>Avon Smith</span></h3>
                                        <h3 class="job"><span>Designer</span></h3>
                                    </div>
                                    <div class="avatar">
                                        <div class="image"
                                            data-img-url="{{ asset('frontend') }}/img/about/1.jpg">
                                        </div>
                                    </div>
                                    <img class="svg myquote" src="{{ asset('frontend') }}/img/svg/quote.svg"
                                        alt="" />
                                </div>
                            </div>
                            <div class="wr_in item">
                                <div class="list_inner">
                                    <ul class="stars">
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                        <li><img class="svg" src="{{ asset('frontend') }}/img/svg/star.svg"
                                                alt="" /></li>
                                    </ul>
                                    <div class="text">
                                        <p>I had a problem finding something, asked the support team, got a reply and a
                                            solution within a few minutes. Brilliant support! very happy with the
                                            website I bought. Thank you developers!!</p>
                                    </div>
                                    <div class="details">
                                        <h3 class="author"><span>Bruce Kennedy</span></h3>
                                        <h3 class="job"><span>Photographer</span></h3>
                                    </div>
                                    <div class="avatar">
                                        <div class="image"
                                            data-img-url="{{ asset('frontend') }}/img/about/3.jpg">
                                        </div>
                                    </div>
                                    <img class="svg myquote" src="{{ asset('frontend') }}/img/svg/quote.svg"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /TESTIMONIALS -->

        <!-- NEWS -->
        <div class="myfolio__section" id="news">
            <div class="myfolio__news">
                <div class="container">
                    <div class="myfolio__title">
                        <span>News</span>
                        <h3>Check out the latest breaking news headlines on development</h3>
                    </div>
                    <div class="news_list">
                        <ul>
                            <li class="wow fadeInUp" data-wow-duration="1.5s">
                                <div class="list_inner">
                                    <div class="image">
                                        <img src="{{ asset('frontend') }}/img/thumbs/4-3.jpg" alt="" />
                                        <div class="main"
                                            data-img-url="{{ asset('frontend') }}/img/news/1.jpg">
                                        </div>
                                        <a class="myfolio__full_link" href="#"></a>
                                    </div>
                                    <div class="details">
                                        <span>August 15, 2021 <a href="#">Branding</a></span>
                                        <h3 class="title"><a href="#">Good Travel</a></h3>
                                    </div>
                                    <div class="hide_content">
                                        <div class="descriptions">
                                            <p class="bigger">Just because we can't get out and about like we
                                                normally
                                                would, doesn’t mean we have to stop taking pictures. There’s still
                                                plenty you can do, provided you're prepared to use some imagination.
                                                Here are a few ideas to keep you shooting until normal life resumes.</p>
                                            <p>Most photographers love to shoot the unusual, and you don’t get much more
                                                unusual than These Unprecedented Times. Right now everything counts as
                                                out of the ordinary. There are a number of remarkable things about these
                                                lockdown days that are worth photographing now so we can remember them
                                                when it is all over.</p>
                                            <p>Streets empty that are usually busy are remarkable and can evoke the
                                                sense of historical pictures from before the invention of the motorcar.
                                                Other things that are different at the moment will be queues to get into
                                                stores and the lines marked out on the floor to show how far apart we
                                                should be.</p>
                                            <div class="quotebox">
                                                <p>Most photographers find it hard to see interesting pictures in places
                                                    in which they are most familiar. A trip somewhere new seems always
                                                    exactly what our photography needed, as shooting away from home
                                                    consistently inspires us to new artistic heights.</p>
                                            </div>
                                            <p>Pretend everything is new and that you haven’t seen it before, and then
                                                you will be free to notice the leading lines, the places where one edge
                                                meets another in delightful geometric harmony, and how the ordinary
                                                things in the kitchen are transformed when the light is on or off.</p>
                                            <p>The trick here is to look slowly, and then look again. Take the time to
                                                look in detail and to look at the same thing from different angles, with
                                                different light, long lenses and wide lenses. Then move to the left a
                                                bit. You may never feel the need to leave the house again.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                <div class="list_inner">
                                    <div class="image">
                                        <img src="{{ asset('frontend') }}/img/thumbs/4-3.jpg" alt="" />
                                        <div class="main"
                                            data-img-url="{{ asset('frontend') }}/img/news/2.jpg">
                                        </div>
                                        <a class="myfolio__full_link" href="#"></a>
                                    </div>
                                    <div class="details">
                                        <span>July 25, 2021 <a href="#">Design</a></span>
                                        <h3 class="title"><a href="#">National Geographic</a></h3>
                                    </div>
                                    <div class="hide_content">
                                        <div class="descriptions">
                                            <p class="bigger">Just because we can't get out and about like we
                                                normally
                                                would, doesn’t mean we have to stop taking pictures. There’s still
                                                plenty you can do, provided you're prepared to use some imagination.
                                                Here are a few ideas to keep you shooting until normal life resumes.</p>
                                            <p>Most photographers love to shoot the unusual, and you don’t get much more
                                                unusual than These Unprecedented Times. Right now everything counts as
                                                out of the ordinary. There are a number of remarkable things about these
                                                lockdown days that are worth photographing now so we can remember them
                                                when it is all over.</p>
                                            <p>Streets empty that are usually busy are remarkable and can evoke the
                                                sense of historical pictures from before the invention of the motorcar.
                                                Other things that are different at the moment will be queues to get into
                                                stores and the lines marked out on the floor to show how far apart we
                                                should be.</p>
                                            <div class="quotebox">
                                                <p>Most photographers find it hard to see interesting pictures in places
                                                    in which they are most familiar. A trip somewhere new seems always
                                                    exactly what our photography needed, as shooting away from home
                                                    consistently inspires us to new artistic heights.</p>
                                            </div>
                                            <p>Pretend everything is new and that you haven’t seen it before, and then
                                                you will be free to notice the leading lines, the places where one edge
                                                meets another in delightful geometric harmony, and how the ordinary
                                                things in the kitchen are transformed when the light is on or off.</p>
                                            <p>The trick here is to look slowly, and then look again. Take the time to
                                                look in detail and to look at the same thing from different angles, with
                                                different light, long lenses and wide lenses. Then move to the left a
                                                bit. You may never feel the need to leave the house again.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                                <div class="list_inner">
                                    <div class="image">
                                        <img src="{{ asset('frontend') }}/img/thumbs/4-3.jpg" alt="" />
                                        <div class="main"
                                            data-img-url="{{ asset('frontend') }}/img/news/3.jpg">
                                        </div>
                                        <a class="myfolio__full_link" href="#"></a>
                                    </div>
                                    <div class="details">
                                        <span>June 02, 2021 <a href="#">Nature</a></span>
                                        <h3 class="title"><a href="#">Famous Lake</a></h3>
                                    </div>
                                    <div class="hide_content">
                                        <div class="descriptions">
                                            <p class="bigger">Just because we can't get out and about like we
                                                normally
                                                would, doesn’t mean we have to stop taking pictures. There’s still
                                                plenty you can do, provided you're prepared to use some imagination.
                                                Here are a few ideas to keep you shooting until normal life resumes.</p>
                                            <p>Most photographers love to shoot the unusual, and you don’t get much more
                                                unusual than These Unprecedented Times. Right now everything counts as
                                                out of the ordinary. There are a number of remarkable things about these
                                                lockdown days that are worth photographing now so we can remember them
                                                when it is all over.</p>
                                            <p>Streets empty that are usually busy are remarkable and can evoke the
                                                sense of historical pictures from before the invention of the motorcar.
                                                Other things that are different at the moment will be queues to get into
                                                stores and the lines marked out on the floor to show how far apart we
                                                should be.</p>
                                            <div class="quotebox">
                                                <p>Most photographers find it hard to see interesting pictures in places
                                                    in which they are most familiar. A trip somewhere new seems always
                                                    exactly what our photography needed, as shooting away from home
                                                    consistently inspires us to new artistic heights.</p>
                                            </div>
                                            <p>Pretend everything is new and that you haven’t seen it before, and then
                                                you will be free to notice the leading lines, the places where one edge
                                                meets another in delightful geometric harmony, and how the ordinary
                                                things in the kitchen are transformed when the light is on or off.</p>
                                            <p>The trick here is to look slowly, and then look again. Take the time to
                                                look in detail and to look at the same thing from different angles, with
                                                different light, long lenses and wide lenses. Then move to the left a
                                                bit. You may never feel the need to leave the house again.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /NEWS -->

        <!-- CONTACT -->
        <div class="myfolio__section" id="contact">
            <div class="myfolio__contact">
                <div class="container">
                    <div class="myfolio__title">
                        <span>Contact</span>
                        <h3>Feel free to contact me if any assistance is needed in the future</h3>
                    </div>
                    <div class="short_info wow fadeInUp" data-wow-duration="1.5s">
                        <ul>
                            <li>
                                <div class="list_inner">
                                    <div class="logo">
                                        <img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/location-2.svg" alt="" />
                                    </div>
                                    <div class="info">
                                        <h3>Location</h3>
                                        <span>123 Ave street, USA</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="list_inner">
                                    <div class="logo">
                                        <img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/telephone-2.svg" alt="" />
                                    </div>
                                    <div class="info">
                                        <h3>Phone</h3>
                                        <span>+77 022 155 02 02</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="list_inner">
                                    <div class="logo">
                                        <img class="svg" src="{{ asset('frontend') }}/img/svg/email-2.svg"
                                            alt="" />
                                    </div>
                                    <div class="info">
                                        <h3>Mail</h3>
                                        <span><a href="" class="__cf_email__"
                                                data-cfemail="2052594b455260474d41494c0e434f4d">[email&#160;protected]</a></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="wrapper">
                        <div class="left wow fadeInUp" data-wow-duration="1.5s">
                            <div class="fields">
                                <form action="/" method="post" class="contact_form" id="contact_form">
                                    <div class="returnmessage"
                                        data-success="Your message has been received, We will contact you soon."></div>
                                    <div class="empty_notice"><span>Please Fill Required Fields</span></div>
                                    <div class="first">
                                        <ul>
                                            <li>
                                                <input id="name" type="text" placeholder="Name" autocomplete="off">
                                            </li>
                                            <li>
                                                <input id="email" type="text" placeholder="Email" autocomplete="off">
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="last">
                                        <textarea id="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="myfolio__button" data-color="dark">
                                        <a id="send_message" href="#">Send Message</a>
                                    </div>

                                    <!-- If you want change mail address to yours, just open "modal" folder >> contact.php and go to line 4 and change detail to yours.  -->

                                </form>
                            </div>
                        </div>
                        {{-- <div class="right wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                            <div class="map_wrap">
                                <div class="map" id="ieatmaps"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /CONTACT -->

        <!-- COPYRIGHT -->
        <div class="myfolio__section">
            <div class="myfolio__copyright">
                <div class="container">
                    <div class="copyright_inner">
                        <div class="text wow fadeInLeft" data-wow-duration="1.5s">
                            <p>Copyright &copy; 2021. All rights are reserved</p>
                        </div>
                        <div class="social wow fadeInRight" data-wow-duration="1.5s">
                            <ul>
                                <li><a href="#"><img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/social/facebook.svg" alt="" /></a></li>
                                <li><a href="#"><img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/social/twitter.svg" alt="" /></a></li>
                                <li><a href="#"><img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/social/instagram.svg" alt="" /></a>
                                </li>
                                <li><a href="#"><img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/social/dribbble.svg" alt="" /></a></li>
                                <li><a href="#"><img class="svg"
                                            src="{{ asset('frontend') }}/img/svg/social/tik-tok.svg" alt="" /></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /COPYRIGHT -->

    @endif

@endsection
