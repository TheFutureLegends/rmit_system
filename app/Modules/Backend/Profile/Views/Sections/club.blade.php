<form action="{{ route('profile.update.club') }}" class="needs-validation" method="post" novalidate="novalidate">
    @csrf
    <div class="form-row mt-3">
        <div class="col-md-12 mb-3">
            <label for="about_me">Club Description:</label>
            <textarea name="description" id="description" cols="100"
                rows="10">{{ Auth::user()->president->description }}</textarea>
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
