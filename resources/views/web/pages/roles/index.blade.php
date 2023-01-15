@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">
                <h3>Roles List</h3>

            </div>
            @can('roles_create')
                <div class="col-3">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary form-control" type="button">add new</a>

                </div>
            @endcan
        </div>
        <div class="row my-3">
            <form method="GET" action="{{ route('roles.index') }}">

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control">
                    <button type="submit" class="btn btn-outline-primary mb-0" type="button"
                        id="button-addon2">search</button>
                </div>
            </form>

        </div>


        @include('web.pages.roles.partials.table')
        <div class="row">
            <div class="col-12 mt-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
