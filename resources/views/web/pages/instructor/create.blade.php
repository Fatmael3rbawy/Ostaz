@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Create New Instructor</h3>

            </div>
        </div>
        
        <form method="POST"  enctype="multipart/form-data" action="{{ route('instructors.store') }}">
            @csrf
            @include('web.pages.instructor.partials.form')
            
        </form>
    </div>
    @include('web.pages.instructor.partials.scripts')

@endsection