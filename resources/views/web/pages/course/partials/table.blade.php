<div class="card-body px-0 pb-0">
    <div class="table-responsive">

        <table class="table table-flush" id="products-list">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Area</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td class="text-sm text-center">{{ ++$key }}</td>
                        <td>
                            <h6 class="text-sm text-center">{{ $user->name }}</h6>
                        </td>
                        <td class="text-sm text-center">{{ $user->email }}</td>
                        <td class="text-sm text-center">{{ $user->phone }}</td>
                        <td class="text-sm text-center"> {{($user->areas->first()->city_id ?? '')}}</td>
                        <td class="text-sm text-center"> {{ $user->areas->first()->area ?? '' }}</td>
                        <td class="text-sm text-center"> {{ $user->specializations->first()->name ?? '' }} </td>
                        <td class="text-sm text-center">
                            @switch($user->type)
                                @case(3)
                                    Instructor
                                @break

                                @case(4)
                                    Parent
                                @break

                                @case(5)
                                    Student
                                @break
                            @endswitch
                        </td>
                       
                        <td class="align-middle text-center text-sm">
                            @if ($user->type == 4 || $user->type == 5)
                                <a href="{{ route('instructors.upgrade', $user->id).'?view=upgrade'}}" type="button"
                                    data-bs-toggle="tooltip" data-bs-original-title="Upgrade to Instructor">
                                    <i class="fas fa-level-up-alt " style="color:darkorange"></i>
                                </a>
                            @else
                                <a href="{{ route('instructors.show', $user->id) }}" type="button"
                                    data-bs-toggle="tooltip" data-bs-original-title="Show Instructor">
                                    <i class="fas fa-eye" style="color:mediumspringgreen"></i>
                                </a>
                            @endif

                            <a href="{{ route('users.edit', $user->id). '?view=update' }}" type="button"
                                data-bs-toggle="tooltip" data-bs-original-title="Edit User">
                                <i class="fas fa-pen" style="color:deepskyblue"></i>
                            </a>
                            {{-- <form style="display:inline" method="POST"
                                action="{{ route('users.destroy', [$user->id]) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <a class=" show_confirm" type="button"
                                data-bs-toggle="tooltip" data-bs-original-title="Delete User">
                                    <i class="fas fa-trash" style="color:red"></i>
                                </a>

                            </form> --}}
                            <form style="display:inline" method="POST"
                                    action="#">
                                    @csrf
                                    <input name="_method" type="hidden" value="BLOCK">
                                    <a  class=" show_confirm_block" type="button"
                                    data-bs-toggle="tooltip" data-bs-original-title="Block User">
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
