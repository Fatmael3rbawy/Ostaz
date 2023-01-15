@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h3>App Setting</h3>

            </div>
            @can('app_settings_index')
                <div class="col-4">
                    <a href="{{ route('app-setting.edit', 1) }}" class="btn btn-primary form-control" type="button">update</a>

                </div>
            @endcan
        </div>
        <div class="row mt-3">
            <div class="col-4">
            </div>
            <div class="col-4">
                @include('web.pages.app_setting.partials.card')
            </div>
            <div class="col-4">
            </div>
        </div>

    </div>
@endsection
