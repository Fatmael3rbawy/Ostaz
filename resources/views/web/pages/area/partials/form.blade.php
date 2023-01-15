<div class="form-group">
    <label class="form-control-label">Country</label>
    <input class="form-control" type="text" value="Egypt" readonly>
</div>
<div class="form-group">
    <label class="form-control-label">Name</label>
    @error('area')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input class="form-control" type="text" name="area" value="{{ $area->area ?? '' }}" required>
</div>
<div class="form-group">
    <label class="form-control-label">City</label>
    @error('city_id')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <select class="form-control" name="city_id">
        @foreach ($cities as $item)
            <option 
            @if(str_contains(url()->current(), 'edit'))
                @if($area->city->id == $item->id ) selected @endif 
            @endif
            value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
