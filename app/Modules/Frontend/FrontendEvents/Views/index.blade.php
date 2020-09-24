@extends('layouts.frontend.master')

@section('title')
Latest Events
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
    <!-- Start post Area -->
    <section class="post-area">
        <div class="container">
            @if ($events->isEmpty())
            <div class="row sidebar-area d-flex justify-content-center">
                <h1 class="text-red mb-50">Sorry! There is no event available at the moment</h1>

                <img src="{{ asset('images/404-error.jpg') }}" alt="">
            </div>
            @else
                <div class="row sidebar-area">
                @foreach ($events as $event)
                    <div class="single-posts col-lg-4 col-sm-4">
                        <img class="img-fluid list-image" src="{{ $event->getFirstMediaUrl('cover', 'list') }}" alt="">
                        <div class="date mt-20 mb-20">{{ Carbon::parse($event->start_at)->isoFormat("DD MMM YYYY") }}</div>
                        <div class="detail">
                            <a href="{{ route('events.frontend.show', $event->slug) }}">
                                <h4 class="pb-20">{{ $event->name }}</h4>
                            </a>
                            <p>
                                {!! words($event->description, 30) !!}
                            </p>
                            {{-- <p class="footer pt-20">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <a href="#">06 Likes</a> <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <a
                                    href="#">02 Comments</a>
                            </p> --}}
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End post Area -->
</div>
<!-- End post Area -->
@endsection
