@extends('web.layouts.base')
@section('content')
    <div class="container card">
        {{-- <div class="row mb-3">
            <div class="col-9 mt-3">
                <h3> Instructor</h3>

            </div>
        </div> --}}
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Instructor Information</h5>
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 text-center">
                                    <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                        src="{{ asset($instructor->attachments()->where('key', 'avatar')->first()->file ?? '') }}"
                                        alt="Instructor Image">

                                </div>
                                <div class="col-lg-5 mx-auto">
                                    <h3 class="mt-lg-0 mt-4">{{ $instructor->name }}</h3>
                                    <h6 class="mt-4">Email : </h6>
                                    <p>{{ $instructor->email }}</p>

                                    <h6 class="mt-lg-0 mt-2">Facebook : </h6>
                                    <p>{{ $instructor->facebook }}</p>

                                    <div class="row mt-4">
                                        <div class="col-lg-5 mt-lg-0 mt-2">
                                            <h6 class="mt-4">Phone:</h6>
                                            <p>{{ $instructor->phone }}</p>
                                        </div>
                                        <div class="col-lg-5 mt-lg-0 mt-2">
                                            <h6 class="mt-4">Whats App:</h6>
                                            <p>{{ $instructor->whatsapp }}</p>
                                        </div>
                                    </div>
                                    <h6 class="mt-lg-0 mt-4">Category:</h6>
                                    <p>@foreach ($instructor->specializations()->where('parent', 1)->get() as $item)
                                        {{ $item->name }},
                                    @endforeach
                                        </p>

                                    <h6 class="mt-lg-0 mt-4">Sub Category:</h6>
                                    <p>
                                        @foreach ($instructor->specializations()->where('parent', 0)->get() as $item)
                                            {{ $item->name }},
                                        @endforeach
                                    </p>

                                    <h6 class="mt-lg-0 mt-4">Teaching Methods:</h6>
                                    <p>
                                        @foreach ($instructor->methods as $item)
                                            {{ $item->name }},
                                        @endforeach
                                    </p>
                                    <h6 class="mt-lg-0 mt-4">Covered City:</h6>
                                    <p>{{ $instructor->areas()->first()->city->name }}</p>

                                    <h6 class="mt-lg-0 mt-4">Covered Areas:</h6>
                                    <p>
                                        @foreach ($instructor->areas as $item)
                                            {{ $item->area }},
                                        @endforeach
                                    </p>

                                    @if ($instructor->description)
                                        <h6 class="mt-4">Description:</h6>
                                        {{ $instructor->description }}
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="row">
                                <h5 class="col-8">Services</h5>
                                <div class="col-4">
                                    <a href="{{ route('courses.create',$instructor->id) }}"
                                        class="btn bg-gradient-primary form-control">+&nbsp;
                                       Add New
                                        Course</a>
                                </div>
                            </div>
                            <div class="table table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Course name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Start Date</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Duration</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Description</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Price</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Students</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($instructor->instructorCourses as $course)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">

                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-center">
                                                                {{ $course->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $course->start_date }}
                                                        </h6>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-center">
                                                            {{ $course->duration }}
                                                        </h6>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-center">
                                                            {{ $course->description ?: 'Null' }}
                                                        </h6>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-center">
                                                            {{ $course->price }}
                                                        </h6>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-center">
                                                           <a  href="{{route('students.index',$course->id)}}">
                                                                List </a>
                                                        </h6>
                                                    </div>
                                                   
                                                </td>
                                                <td class="align-middle text-center text-sm">

                                                    <a href="{{route('courses.edit',[$course->id,$instructor->id])}}" type="button" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit Course">
                                                        <i class="fas fa-pen" style="color:deepskyblue"></i>
                                                    </a>
                                                    <form style="display:inline" method="POST"  action="{{ route('courses.destroy', $course->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <a class=" show_confirm" type="button" data-bs-toggle="tooltip"
                                                            data-bs-original-title="Delete User">
                                                            <i class="fas fa-trash" style="color:red"></i>
                                                        </a>

                                                    </form>
                                                    {{-- </div> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="row mt-4">
                            <div class="col-lg-5">
                                <a href="{{ route('instructors.edit', $instructor->id) . '?view=update' }}">
                                    <button class="btn bg-gradient-primary mb-0 mt-lg-auto w-100" type="button"
                                        name="button">Edit Instructor</button>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
