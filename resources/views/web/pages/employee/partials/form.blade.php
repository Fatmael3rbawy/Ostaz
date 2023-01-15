<div class="form-group">
    <label class="form-control-label">Name</label>
    @error('name')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input class="form-control" type="text" name="name" value="{{ $employee->name ?? '' }}">
</div>
<div class="form-group">
    <label class="form-control-label">Email</label>
    @error('email')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <input class="form-control" type="email" name="email" value="{{ $employee->email ?? '' }}">
</div>
{{-- <div class="form-group">
    <label for="">city</label><br>
    <select name="city_id" class="form-control" id="">
        @foreach ($cities as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="">Area</label><br>
    <select name="area_id" class="form-control" id="">
        
    </select>
</div> --}}
<div class="form-group">
    <label class="form-control-label">Role</label>
    @error('role')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    <select class="form-control" name="role">
        @foreach ($list as $item)
            <option 
            @if(str_contains(url()->current(), 'edit'))
                @if($employee->roles->first()->id == $item->id ) selected @endif 
            @endif
            value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="form-control-label">Avtar</label>
    @error('image')
        <br><label style="color: red">{{ $message }}</label>
    @enderror
    @if(str_contains(url()->current(), 'edit'))
    <br><img src="{{ asset($employee->attachments()->where('key', 'avatar')->first()->file ?? '') }}" alt="bruce" class="border-radius-lg shadow-sm" width="100" height="100">
    @endif
    <input class="form-control" type="file" name="image">
</div>
