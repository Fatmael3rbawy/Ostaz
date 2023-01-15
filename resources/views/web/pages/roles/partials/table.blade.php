<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Role</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $item->name }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            @can('roles_view')
                                <a href="{{ route('roles.show', $item->id) }}" class="btn btn-outline-success"
                                    type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                </a>
                            @endcan

                            @if ($item->name != 'Admin')
                                @can('roles_edit')
                                    <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-outline-info"
                                        type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-pen"></i></span>
                                    </a>
                                @endcan
                                @can('roles_delete')
                                    <form style="display:inline" method="POST"
                                        action="{{ route('roles.destroy', [$item->id]) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button
                                            class="btn btn-outline-danger @if ($item->users->count() > 0) reject_confirm  @else show_confirm @endif"
                                            type="button">
                                            <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                        </button>

                                    </form>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
