@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h3>Sub Categories</h3>

            </div>
            @can('sub_specializations_create')
                <div class="col-4">
                    <a href="{{ route('sub-categories.create') }}" class="btn btn-primary form-control" type="button">add new</a>
                </div>
            @endcan

        </div>

        @include('web.pages.sub_category.partials.table')
        <div class="row">
            <div class="col-12 mt-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
