@if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor']) && $event->status != 1 )
@if ($event->feedback != null)
<div class="row mt-3 mb-3">
    <div class="col-md-12">
        <h4>Previous feedback</h4>
    </div>

    <div class="col-md-12">
        <div class="feedback-col">
            {!! $event->feedback !!}
        </div>
    </div>
</div>
@endif
<div class="row mt-3">
    <div class="col-md-12">
        <textarea name="feedback" id="description"></textarea>
    </div>
</div>

<div class="row mt-3 mb-3">
    <div class="col-md-12">
        <button type="button" data-slug="{{ $event->slug }}" data-status="1" id="event-approve" class="btn btn-success">Approve</button>
        <button type="button" data-slug="{{ $event->slug }}" data-status="2" id="event-deny" class="btn btn-danger">Deny</button>
    </div>
</div>
@else
<div class="row mt-3 mb-3">
    <div class="col-md-12">
        @if ($event->status == 1 && $event->feedback == null)
        <h2 class="text-red">
            Congratulation! This event is perfect!
        </h2>
        @elseif($event->status != 1 && $event->feedback == null)
        <h2 class="text-red">
            This event is under revision!
        </h2>
        @else
        <h4 class="text-red">
            Feedback
        </h4>
        @endif
    </div>

    @if ($event->feedback != null)
    <div class="col-md-12">
        <div class="feedback-col">
            {!! $event->feedback !!}
        </div>
    </div>
    @endif
</div>
@endif
