<form action="{{ route('profile.update.bio') }}" class="needs-validation" method="post" novalidate="novalidate">
    @csrf
    <div class="form-row mt-3">
        <div class="{{ (Auth::user()->hasRole('super-admin')) ? 'col-md-4' : 'col-md-12' }} col-md-4 mb-3">
            <label for="name">Name (Min: 5 characters)</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Full name" minlength="5"
                value="{{ Auth::user()->name }}" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        @if (Auth::user()->hasRole('super-admin'))
        <div class="col-md-8 mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email address"
                value="{{ Auth::user()->email }}" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        @endif
    </div>
    <div class="form-row">
        <div class="col-md-12 mb-3">
            <label for="about_me">About Me (Max: 255 characters)</label>
            <textarea name="about_me" id="about_me" class="form-control" style="width: 100%" rows="10"
                maxlength="255">{{ Auth::user()->about_me }}</textarea>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-12">
            <button type="submit" class="mt-2 btn btn-success">
                Update
            </button>
        </div>
    </div>
</form>
