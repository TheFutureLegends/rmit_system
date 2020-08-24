<div class="card ">
    <div class="card-body ">
        <div class="row">
            <div class="col-md-4">
                <ul class="nav nav-pills nav-pills-rose flex-column" role="tablist">
                    @foreach ($files as $key => $file)
                    <li class="nav-item">
                        <a class="nav-link pdf-link {!! ($key == 0) ? 'active' : '' !!}" data-pdf="{{ $file->getFullUrl() }}" data-toggle="tab"
                            href="#{{ Str::slug($file->name) }}" role="tablist" data-id="{{ \Str::slug($file->name)}}">
                            {{$file->name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <div class="tab-content">
                    @foreach ($files as $key => $file)
                    <div class="tab-pane pdf-preview {!! ($key == 0) ? 'active' : '' !!}" id="{{ \Str::slug($file->name)}}">

                        <object width="100%" height="1000px" type="application/pdf" data="{{ $file->getFullUrl() }}">
                            <div class="highlight">
                                <h3 class="font-weight-bold">
                                    Sorry! Your browser does not support viewing PDF
                                    <br>
                                    Please use Google Chrome!
                                </h3>
                            </div>
                        </object>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
