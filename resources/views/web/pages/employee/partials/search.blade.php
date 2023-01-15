<div class="input-group mt-3" style="width: 90%">
    <div class="col-3">
        <label>role</label>

    </div>
    <div class="col-3">
        <label>start date</label>

    </div>
    <div class="col-3">
        <label>end date</label>

    </div>
    <div class="col-3">
        <label>email</label>

    </div>
</div>
<div class="input-group mb-3">
    <select name="role_id" class="form-control">
        <option value="0" hidden>search by role</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
    <input type="date" name="start_date" class="form-control" placeholder="from data">
    <input type="date" name="end_date" class="form-control" placeholder="to data">
    <input type="text" name="email" class="form-control" placeholder="search by email">
    <button type="submit" class="btn btn-outline-primary mb-0" type="button" id="button-addon2">search</button>
</div>
