@extends('layouts.backend.master')

@section('content')
    <div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-list"></i>
            </div>
            <div>List of Permissions
                <div class="page-title-subheading">
                    This is a page where you can find your permissions using search.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                {{-- class="table table-striped table-bordered" --}}
                {{-- <h5 class="card-title">Table with hover</h5> --}}
                <table class="mb-0 table table-hover" id="permissions-dataTables">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
