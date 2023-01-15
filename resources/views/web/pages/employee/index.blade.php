@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h3>Employee List</h3>

            </div>
            <div class="col-4">
                <a href="{{ route('employees.create') }}" class="btn btn-primary form-control" type="button">add new</a>
                
            </div>
            <div class="col-3">
                <select class="btn btn-primary form-control" onchange="window.location.href=this.options[this.selectedIndex].value;">
                    <option hidden>EXPORT</option>
                    <option value="{{ route('employees.export.pdf') }}">PDF</option>
                    <option value="{{ route('employees.export.excel') }}">EXCEL</option>
                </select>
                
            </div>
            
        </div>
        

        <div class="row">
            <div class="col-12">
                <form action="{{ route('employees.index') }}" method="GET">
                    @include('web.pages.employee.partials.search')
                </form>
            </div>
        </div>

        @include('web.pages.employee.partials.table')
        <div class="row">
            <div class="col-12 mt-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
