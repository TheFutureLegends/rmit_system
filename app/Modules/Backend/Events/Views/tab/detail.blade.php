<div class="row mt-3">
    <div class="col-md-12 text-center">
        <h1>{{ $event->name }}</h1>
    </div>
    <div class="col-md-12 text-center">
        <img src="{{ $event->getFirstMediaUrl('cover', 'main') }}" width="50%" alt="">
    </div>
</div>

<div class="row mt-3 text-center">
    <div class="col-md-4">
        <h5>Club</h5>
        <div class="badge badge-success">
            {{ $event->club->name }}
        </div>
    </div>
    <div class="col-md-4">
        <h5>Duration</h5>
        <div class="badge badge-danger">
            {{ \Carbon\Carbon::parse($event->end_at)->diffForHumans(\Carbon\Carbon::parse($event->start_at), true) }}
        </div>
    </div>
    <div class="col-md-4">
        <h5>Start At</h5>
        <div class="badge badge-info">
            {{\Carbon\Carbon::parse($event->start_at)->isoFormat("DD-MMM-Y H:mm:ss")}}
        </div>
    </div>
</div>

<div class="row mt-3 mb-3">
    <div class="col-md-12 text-center">
        {!! $event->description !!}
    </div>
</div>
