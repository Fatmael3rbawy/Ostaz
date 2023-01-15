@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h3>Area List</h3>

            </div>
            @can('areas_create')
                <div class="col-2">
                    <a href="{{ route('area.create') }}" class="btn btn-primary form-control" type="button">add new</a>

                </div>
            @endcan

        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('area.index') }}" method="GET">
                    @include('web.pages.area.partials.search')
                </form>
            </div>
        </div>

        @include('web.pages.area.partials.table')
        <div class="row">
            <div class="col-12 mt-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $areas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
