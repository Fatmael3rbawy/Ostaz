<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Avtar</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Email</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Role</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Last Login</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Joined Date</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $item->name }}</p>
                        </td>
                        <td class="text-center">
                            <img src="{{ asset($item->attachments()->where('key', 'avatar')->first()->file ?? '') }}"
                                class="img-fluid border-radius-sm" height="100" width="100">
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $item->email }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $item->roles->first()->name ?? '' }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">
                                @if($item->last_login_at)
                                {{ \Carbon\Carbon::parse($item->last_login_at)->diffForHumans() }}</p>
                                @else
                                -
                                @endif
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $item->created_at->format('y-m-d') }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            @can('employees_edit')
                                <a href="{{ route('employees.edit', $item->id) }}" class="btn btn-outline-info"
                                    type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-pen"></i></span>
                                </a>
                            @endcan
                            @can('employees_delete')
                                <form style="display:inline" method="POST"
                                    action="{{ route('employees.destroy', [$item->id]) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-outline-danger show_confirm" type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                    </button>

                                </form>
                            @endcan
                            @can('employees_block')
                                <a href="{{ route('employees.block', $item->id) }}" class="btn btn-outline-danger"
                                    type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-ban"></i></span>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>