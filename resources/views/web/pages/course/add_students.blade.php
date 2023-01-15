@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Add New Students</h3>

            </div>
        </div>
        <form method="POST" action="{{ route('courses.store.students') }}" >
            @csrf
            <div class="form-group">
                <input name="course_id" value="{{ $course_id }}" hidden>
                <label class="form-control-label">Choose Students</label>
                @error('students')
                    <br><label style="color: red">{{ $message }}</label>
                @enderror
                <select multiple class="form-control" type="text" name="students[]">
                    @foreach ($students as $student )
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary form-control mt-3">Add</button>
        </form>
    </div>
    @include('web.pages.employee.partials.scripts')
@endsection
