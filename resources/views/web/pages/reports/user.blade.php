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
            <div class="tab-content mt-3" id="myTabContent">
                
                <form method="GET" action="{{ route('report.user') }}">
                    <div class="input-group mt-3" style="width: 90%">
                        <div class="col-6">
                            <label>City</label>
                    
                        </div>
                        <div class="col-6">
                            <label>Area</label>
                    
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select id="citySelector" name="city" class="form-control" onchange="ajaxFiltration('citySelector','areaSelector','{{ route('get-area') }}')">
                            <option value="0" hidden>select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    
                        <select id="areaSelector" name="area" class="form-control" >
                            <option value="0" hidden>search by Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-primary mb-0" type="button" id="button-addon2">search</button>
                    </div>
                </form>



                @include('web.pages.reports.partials.users_table')
                {{ $users->links() }}


            </div>

        </div>

    </div>
@endsection
