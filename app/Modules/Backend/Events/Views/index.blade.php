@extends('layouts.backend.master')

@section('content')
    <div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-list icon-gradient bg-mean-fruit"></i>
            </div>
            <div>List of Events
                <div class="page-title-subheading">
                    This is a page where you can find your event using search.
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
                <table class="mb-0 table table-hover table-responsive-md" id="events-dataTables">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>
                                @if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor']))
                                Club
                                @else
                                Created By
                                @endif
                            </th>
                            <th>Start At</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Event Name</th>
                            <th>
                                @if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor']))
                                Club
                                @else
                                Created By
                                @endif
                            </th>
                            <th>Start At</th>
                            <th>Duration</th>
                            <th>Status</th>
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
