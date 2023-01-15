<div class="card-body px-0 pb-0">
    <div class="table-responsive">

        <table class="table table-flush" id="products-list">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    @if (request()->query('view'))
                        <th> Facebook </th>
                        <th> Whatsapp </th>
                    @endif
                    <th>City</th>
                    <th>Area</th>
                    @if (request()->query('view') != 'spec_instructor')
                        <th>Category</th>
                    @endif
                    @if (!request()->query('view'))
                        <th>Type</th>
                    @endif
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
                        @if (request()->query('view'))
                            <td class="text-sm text-center">{{ $user->facebook }}</td>
                            <td class="text-sm text-center">{{ $user->whatsapp }}</td>
                        @endif

                        <td class="text-sm text-center"> {{ $user->areas->first()->city->name ?? '' }}</td>
                        <td class="text-sm text-center"> {{ $user->areas->first()->area ?? '' }}</td>
                        @if (request()->query('view') != 'spec_instructor')
                            <td class="text-sm text-center"> {{ $user->specializations->first()->name ?? '' }} </td>
                        @endif
                        @if (!request()->query('view'))
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
                        @endif
                        <td class="align-middle text-center text-sm">

                            @if (request()->query('view') != 'spec_instructor')
                                @if ($user->type == 4 || $user->type == 5)
                                    <a href="{{ route('instructors.upgrade', $user->id) . '?view=upgrade' }}"
                                        type="button" data-bs-toggle="tooltip"
                                        data-bs-original-title="Upgrade to Instructor">
                                        <i class="fas fa-level-up-alt " style="color:darkorange"></i>
                                    </a>
                                @else
                                    <a href="{{ route('instructors.show', $user->id) }}" type="button"
                                        data-bs-toggle="tooltip" data-bs-original-title="Show Instructor">
                                        <i class="fas fa-eye" style="color:mediumspringgreen"></i>
                                    </a>
                                @endif
                            @endif

                            <a href="{{ route('instructors.edit', $user->id). '?view=update' }}" type="button"
                                data-bs-toggle="tooltip" data-bs-original-title="Edit User">
                                <i class="fas fa-pen" style="color:deepskyblue"></i>
                            </a>
                            @if (request()->query('view'))
                                <form style="display:inline" method="POST"
                                    action="{{ route('users.destroy', [$user->id]) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a class=" show_confirm" type="button" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete User">
                                        <i class="fas fa-trash" style="color:red"></i>
                                    </a>

                                </form>
                            @endif

                            <form style="display:inline" method="GET"
                                action="{{ route('users.block', [$user->id]) }}">
                                @csrf
                                <input name="_method" type="hidden" value="BLOCK">
                                <a class=" show_confirm_block" type="button" data-bs-toggle="tooltip"
                                    data-bs-original-title="Block User">
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
