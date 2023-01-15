<div class="form-group">
    <label for="exampleFormControlInput1">Photo</label>
    @error('image')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input type="file" name="image" class="form-control image" id="exampleFormControlInput1">

</div>
<div class="form-group">

    <img @if (str_contains(url()->current(), 'edit')) src="{{ asset($category->attachments()->where('key', 'category')->first()->file ?? '') }}" @endif
        style="width:100px;" class="img-thumbnail image-preview" alt="">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    @error('name')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input type="text" value="{{ $category->name ?? '' }}" name="name" class="form-control"
        id="exampleFormControlInput1">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Main Category</label>
    @error('parent_id')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <select type="text" name="parent_id" class="form-control"
        id="exampleFormControlInput1">
        <option>choose</option>  

        @foreach ($categories as $main_category)
            <option value="{{ $main_category->id }}" @if ($category->mainSpecialization->id ?? '' == $main_category->id )
                selected
            @endif >{{ $main_category->name }}</option>  
        @endforeach
    </select>
</div>
