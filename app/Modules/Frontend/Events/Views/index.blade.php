@extends('layouts.frontend.master')

@section('title')
Events Page
@endsection

@section('content')
<!-- Start top-section Area -->
<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">Latest Events</h1>
                {{-- <ul>
                    <li><a href="index.html">Home</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><a href="category.html">Category</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><a href="single.html">Fashion</a></li>
                </ul> --}}
            </div>
        </div>
    </div>
</section>
<!-- End top-section Area -->


<!-- Start post Area -->
<div class="post-wrapper pt-100">
    <!-- Start post Area -->
    <section class="post-area">
        <div class="container">
            <!-- New content -->
            <div class="row sidebar-area">
                <div class="single-posts col-lg-4 col-sm-4">
                    <img class="img-fluid" src="img/asset/p1.jpg" alt="">
                    <div class="date mt-20 mb-20">10 Jan 2018</div>
                    <div class="detail">
                        <a href="#">
                            <h4 class="pb-20">Addiction When Gambling <br>
                                Becomes A Problem</h4>
                        </a>
                        <p>
                            inappropriate behavior Lorem ipsum dolor sit amet,
                            consecteturinapprop riate behavior Lorem ipsum dolor sit amet,
                            consectetur.
                        </p>
                        <p class="footer pt-20">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <a href="#">06 Likes</a> <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <a
                                href="#">02 Comments</a>
                        </p>
                    </div>
                </div>
                <div class="single-posts col-lg-4 col-sm-4">
                    <img class="img-fluid" src="img/asset/p1.jpg" alt="">
                    <div class="date mt-20 mb-20">10 Jan 2018</div>
                    <div class="detail">
                        <a href="#">
                            <h4 class="pb-20">Addiction When Gambling <br>
                                Becomes A Problem</h4>
                        </a>
                        <p>
                            inappropriate behavior Lorem ipsum dolor sit amet,
                            consecteturinapprop riate behavior Lorem ipsum dolor sit amet,
                            consectetur.
                        </p>
                        <p class="footer pt-20">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <a href="#">06 Likes</a> <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <a
                                href="#">02 Comments</a>
                        </p>
                    </div>
                </div>
                <div class="single-posts col-lg-4 col-sm-4">
                    <img class="img-fluid" src="img/asset/p2.jpg" alt="">
                    <div class="date mt-20 mb-20">10 Jan 2020</div>
                    <div class="detail">
                        <a href="#">
                            <h4 class="pb-20">Addiction When Gambling <br>
                                Becomes A Problem</h4>
                        </a>
                        <p>
                            inappropriate behavior Lorem ipsum dolor sit amet,
                            consecteturinapprop riate behavior Lorem ipsum dolor sit amet,
                            consectetur.
                        </p>
                        <p class="footer pt-20">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <a href="#">06 Likes</a> <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <a
                                href="#">02 Comments</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End post Area -->
</div>
<!-- End post Area -->
@endsection
