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
                                    All Students
                                </h5>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">

                                <div class="ms-auto my-auto">
                                    <a href="{{ route('courses.add.students', $course->id) }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                       Add New
                                        Student</a>
                                </div>
                            </div>
                        </div>

                        @if (session('message'))
                            <div class="alert alert-danger text-center">{{ session('message') }}</div>
                        @endif
                        @include('web.pages.student.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- {{ $students->links() }} --}}
        </div>
    </div>
@endsection
