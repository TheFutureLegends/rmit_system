@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-{!! (isset($event) ? 'pen' : 'plus') !!} icon-gradient bg-mean-fruit"></i>
            </div>
            <div>
                @if (isset($event))
                Editing event: "{{ $event->name }}"
                @else
                Create New Event
                @endif
                <div class="page-title-subheading">
                    @if (isset($event))
                    This is a page where you can edit your event using build-in elements and components.
                    @else
                    This is a page where you can create your new event using build-in elements and components.
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
@endif

<form action="{{ (isset($event)) ? route('event.update', $event->slug) : route('event.store') }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @if (isset($event))
    @method("PUT")
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="name" class="">Event Name</label>
                                <input name="name" id="name" autocomplete="off" placeholder="This is placeholder"
                                    type="text" class="form-control" {!! ( isset($event) ) ? 'value="' .$event->name.'"'
                                : '' !!}>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="event_start" class="">Starting Date & Time</label>
                                <input name="event_start" id="event_start" autocomplete="off"
                                    placeholder="This is placeholder" type="text" class="form-control">
                                @if (isset($event))
                                <small class="form-text text-red">Current: {{ \Carbon\Carbon::parse($event->start_at)->isoFormat(" DD-MMM-YYYY h:mm:ss
                                    A") }} </small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="event_end" class="">Ending Date & Time</label>
                                <input name="event_end" id="event_end" autocomplete="off"
                                    placeholder="This is placeholder" type="text" class="form-control">
                                @if (isset($event))
                                <small class="form-text text-red">Current: {{ \Carbon\Carbon::parse($event->end_at)->isoFormat(" DD-MMM-YYYY h:mm:ss
                                    A") }} </small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label for="description" class="">Description</label>
                        <textarea name="description" id="description" cols="100"
                            rows="10">{{ (isset($event) ? ''.$event->description.'' : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                @if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor']))
                <div class="col-md-12">
                    <div class="main-card-md-3 card mb-3">
                        <div class="card-body">
                            <div class="position-relative form-group">
                                <label for="clubs" class="">Club</label>
                                <select name="club" id="clubs" class="form-control clubs">
                                    @if (isset($event))
                                    {!! loadSelectedClub($event->club->id) !!}
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="main-card-md-3 card mb-3">
                        <div class="card-body">
                            <label class="">Event Proposal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" id="choose-file" class="btn btn-success choose-file">Choose
                                        file</button>
                                </div>
                                <input disabled="disabled" id="file-text" type="text" class="form-control">
                                <input type="file" hidden multiple="" accept=".pdf" name="proposal[]" id="proposal">
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Event Cover -->
                <div class="col-md-12">
                    <div class="main-card-md-3 card mb-3">
                        <div class="card-body">
                            <div class="position-relative form-group">
                                <label for="cover" class="">Event Cover</label>
                                @if (isset($event))
                                <img src="{{ $event->getFirstMediaUrl('cover', 'main') }}" id="preview" width="100%"
                                    height="200px" alt="" srcset="">
                                @else
                                <img src="{{ asset('images/image_placeholder.jpg') }}" id="preview" width="100%"
                                    height="200px" alt="" srcset="">
                                @endif
                            </div>
                            <div class="position-relative form-group text-center">
                                <button type="button" class="btn btn-info btn-round choose-cover"
                                    id="choose-cover">Choose Cover Image</button>
                                <button type="button" class="btn btn-danger btn-round remove-cover" id="remove-cover"
                                    hidden>Remove</button>

                                <input type="file" hidden name="cover" id="cover" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <button type="submit" class="mt-2 btn btn-success">
                @if (isset($event))
                Update
                @else
                Create
                @endif
            </button>
        </div>
    </div>
</form>
@endsection
