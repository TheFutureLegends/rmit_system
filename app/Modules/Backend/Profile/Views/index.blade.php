@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-user icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                @if (Auth::user()->hasRole('president'))
                Club Profile
                @else
                User Profile
                @endif
                <div class="page-title-subheading">
                    This is a profile page where you can edit yours using build-in elements and components.
                </div>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
@foreach ($errors->all() as $error)
<div class="row">
    <div class="col-md-8">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

@endforeach
@endif

<div class="row">
    <div class="col-md-8">
        <div class="mb-3 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                    @if (Auth::user()->hasRole('president'))
                    <li class="nav-item">
                        <a role="tab" class="nav-link {{ (Auth::user()->hasRole('president')) ? "active" : "" }}" id="tab-c1-0" data-toggle="tab" href="#club-information">
                            <span class="nav-text">Club Information</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a role="tab" class="nav-link {{ (!Auth::user()->hasRole('president')) ? "active" : "" }}" id="tab-c1-0" data-toggle="tab" href="#basic-information">
                            <span class="nav-text">Basic Information</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#secure-information">
                            <span class="nav-text">Change password</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @if (Auth::user()->hasRole('president'))
                    <div class="tab-pane {{ (Auth::user()->hasRole('president')) ? "active" : "" }}" id="club-information" role="tabpanel">
                        @include('Profile::Sections.club')
                    </div>
                    @endif
                    
                    <div class="tab-pane {{ (!Auth::user()->hasRole('president')) ? "active" : "" }}" id="basic-information" role="tabpanel">
                        @include('Profile::Sections.basic')
                    </div>

                    <!-- Password pane -->
                    <div class="tab-pane" id="secure-information" role="tabpanel">
                        @include('Profile::Sections.password')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-md-0 mt-sm-4">
        <div class="main-card-md-3 card mb-3">
            <div class="card-body">
                <div class="position-relative form-group text-center">
                    @if (Auth::user()->hasRole('president'))
                    <img src="{{ ( !(Auth::user()->president->getMedia('logo'))->isEmpty() ) ? Auth::user()->president->getFirstMediaUrl('logo', 'avatar') : asset('images/default_avatar.png') }}" class="rounded-circle avatar" id="preview" alt="" srcset="">
                    @else
                    <img src="{{ ( !(Auth::user()->getMedia('avatar'))->isEmpty() ) ? Auth::user()->getFirstMediaUrl('avatar', 'profile') : asset('images/default_avatar.png') }}" class="rounded-circle avatar" id="preview" alt="" srcset="">
                    @endif
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12 text-center">
                        <h3>{{ Auth::user()->name }}</h3>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12 text-center">
                        <h6 class="card-subtitle">{{ Auth::user()->formatRoleName() }}</h6>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-md-12 text-center">
                        @if (Auth::user()->hasRole('president'))
                            {!! Auth::user()->president->description !!}
                        @else
                            {{ Auth::user()->about_me }}
                        @endif
                    </div>
                </div>
                @if (!Auth::user()->hasRole('president'))
                <div class="position-relative form-group text-center">
                    <button type="button" class="btn btn-info btn-round choose-avatar" id="choose-avatar">Choose Avatar</button>
                </div>

                <form action="{{ route('profile.update.avatar') }}" method="post" enctype="multipart/form-data" id="avatar-form" hidden>
                    @csrf
                    <input type="file" hidden name="avatar" id="avatar" accept="image/*">
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@if (!Auth::user()->hasRole('president'))
@section('javascript')
<script type="text/javascript">
    $(document).on("click", "#choose-avatar", function(e) {
        e.preventDefault();

        $("#avatar").click();
    });

    $("#avatar").change(function() {
        $('#avatar-form').submit();

        console.clear();
    });
</script>
@endsection
@endif
