<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="multisteps-form__content">
                        <input class="form-control" type="text" hidden name="course_id" value="{{ request('course_id') }}" required>

                        <div class="form-group">
                            <label class="form-control-label">Student Name</label>
                            <input class="form-control" type="text" name="name" required
                                value="{{ $student->name  }}">
                            @error('name')
                                <br><label style="color: red">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"> Phone Number</label>
                            <input class="form-control" type="text" name="phone" required
                                value="{{ $student->phone  }}">
                            @error('phone')
                                <br><label style="color: red">{{ $message }}</label>
                            @enderror
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
