<form action="{{ route('profile.update.password') }}" class="needs-validation" method="post" novalidate="novalidate">
    @csrf
    <div class="form-row mt-3">
        <div class="col-md-12 mb-3">
            <label for="current_password">Current Password</label>
            <input autocomplete="off" type="password" name="current_password" class="form-control" id="current_password"
                required placeholder="Current Password">
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- New Password -->
        <div class="col-md-6">
            <label for="password">New Password</label>
            <input autocomplete="off" type="password" name="password" class="form-control" id="password"
                placeholder="New Password" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <!-- Confirm Password -->
        <div class="col-md-6">
            <label for="password_confirmation">Confirm Password</label>
            <input autocomplete="off" type="password" name="password_confirmation" class="form-control"
                id="password_confirmation" required placeholder="Confirm Password">
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
