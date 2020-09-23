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
                <div class="col-lg-8">
                    <div class="single-page-post">
                        <img class="img-fluid" src="{{ asset('img/single.jpg') }}" alt="">
                        <div class="top-wrapper ">
                            <div class="row d-flex justify-content-between">
                                <h2 class="col-lg-8 col-md-12 text-uppercase">
                                    A Discount Toner Cartridge Is Better Than Ever
                                </h2>
                                <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                    <div class="desc">
                                        <h2>Mark wiens</h2>
                                        <h3>12 Dec ,2017 11:21 am</h3>
                                    </div>
                                    <div class="user-img">
                                        <img src="{{ asset('img/user.jpg') }}" alt="">
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
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not
                                understand why you should have to spend money on boot camp when you can get the
                                MCSE study materials yourself at a fraction of the camp price. However, who has
                                the willpower to actually sit through a self-imposed MCSE training.
                            </p>
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not
                                understand why you should have to spend money on boot camp when you can get the
                                MCSE study materials yourself at a fraction of the camp price. However, who has
                                the willpower to actually sit through a self-imposed MCSE training. who has the
                                willpower to actually sit through a self-imposed MCSE training.
                            </p>

                            <blockquote>Ea possunt paria non esse. Pudebit te, inquam, illius tabulae, quam
                                Cleanthes sane commode verbis depingere solebat. Urgent tamen et nihil
                                remittunt. An vero displicuit ea, quae tributa est animi virtutibus tanta
                                praestantia? Sint ista Graecorum; Cur igitur, cum de re conveniat, non malumus
                                usitate loqui? Huius ego nunc auctoritatem sequens idem faciam.
                                <cite>Wise Man</cite></blockquote>

                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not
                                understand why you should have to spend money on boot camp when you can get the
                                MCSE study materials yourself at a fraction of the camp price. However, who has
                                the willpower to actually sit through a self-imposed MCSE training.
                            </p>
                            <p>
                                MCSE boot camps have its supporters and its detractors. Some people do not
                                understand why you should have to spend money on boot camp when you can get the
                                MCSE study materials yourself at a fraction of the camp price. However, who has
                                the willpower to actually sit through a self-imposed MCSE training. who has the
                                willpower to actually sit through a self-imposed MCSE training.
                            </p>
                        </div>
                        <div class="bottom-wrapper">
                            <div class="row">
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    lily and 4 people like this
                                </div>
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> 06 comments
                                </div>
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                    <ul class="social-icons">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
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
                                            <img src="{{ asset('img/prev.jpg') }}" alt="">
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
                                            <img src="{{ asset('img/next.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End nav Area -->

                        <!-- Start comment-sec Area -->
                        <section class="comment-sec-area pt-80 pb-80">
                            <div class="container">
                                <div class="row flex-column">
                                    <h5 class="text-uppercase pb-80">05 Comments</h5>
                                    <br>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{ asset('img/asset/c1.jpg') }}" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list left-padding">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{ asset('img/asset/c2.jpg') }}" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list left-padding">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{ asset('img/asset/c3.jpg') }}" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{ asset('img/asset/c4.jpg') }}" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{ asset('img/asset/c5.jpg') }}" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End comment-sec Area -->

                        <!-- Start commentform Area -->
                        <section class="commentform-area  pb-120 pt-80 mb-100">
                            <div class="container">
                                <h5 class="text-uppercas pb-50">Leave a Reply</h5>
                                <form action="#" method="post">
                                    <div class="row d-flex flex-row">
                                        <div class="col-lg-6">
                                            <input name="name" placeholder="Enter your name"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter your name'"
                                                class="common-input mb-20 form-control" required="" type="text">
                                            <input name="email" placeholder="Enter your email"
                                                onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter your email'"
                                                class="common-input mb-20 form-control" required="" type="email">
                                            <input name="Subject" placeholder="Subject" onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = 'Enter your Subject'"
                                                class="common-input mb-20 form-control" required="" type="text">
                                        </div>

                                        <div class="col-lg-6">
                                            <textarea class="form-control mb-10" name="message" placeholder="Messege"
                                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"
                                                required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row d-flex flext-row">
                                        <div class="col-lg-5 col-md-12 col-sm-12 mt-3 mt-md-0 float-lg-left">
                                            <div class="g-recaptcha" data-sitekey="{{ env("RECAPTCHA_KEY") }}"></div>
                                        </div>

                                        <div class="col-lg-7 col-md-12">
                                            <button type="submit" class="primary-btn mt-3 float-lg-right">Send
                                                Comment<span class="lnr lnr-arrow-right"></span></button>
                                        </div>
                                    </div>
                                </form>
                        </section>
                    </div>
                </div>

                <div class="col-lg-4 sidebar-area">
                    <div class="single_widget search_widget">
                        <div id="imaginary_container">
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="lnr lnr-magnifier"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="single_widget about_widget">
                        <img src="{{ asset('img/asset/s-img.jpg') }}" alt="">
                        <h2 class="text-uppercase">Adele Gonzalez</h2>
                        <p>
                            MCSE boot camps have its supporters and
                            its detractors. Some people do not understand why you should have to spend money
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
