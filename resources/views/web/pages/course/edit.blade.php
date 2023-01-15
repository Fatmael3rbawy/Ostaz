@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Edit Course</h3>
            </div>
        </div>

        <form method="POST"  action="{{ route('courses.update', $course->id) }}">
            @csrf
            {{ method_field('PUT') }}

            @include('web.pages.course.partials.form')

        </form>
    </div>
@endsection
