@extends('web.layouts.base')
@section('content')
    <div class="container-fluid py-4 px-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">

                            <div>
                                <h5 class="mb-0">
                                    @if (!request()->query('view') )
                                        All Users
                                    @else
                                        All Instructors
                                    @endif
                                </h5>

                            </div>
                            @if (request()->query('view') == 'instructor')
                                <div class="ms-auto my-auto mt-lg-0 mt-4">

                                    <div class="ms-auto my-auto">
                                        <a href="{{ route('instructors.create') }}"
                                            class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                            New
                                            Instructor</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="row my-3">
                            <form method="GET" action="{{ route('users.index')}}">
                                @csrf
                                <input name='type' value="{{request('type')}}"  hidden>
                                <input name='specialization' value="{{request('specialization')}}"  hidden>
                                <input name='view' value="{{request('view')}}"  hidden>

                                <div class="input-group mb-3">
                                    <input type="text" name="text" class="form-control"
                                        placeholder="Please enter the user's email or name">

                                    <button type="submit" class="btn btn-outline-primary mb-0" type="button"
                                        id="button-addon2">search</button>
                                </div>
                            </form>

                        </div>
                        <div class="row my-3 align-middle text-center text-sm">
                            <form method="GET" action="{{  route('users.index') }}">
                                @csrf
                                <input name='type' value="{{request('type')}}"  hidden>
                                <input name='specialization' value="{{request('specialization')}}"  hidden>
                                <input name='view' value="{{request('view')}}"  hidden>

                                <select class="multisteps-form__select btn btn-outline-primary btn-sm  mb-0 " name="city"
                                    style="padding-left: 0rem;padding-right: 0rem;" onchange="changeArea(this)">
                                    <option value=""> City</option>
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                                <select id="areaSelect" style="padding-left: 0rem;padding-right: 0rem;"
                                    class="multisteps-form__select btn btn-outline-primary btn-sm  mb-0  " name="area">
                                    <option value=""> Area</option>
                                    @foreach ($areas as $item)
                                        <option class="c{{ $item->city->id }}" value="{{ $item->id }}">
                                            {{ $item->area }}</option>
                                    @endforeach
                                </select>
                                @if (!request()->query('view') )
                                <select class="multisteps-form__select btn btn-outline-primary btn-sm  mb-0  "
                                    name="specialization">
                                    <option value=""> Category</option>
                                    @foreach ($specializations as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <select style="padding-left: 0rem;padding-right: 0rem;"
                                    class="multisteps-form__select btn btn-outline-primary btn-sm  mb-0  " name="type">
                                    <option value=""> Type</option>
                                    <option value="3">Instructor</option>
                                    <option value="5">Student</option>
                                </select>
                                <select class="multisteps-form__select btn btn-outline-primary btn-sm  mb-0  "
                                    name="feature">
                                    <option value=""> Feature</option>
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                @endif
                                <button type="submit" class="btn bg-gradient-primary btn-sm mb-0">
                                    Filter
                                </button>
                            </form>
                        </div>
                        @if (session('message'))
                            <div class="alert alert-danger text-center">{{ session('message') }}</div>
                        @endif
                        @include('web.pages.user.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('web.pages.user.partials.scripts')
    <div class="col-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $users->links() }}
        </div>
    </div>
@endsection
