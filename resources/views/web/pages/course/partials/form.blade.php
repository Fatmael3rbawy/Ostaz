<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="multisteps-form__content">
                        <input class="form-control" type="text" hidden name="instructor_id" value="{{ $instructor->id }}" required>

                        <div class="form-group">
                            <label class="form-control-label">Course Name</label>
                            <input class="form-control" type="text" name="name" required
                                value="{{ $course->name ?? '' }}">
                            @error('name')
                                <br><label style="color: red">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Description</label>
                            <input class="form-control" type="text" name="description" value="{{ $course->description ?? '' }}" required>
                            @error('description')
                                <br><label style="color: red">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label class="form-control-label">Start Date</label>
                                <input class="form-control" type="date" name="start_date" required value="{{ $course->start_date ?? '' }}">
                                @error('start_date')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="form-control-label">Duration In Month</label>
                                <input class="form-control" type="text" name="duration" required value="{{ $course->duration ?? '' }}">
                                @error('duration')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label class="form-control-label">Price</label>
                                <input class="form-control" type="text" name="price" required value="{{ $course->price ?? '' }}">
                                @error('price')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                <label> Category</label>
                                <select id="catSelect" required class="multisteps-form__select form-control" 
                                    name="mainspecialization_id" onchange="ajaxFiltration('catSelect','subSelect','{{ route('get-subCat') }}')">

                                    <option value="">Choose Category</option>
                                    @foreach ($instructor->specializations()->where('parent',1)->get() as $item)
                                        <option
                                            @if (str_contains(url()->current(), 'edit'))
                                             @if ($course->specialization_id == $item->id) selected @endif
                                            @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                <label>Sub Category</label>
                                <select id="subSelect" required class="multisteps-form__select form-control" name="specialization_id">

                                    <option value="">Choose Category First</option>

                                </select>
                                @error('category')
                                    <br><label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="button-row  mt-3 ">
                            <button type="submit" style="width: 90%" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
