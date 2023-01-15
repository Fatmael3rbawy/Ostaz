<div class="card-body px-0 pb-0">
    <div class="table-responsive">

        <table class="table table-flush" id="products-list">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Join Date</th>
                    <th>Phone</th>
                    <th>No of Attendance</th>
                    <th>No of Absent</th>
                    <th>No of Payment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $key => $user)
                    <tr>
                        <td class="text-sm text-center">{{ ++$key }}</td>
                        <td>
                            <h6 class="text-sm text-center">{{ $user->name }}</h6>
                        </td>
                        <td class="text-sm text-center">{{ $user->created_at }}</td>
                        <td class="text-sm text-center">{{ $user->phone }}</td>
                        <td class="text-sm text-center">{{$user->attendances->where('status',1)->count()}}</td>
                        <td class="text-sm text-center">{{$user->attendances->where('status',0)->count()}}</td>
                        <td class="text-sm text-center"><a href="{{ route('students.payment', [$user->id ,$course->id ]) }}">{{ $user->payments->count() }}</a></td>

                        <td class="align-middle text-center text-sm">
                            <a href="{{ route('students.edit',[ $user->id,$course->id])  }}" type="button"
                                data-bs-toggle="tooltip" data-bs-original-title="Edit Student">
                                <i class="fas fa-pen" style="color:deepskyblue"></i>
                            </a>

                            <form style="display:inline" method="GET"
                                action="{{ route('students.block', [$user->id ,$course->id]) }}">
                                @csrf
                                <input name="_method" type="hidden" value="BLOCK">
                                <a class=" show_confirm_block" type="button" data-bs-toggle="tooltip"
                                    data-bs-original-title="Block Student">
                                    <i class="fas fa-ban" style="color:peru"></i>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
