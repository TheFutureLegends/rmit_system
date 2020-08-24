@extends('layouts.backend.master')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-list"></i>
            </div>
            <div>Detail of event: {{ $event->name }}
                <div class="page-title-subheading">
                    This is a page where you can view event detail.
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-c1-0" data-toggle="tab" href="#detail">
                            <span class="nav-text">Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#proposal">
                            <span class="nav-text">Propsosal</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c1-2" data-toggle="tab" href="#feedback">
                            <span class="nav-text">Feedback</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="detail" role="tabpanel">
                        @include('Events::tab.detail')
                    </div>
                    <div class="tab-pane" id="proposal" role="tabpanel">
                        @include('Events::tab.proposal')
                    </div>
                    <div class="tab-pane" id="feedback" role="tabpanel">
                        @include('Events::tab.feedback')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection
