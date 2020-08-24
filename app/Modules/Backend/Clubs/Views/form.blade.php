@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-{!! (isset($club) ? 'pen' : 'plus') !!} icon-gradient bg-mean-fruit"></i>
            </div>
            <div>
                @if (isset($club))
                Editing club: "{{ $club->name }}"
                @else
                Create New Club
                @endif
                <div class="page-title-subheading">
                    @if (isset($club))
                    This is a page where you can edit your club using build-in elements and components.
                    @else
                    This is a page where you can create your new club using build-in elements and components.
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

<form action="{{ (isset($club)) ? route('club.update', $club->slug) : route('club.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($club))
        @method("PUT")
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="position-relative form-group">
                                <label for="name" class="">Club Name</label>
                                <input name="name" id="name" autocomplete="off" placeholder="This is placeholder"
                                    type="text" class="form-control" {!! ( isset($club) ) ? 'value="' .$club->name.'"'
                                : '' !!}>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="abbreviation" class="">Club Abbreviation</label>
                                <input name="abbreviation" id="abbreviation" autocomplete="off" placeholder="This is placeholder"
                                    type="text" class="form-control" {!! ( isset($club) ) ? 'value="' .$club->abbreviation.'"'
                                : '' !!}>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label for="description" class="">Description</label>
                        <textarea name="description" id="description" cols="100"
                            rows="10">{{ (isset($club) ? ''.$club->description.'' : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side -->
        <div class="col-md-4">
            <div class="row">
                @if (Auth::user()->hasAnyRole(['super-admin', 'admin']))
                <!-- Advisor Selection -->
                <div class="col-md-12">
                    <div class="main-card-md-3 card mb-3">
                        <div class="card-body">
                            <div class="position-relative form-group">
                                <label for="advisor" class="">Advisor</label>
                                <select name="advisor" id="advisor" class="form-control advisor">
                                    @if (isset($club))
                                        {!! loadSelectedUser($club->advisor->id) !!}
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- President Selection -->
                <div class="col-md-12">
                    <div class="main-card-md-3 card mb-3">
                        <div class="card-body">
                            <div class="position-relative form-group">
                                <label for="president" class="">President</label>
                                <select name="president" id="president" class="form-control president">
                                    @if (isset($club))
                                        {!! loadSelectedUser($club->president->id) !!}
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Club Logo -->
                <div class="col-md-12">
                    <div class="main-card-md-3 card mb-3">
                        <div class="card-body">
                            <div class="position-relative form-group">
                                <label>Club Logo</label>
                                @if (isset($club))
                                    <img src="{{ $club->getFirstMediaUrl('logo', 'main') }}" id="preview" width="100%" height="200px" alt="" srcset="">
                                @else
                                <img src="{{ asset('images/image_placeholder.jpg') }}" id="preview" width="100%" height="200px" alt="" srcset="">
                                @endif
                            </div>
                            <div class="position-relative form-group text-center">
                                <button type="button" class="btn btn-info btn-round choose-cover" id="choose-cover">Choose Logo</button>
                                <button type="button" class="btn btn-danger btn-round remove-cover" id="remove-cover" hidden>Remove</button>

                                <input type="file" hidden name="logo" id="cover" accept="image/*">
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
                @if (isset($club))
                Update
                @else
                Create
                @endif
            </button>
        </div>
    </div>
</form>
@endsection
