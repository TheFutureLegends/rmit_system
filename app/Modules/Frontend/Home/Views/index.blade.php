@extends('layouts.frontend.master')

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="https://i.imgur.com/7KUGKka.jpg">
    <div class="overlay-bg overlay"></div>
    <div class="container">
        <div class="row fullscreen">
            <div class="banner-content d-flex align-items-center col-lg-12 col-md-12">
                <h1>
                    RMIT Student Activities <br />
                    <small style="font-size: 30px">
                        Contribute to the RMIT community, gain leadership experience and boost your career
                        prospects. Mentor a student, run a club, lead a community project or volunteer at an event.
                    </small>
                </h1>
            </div>
            <div class="head-bottom-meta d-flex justify-content-between align-items-end col-lg-12">

            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->


<!-- Start category Area -->
<section class="category-area section-gap" id="news">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Incoming Events</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="top-posts">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="single-posts col-lg-4 col-sm-4">
                        <img class="img-fluid" src="{{ asset('img/asset/p1.jpg') }}" alt="">
                        <div class="date mt-20 mb-20">15 Jan 2018</div>
                        <a href="#">
                            <h4 class="text-uppercase">It S Hurricane Season Visiting </h4>
                        </a>
                    </div>
                    <div class="single-posts col-lg-4 col-sm-4">
                        <img class="img-fluid" src="{{ asset('img/asset/p2.jpg') }}" alt="">
                        <div class="date mt-20 mb-20">16 Jan 2018</div>
                        <a href="#">
                            <h4 class="text-uppercase">What Makes A Hotel Boutique</h4>
                        </a>
                    </div>
                    <div class="single-posts col-lg-4 col-sm-4">
                        <img class="img-fluid" src="{{ asset('img/c3.jpg') }}" alt="">
                        <div class="date mt-20 mb-20">17 Jan 2018</div>
                        <a href="#">
                            <h4 class="text-uppercase">What Makes A Hotel Boutique</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End category Area -->

<!-- Start travel Area -->
<section class="travel-area section-gap" id="travel">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Latest Events</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 travel-left">
                <div class="single-travel media pb-70">
                    <img class="img-fluid d-flex  mr-3" src="img/t1.jpg" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0">
                            <a href="#">Addiction When Gambling Becomes A Problem</a>
                        </h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.inappropriate behavior
                            Lorem ipsum dolor sit amet, consectetur.</p>
                    </div>
                </div>
                <div class="single-travel media">
                    <img class="img-fluid d-flex  mr-3" src="img/t3.jpg" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 travel-right">
                <div class="single-travel media pb-70">
                    <img class="img-fluid d-flex  mr-3" src="img/t2.jpg" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
                <div class="single-travel media">
                    <img class="img-fluid d-flex  mr-3" src="img/t4.jpg" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More </a>
        </div>
    </div>
</section>
<!-- End travel Area -->

<!-- Start Team Area -->
<section class="team-area section-gap" id="team">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">About RMIT Student Activities</h1>
                    <p>Who are in extremely love with eco friendly system.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-lg-6 team-left">
                <p>
                    inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct
                    standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on
                    the job is beyond reproach. inappropriate behavior is often laughed off as “boys will be boys,”
                    women face higher conduct standards especially in the workplace. That’s why it’s crucial that.
                </p>
                <p>
                    inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct
                    standards especially in the workplace. That’s why it’s crucial that, as women.
                </p>
            </div>
            <div class="col-lg-6 team-right d-flex justify-content-center">
                <div class="row active-team-carusel">
                    <div class="single-team">
                        <div class="thumb">
                            <img class="img-fluid" src="img/team1.jpg" alt="">
                            <div class="align-items-center justify-content-center d-flex">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="meta-text mt-30 text-center">
                            <h4>Dora Walker</h4>
                            <p>Senior Core Developer</p>
                        </div>
                    </div>
                    <div class="single-team">
                        <div class="thumb">
                            <img class="img-fluid" src="img/team2.jpg" alt="">
                            <div class="align-items-center justify-content-center d-flex">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="meta-text mt-30 text-center">
                            <h4>Lena Keller</h4>
                            <p>Creative Content Developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End fashion Area -->

<!-- Start Contact Area -->
<section class="team-area section-gap" id="team">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Keep In Touch</h1>
                    <p>Who are in extremely love with eco friendly system.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-lg-5 col-md-5 team-left">
                <h4>
                    <i class="fas fa-building"></i>&nbsp;Our Office
                </h4>
                <p class="mt-3 mb-3">
                    RMIT University - 702 Nguyen Van Linh, Tan Hung Ward, District 7, Ho Chi Minh City
                </p>
                <h4>
                    <i class="fas fa-phone-alt"></i>&nbsp;Contact Phone
                </h4>

                <p class="mt-3 mb-3">
                    028 3776 1300
                </p>

                <h4>
                    <i class="fas fa-clock"></i>&nbsp;Working hours
                </h4>

                <p class="mt-3 mb-3">
                    Mon - Sat
                    <br /> 8 A.M : 5 P.M
                </p>
            </div>
            <div class="col-lg-7 col-md-7 team-right">
                <form action="#" method="POST">
                    <div class="row mt-10">
                        <div class="col-md-5">
                            <input type="text" name="full_name" placeholder="Full Name" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Full Name'" required class="single-input">
                        </div>

                        <div class="col-md-7">
                            <input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Email address'" required class="single-input">
                        </div>
                    </div>
                    <div class="mt-10">
                        <textarea class="single-textarea" name="message" placeholder="Message" rows="250"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Message'" required></textarea>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-5">
                            <div class="g-recaptcha" data-sitekey="6LfWNc8ZAAAAAAcztCURnCugJK9a0hQ8MqxWaozo"></div>
                        </div>

                        <div class="col-md-7 float-md-right">
                            <button class="nw-btn primary-btn subscribe-btn">Send Message<span
                                            class="lnr lnr-arrow-right"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End team Area -->
@endsection
