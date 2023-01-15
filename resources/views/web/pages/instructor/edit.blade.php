@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Edit Instructor</h3>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('instructors.update', [$user->id ,'user_id'=>$user->id]) }}">
            @csrf
            {{ method_field('PUT') }}

            @include('web.pages.instructor.partials.form')

        </form>
    </div>
    @include('web.pages.instructor.partials.scripts')
@endsection
