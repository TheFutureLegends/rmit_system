@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-{!! (isset($role) ? 'pen' : 'plus') !!}"></i>
                {{-- <i class="far fa-plus"></i> --}}
            </div>
            <div>
                @if (isset($role))
                    Edit role: "{{ format_string($role->name) }}"
                @else
                    Create New Role
                @endif
                <div class="page-title-subheading">
                    This is a page where you can create your new role with pre-set permissions using multiple select.
                </div>
            </div>
        </div>
    </div>
</div>
<form class="" method="POST" action="{{ (isset($role)) ? route('role.update', $role->name) : route('role.store') }}">
    <div class="row">
        @csrf
        @if (isset($role))
            @method("PUT")
        @endif
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="name" class="">Role Name</label>
                                <input name="name" id="name" autocomplete="off" placeholder="something-important"
                                    type="text" class="form-control" {!! ( isset($role) ) ? 'value="' .$role->name.'"'
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
                                <label for="permissions" class="">Assign Permission</label>
                                <select name="permissions[]" multiple="multiple" id="permissions" class="form-control permissions">
                                    @if (isset($role))
                                        {!! loadSelectedPermission($role->getPermissionNames()->toArray()) !!}
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
