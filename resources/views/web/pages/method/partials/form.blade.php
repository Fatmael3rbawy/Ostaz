<div class="form-group">
    <label class="form-control-label">Name</label>
    @error('name')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input class="form-control" type="text" name="name" value="{{ $method->name ?? '' }}" required>
</div>

