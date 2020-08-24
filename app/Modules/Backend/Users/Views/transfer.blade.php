@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div>
                Transfer Club in possessed of {{ $user->email }}
                <div class="page-title-subheading">
                    This is a page where you can transfer club using build-in elements and components.
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

<form action="{{ route('user.update', $user->email) }}" method="post">
    @csrf
    @method("PUT")
    <div class="row">
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="email" class="">Transfer From</label>
                                <input disabled id="email" autocomplete="off" placeholder="This is placeholder"
                                    type="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <div class="position-relative form-group">
                                <label for="email" class="">Transfer To</label>
                                <select name="transfer_advisor" id="available-advisor" class="form-control available-advisor"></select>
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
                Transfer
            </button>
        </div>
    </div>
</form>

@endsection
