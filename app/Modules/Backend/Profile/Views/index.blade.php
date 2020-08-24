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
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-c1-0" data-toggle="tab" href="#basic-information">
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
                    <div class="tab-pane active" id="basic-information" role="tabpanel">
                        <form action="{{ route('profile.update.bio') }}" class="needs-validation" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-row mt-3">
                                <div
                                    class="{{ (Auth::user()->hasRole('super-admin')) ? 'col-md-4' : 'col-md-12' }} col-md-4 mb-3">
                                    <label for="name">Name (Min: 5 characters)</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Full name" minlength="5" value="{{ Auth::user()->name }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                @if (Auth::user()->hasRole('super-admin'))
                                <div class="col-md-8 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email address" value="{{ Auth::user()->email }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                @endif
                            </div>
                            @if (!Auth::user()->hasRole('president'))
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="about_me">About Me (Max: 255 characters)</label>
                                    <textarea name="about_me" id="about_me" class="form-control" style="width: 100%"
                                        rows="10" maxlength="255">{{ Auth::user()->about_me }}</textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="about_me">Club Biography:</label>
                                    <textarea name="description" id="description" cols="100" rows="10">{{ Auth::user()->president->description }}</textarea>
                                </div>
                            </div>
                            @endif

                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-2 btn btn-success">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Password pane -->
                    <div class="tab-pane" id="secure-information" role="tabpanel">
                        <form action="{{ route('profile.update.password') }}" class="needs-validation" method="post"
                            novalidate="novalidate">
                            @csrf
                            <div class="form-row mt-3">
                                <div class="col-md-12 mb-3">
                                    <label for="current_password">Current Password</label>
                                    <input autocomplete="off" type="password" name="current_password"
                                        class="form-control" id="current_password" required placeholder="Current Password">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- New Password -->
                                <div class="col-md-6">
                                    <label for="password">New Password</label>
                                    <input autocomplete="off" type="password" name="password" class="form-control"
                                        id="password" placeholder="New Password" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input autocomplete="off" type="password" name="password_confirmation"
                                        class="form-control" id="password_confirmation" required placeholder="Confirm Password">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-2 btn btn-success">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-md-0 mt-sm-4">
        <div class="main-card-md-3 card mb-3">
            <div class="card-body">
                <div class="position-relative form-group text-center">
                    <img src="{{ ( !(Auth::user()->getMedia('avatar'))->isEmpty() ) ? Auth::user()->getFirstMediaUrl('avatar', 'profile') : asset('images/default_avatar.png') }}" class="rounded-circle avatar" id="preview" alt="" srcset="">
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
                <div class="position-relative form-group text-center">
                    <button type="button" class="btn btn-info btn-round choose-avatar" id="choose-avatar">Choose Avatar</button>
                </div>

                <form action="{{ route('profile.update.avatar') }}" method="post" enctype="multipart/form-data" id="avatar-form" hidden>
                    @csrf
                    <input type="file" hidden name="avatar" id="avatar" accept="image/*">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

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
