@extends('layouts.frontend.master')

@section('title')
Event Detail
@endsection

@section('content')
<!-- Start top-section Area -->
<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-md-between justify-content-sm-center align-items-sm-center text-sm-center d-flex">
            <div class="col-lg-12 top-left">
                <h1 class="text-white mb-20">{{ $event->name }}</h1>
            </div>
        </div>
    </div>
</section>
<!-- End top-section Area -->

<!-- Start post Area -->
<div class="post-wrapper pt-100">
    <section class="post-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-12">
                    <div class="single-page-post">
                        <img class="img-fluid" src="{{ $event->getFirstMediaUrl('cover', 'detail') }}" alt="">
                        <div class="top-wrapper ">
                            <div class="row d-flex justify-content-between">
                                <h2 class="col-lg-6 col-md-12 text-uppercase">
                                    {{ $event->name }}
                                </h2>
                                <div class="col-lg-6 col-md-12 mt-3 mt-md-0 right-side d-flex float-sm-left justify-content-md-end">
                                    <div class="user-img d-md-none d-sm-block">
                                        <img class="club-logo-thumb" src="{{ $event->club->getFirstMediaUrl('logo', 'avatar') }}" alt="">
                                    </div>

                                    <div class="desc">
                                        <h2>{{ $event->club->name }}</h2>
                                        <h3>{{ Carbon::parse($event->start_at)->isoFormat("DD MMM, YYYY h:mm A") }}</h3>
                                    </div>
                                    <div class="user-img d-none d-md-block d-sm-none">
                                        <img class="club-logo-thumb" src="{{ $event->club->getFirstMediaUrl('logo', 'avatar') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tags">
                            <ul>
                                <li><a href="#">lifestyle</a></li>
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Fashion</a></li>
                            </ul>
                        </div>
                        <div class="single-post-content">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $event->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="bottom-wrapper">
                            <div class="row">
                                {{-- <div class="col-lg-4 single-b-wrap col-md-12">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    lily and 4 people like this
                                </div>
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> 06 comments
                                </div> --}}
                                <div class="single-b-wrap col-md-12 d-flex justify-content-end">
                                    <ul class="social-icons">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Start nav Area -->
                        <section class="nav-area pt-50 pb-100">
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-sm-6 nav-left justify-content-start d-flex">
                                        <div class="thumb">
                                            <img class="thumb-image" src="{{ asset('img/prev.jpg') }}" alt="">
                                        </div>
                                        <div class="details">
                                            <p>Prev Post</p>
                                            <h4 class="text-uppercase"><a href="#">A Discount Toner</a></h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 nav-right justify-content-end d-flex">
                                        <div class="details">
                                            <p>Next Post</p>
                                            <h4 class="text-uppercase"><a href="#">A Discount Toner</a></h4>
                                        </div>
                                        <div class="thumb">
                                            <img class="thumb-image" src="{{ asset('img/next.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End nav Area -->

                        {{-- @include('FrontendEvents::comment') --}}
                    </div>
                </div>

                <div class="col-lg-4 col-sm-12 mt-0 pt-sm-0 sidebar-area">
                    <div class="single_widget about_widget">
                        <img class="club-logo-bio" src="{{ $event->club->getFirstMediaUrl('logo', 'avatar') }}" alt="">
                        <h2 class="text-uppercase">{{ $event->club->name }}</h2>
                        <p>
                            {!! $event->club->description !!}
                        </p>
                        <div class="social-link">
                            <a href="#"><button class="btn"><i class="fa fa-facebook" aria-hidden="true"></i>
                                    Like</button></a>
                            <a href="#"><button class="btn"><i class="fa fa-twitter" aria-hidden="true"></i>
                                    follow</button></a>
                        </div>
                    </div>

                    <div class="single_widget cat_widget">
                        <h4 class="text-uppercase pb-20">event categories</h4>
                        <ul>
                            <li>
                                <a href="#">Technology <span>37</span></a>
                            </li>
                            <li>
                                <a href="#">Lifestyle <span>37</span></a>
                            </li>
                            <li>
                                <a href="#">Fashion <span>37</span></a>
                            </li>
                            <li>
                                <a href="#">Art <span>37</span></a>
                            </li>
                            <li>
                                <a href="#">Food <span>37</span></a>
                            </li>
                            <li>
                                <a href="#">Architecture <span>37</span></a>
                            </li>
                            <li>
                                <a href="#">Adventure <span>37</span></a>
                            </li>
                        </ul>
                    </div>

                    <div class="single_widget recent_widget">
                        <h4 class="text-uppercase pb-20">Recent Events</h4>
                        <div class="active-recent-carusel">
                            <div class="item">
                                <img src="{{ asset('img/asset/slider.jpg') }}" alt="">
                                <a href="{{ route('events.frontend.show', 'abc-def') }}">
                                    <p class="mt-20 title text-uppercase">Home Audio Recording <br>
                                        For Everyone</p>
                                </a>

                                <p>02 Hours ago <span> <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        06 <i class="fa fa-comment-o" aria-hidden="true"></i>02</span></p>
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/asset/slider.jpg') }}" alt="">
                                <p class="mt-20 title text-uppercase">Home Audio Recording <br>
                                    For Everyone</p>
                                <p>02 Hours ago <span> <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        06 <i class="fa fa-comment-o" aria-hidden="true"></i>02</span></p>
                            </div>
                            <div class="item">
                                <img src="{{ asset('img/asset/slider.jpg') }}" alt="">
                                <p class="mt-20 title text-uppercase">Home Audio Recording <br>
                                    For Everyone</p>
                                <p>02 Hours ago <span> <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        06 <i class="fa fa-comment-o" aria-hidden="true"></i>02</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="single_widget tag_widget">
                        <h4 class="text-uppercase pb-20">Tag Clouds</h4>
                        <ul>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Art</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Technology</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Technology</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
