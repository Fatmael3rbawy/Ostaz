@extends('web.layouts.base')
@section('content')
    <div class="container card">
        <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3>Edit {{ $category->name }}</h3>

            </div>
        </div>
        <form method="POST" action="{{ route('sub-categories.update',$category->id)  }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @include('web.pages.sub_category.partials.form')
            <button type="submit" class="btn btn-primary form-control mt-3">Add</button>
        </form>
    </div>
@endsection
