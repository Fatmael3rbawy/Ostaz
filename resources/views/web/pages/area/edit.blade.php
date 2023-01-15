@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Edit Area</h3>

            </div>
        </div>
        <form method="POST" action="{{ route('area.update' , $area->id) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @include('web.pages.area.partials.form')
            <button type="submit" class="btn btn-primary form-control mt-3">Update</button>
        </form>
    </div>
@endsection
