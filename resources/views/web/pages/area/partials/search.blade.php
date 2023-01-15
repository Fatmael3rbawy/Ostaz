<div class="input-group mt-3" style="width: 90%">
    <div class="col-4">
        <label>Country</label>

    </div>
    <div class="col-4">
        <label>City</label>

    </div>
    <div class="col-4">
        <label>Area Name</label>

    </div>
</div>
<div class="input-group mb-3">
    <select name="country" class="form-control">
        <option value="0" hidden>search by Country</option>
        <option value="1">Egypt</option>
    </select>
    <select name="cityId" class="form-control">
        <option value="" >search by City</option>
        @foreach ( $cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
    <input type="text" name="area" class="form-control">
    <button type="submit" class="btn btn-outline-primary mb-0" type="button" id="button-addon2">search</button>
</div>
