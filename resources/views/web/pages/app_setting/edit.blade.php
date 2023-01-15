@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Edit App Setting</h3>

            </div>
        </div>
        
        <form method="POST"  action="{{ route('app-setting.update' , 1) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @include('web.pages.app_setting.partials.form')
            <button type="submit" class="btn btn-primary form-control mt-3">Update</button>
        </form>
    </div>
    @include('web.pages.employee.partials.scripts')
@endsection
