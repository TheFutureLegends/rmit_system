@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-{!! (isset($permission) ? 'pen' : 'plus') !!}"></i>
                {{-- <i class="far fa-plus"></i> --}}
            </div>
            <div>
                @if (isset($permission))
                    Edit permission: "{{ format_string($permission->name) }}"
                @else
                    Create New Permission
                @endif
                <div class="page-title-subheading">
                    This is a page where you can create your new permission with pre-set role using multiple select.
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
<form class="" method="POST" action="{{ (isset($permission)) ? route('permission.update', $permission->name) : route('permission.store') }}">
    <div class="row">
        @csrf
        @if (isset($permission))
            @method("PUT")
        @endif
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="name" class="">Permission Name</label>
                                <input name="name" id="name" autocomplete="off" placeholder="some.permissions.important"
                                    type="text" class="form-control" {!! ( isset($permission) ) ? 'value="' .$permission->name.'"'
                                : '' !!}>
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
                                <label for="roles" class="">Assign Role</label>
                                <select name="roles[]" multiple="multiple" id="roles" class="form-control roles">
                                    @if (isset($permission))
                                        {!! loadSelectedRole($permission->getRoleNames()->toArray()) !!}
                                    @endif
                                </select>
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
                @if (isset($role))
                Update
                @else
                Create
                @endif
            </button>
        </div>
    </div>
</form>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection
