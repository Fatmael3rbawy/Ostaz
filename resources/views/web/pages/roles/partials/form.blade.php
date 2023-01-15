<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">name</label>
            @error('name')
                <br><label style="color: red">{{ $message }}</label>
            @enderror
            <input value="{{ $role->name ?? '' }}" class="form-control" type="text" id="example-text-input"
                name="name">
        </div>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th colspan="6" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                            select permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $key => $item)
                        <tr>
                            <td colspan="6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $key }}"
                                        id="fcustomCheck1" onchange="Check(this)" {{-- @cannot($key . '_index')
                                            disabled
                                        @endcannot --}}
                                        @if (($role->id ?? '') != null) @if ($role->permissions()->where('key', $key ?? '')->count() == 6)
                                            checked @else disabled @endif>
                    @endif
                    <label class="custom-control-label" for="customCheck1">{{ $key }}</label>
        </div>
        </td>
        @foreach ($item as $subitem)
            <td>
                <div class="form-check">
                    <input class="form-check-input {{ $subitem['key'] }}" value="{{ $subitem['id'] }}"
                        type="checkbox" name="{{ $subitem['name'] }}" @cannot($subitem['name']) disabled @endcannot
                        @if (($role->id ?? '') != null) @if ($role->permissions()->where(['role_id' => $role->id ?? '', 'permission_id' => $subitem['id']])->exists())
                                            checked @endif>
        @endif
        <label class="custom-control-label" for="customCheck1">{{ $subitem['display_name'] }}</label>
    </div>
    </td>
    @endforeach
    </tr>
    @endforeach
    </tbody>
    </table>
</div>
</div>
</div>
