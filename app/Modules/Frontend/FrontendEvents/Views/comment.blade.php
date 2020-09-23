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
                            <img class="thumb-image" src="{{ asset('img/asset/c1.jpg') }}" alt="">
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
                            <img class="thumb-image" src="{{ asset('img/asset/c2.jpg') }}" alt="">
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
                            <img class="thumb-image" src="{{ asset('img/asset/c3.jpg') }}" alt="">
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
                            <img class="thumb-image" src="{{ asset('img/asset/c4.jpg') }}" alt="">
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
                            <img class="thumb-image" src="{{ asset('img/asset/c5.jpg') }}" alt="">
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
<section class="commentform-area mb-5">
    <div class="container">
        <h5 class="text-uppercas pb-50">Leave a Reply</h5>
        <form action="#" method="post">
            <!-- For Guest user -->
            @guest
            <div class="row d-flex flex-row">
                <div class="col-lg-6">
                    <input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control"
                        required="" type="text">
                    <input name="email" placeholder="Enter your email" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your email'" class="common-input mb-20 form-control"
                        required="" type="email">
                    <input name="Subject" placeholder="Subject" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your Subject'" class="common-input mb-20 form-control"
                        required="" type="text">
                </div>

                <div class="col-lg-6">
                    <textarea class="form-control mb-10" name="message" placeholder="Messege"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
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
            @else
            <!-- For Auth User -->
            <div class="row d-flex flex-row">
                <div class="col-md-12">
                    <input name="Subject" placeholder="Subject" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your Subject'" class="common-input mb-20 form-control"
                        required="" type="text">
                </div>

                <div class="col-md-12">
                    <textarea class="form-control mb-10" name="message" rows="10" placeholder="Messege"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                </div>
            </div>
            <div class="row d-flex flext-row">
                <div class="col-lg-5 col-md-12 col-sm-12 mt-1 mt-md-0 float-lg-left">
                    <div class="g-recaptcha" data-sitekey="{{ env("RECAPTCHA_KEY") }}"></div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <button type="submit" class="primary-btn mt-3 float-lg-right">Send
                        Comment<span class="lnr lnr-arrow-right"></span></button>
                </div>
            </div>
            @endguest
        </form>
</section>
