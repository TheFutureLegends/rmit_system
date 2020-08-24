@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-{!! (isset($club) ? 'pen' : 'plus') !!} icon-gradient bg-mean-fruit"></i>
                {{-- <i class="far fa-plus"></i> --}}
            </div>
            <div>
                @if (isset($user))
                Editing user: "{{ $user->name }}"
                @else
                Create New {{ (Auth::user()->hasRole('super-admin')) ? 'Admin' : ( (Auth::user()->hasRole('admin') ? 'Advisor' : 'President' ) ) }}
                @endif
                <div class="page-title-subheading">
                    @if (isset($user))
                    This is a page where you can edit your user using build-in elements and components.
                    @else
                    New user's password will be sent to the email.
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

<form action="{{ (isset($user)) ? route('user.update', $user->email) : route('user.store') }}" method="post">
    @csrf
    @if (isset($user))
        @method("PUT")
    @endif
    <div class="row">
        <div class="{{ (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor'])) ? 'col-md-12' : 'col-md-8' }}">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="name" class="">Name</label>
                                <input name="name" id="name" autocomplete="off" placeholder="This is placeholder"
                                    type="text" class="form-control" {!! ( isset($user) ) ? 'value="' .$user->name.'"'
                                : '' !!}>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="position-relative form-group">
                                <label for="email" class="">Email</label>
                                <input name="email" id="email" autocomplete="off" placeholder="This is placeholder"
                                    type="email" class="form-control" {!! ( isset($user) ) ? 'value="' .$user->email.'"'
                                : '' !!}>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor']))
        <div class="col-md-4">
            <div class="main-card-md-3 card ">
                <div class="card-body mb-2">
                    <div class="position-relative form-group">
                        <label for="role" class="">Role</label>
                        <select name="role" id="role" class="form-control role">
                            <option disabled selected="selected">Choose role</option>
                            <option value="advisor">Advisor</option>
                            <option value="president">President</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <button type="submit" class="mt-2 btn btn-success">
                @if (isset($user))
                Update
                @else
                Create
                @endif
            </button>
        </div>
    </div>
</form>
@endsection
