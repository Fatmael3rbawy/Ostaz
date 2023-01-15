<div class="form-group">
    <label for="exampleFormControlInput1">Logo</label>
    @error('photo')
    <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input type="file" name="image" class="form-control image" id="exampleFormControlInput1">
    
</div>
<div class="form-group">
    <img src="{{ asset($list->attachments()->where('key', 'app setting logo')->first()->file ?? '') }}" style="width:100px;" class="img-thumbnail image-preview" alt="">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Welcome Message</label>
    @error('welcome_message')
    <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input type="text" value="{{ $list->welcome_message }}" name="welcome_message" class="form-control" id="exampleFormControlInput1">
</div>