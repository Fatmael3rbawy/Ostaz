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
                                    Payment List
                                </h5>
                            </div>
                        </div>

                        <table class="table table-flush" id="products-list">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td class="text-sm text-center">{{ $loop->iteration }}</td>
                                        <td class="text-sm text-center">
                                           {{$item->date}}
                                            {{-- {{ \Carbon\Carbon::parse($item->course->start_date)->addMonths($item->date)->format('y-m-d') }} --}}
                                        </td>
                                        <td class="text-sm text-center">
                                            @if ($item->status == 0)
                                                UNPAID
                                            @elseif($item->status == 1)
                                                PAID
                                            @elseif($item->status == 2)
                                                DUE
                                            @elseif($item->status == 3)
                                                REFUND
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
