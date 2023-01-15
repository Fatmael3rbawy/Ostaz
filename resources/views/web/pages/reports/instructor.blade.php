@extends('web.layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h3>Reports</h3>

            </div>

            @include('web.pages.reports.partials.export')

        </div>
        <div class="row mt-3">
            @include('web.pages.reports.partials.nav')
            <div class="tab-content" id="myTabContent">

                <form method="GET" action="{{ route('report.instructor') }}">
                    <div class="input-group mt-3" style="width: 90%">
                        <div class="col-4">
                            <label>Specializations</label>

                        </div>
                        <div class="col-4">
                            <label>City</label>

                        </div>
                        <div class="col-4">
                            <label>Area</label>

                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="specialization" class="form-control">
                            <option value="0" hidden>select specialization</option>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                        <select id="citySelector" name="city" class="form-control" onchange="ajaxFiltration('citySelector','areaSelector','{{ route('get-area') }}')">
                            <option value="0" hidden>select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <select id="areaSelector" name="area" class="form-control">
                            <option value="0" hidden>search by Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-primary mb-0" type="button"
                            id="button-addon2">search</button>
                    </div>
                </form>

                <div class="tab-pane fade show active mt-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('web.pages.reports.partials.instructors_table')
                    {{ $instructors->links() }}
                </div>
            </div>

        </div>

    </div>
@endsection
