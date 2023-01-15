@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-9">
                <h3>Edit Role: {{ $role->name }}</h3>
            </div>
        </div>
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            {{ method_field('PUT') }}
            @include('web.pages.roles.partials.form')
            <button type="submit" class="btn btn-primary form-control mt-3">Save</button>
        </form>
    </div>


    @include('web.pages.roles.partials.scripts')
@endsection
