@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-9">
                <h3>Role: {{ $role->name }}</h3>
            </div>
            @if($role->id != 1)
                @can('roles_edit')
                    <div class="col-3">
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary form-control mt-3">Edit</a>
                    </div>
                @endcan
            @endif
        </div>

        @include('web.pages.roles.partials.form')

    </div>


    @include('web.pages.roles.partials.scripts')
@endsection
