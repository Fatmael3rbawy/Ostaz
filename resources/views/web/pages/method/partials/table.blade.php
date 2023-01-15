<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">#</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($methods as $method)
                    <tr>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $loop->iteration }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $method->name }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            @can('methods_edit')
                                <a href="{{ route('method.edit', $method->id) }}" class="btn btn-outline-info"
                                    type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-pen"></i></span>
                                </a>
                            @endcan
                            @can('methods_delete')
                                <form style="display:inline" method="POST"
                                    action="{{ route('method.destroy', [$method->id]) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-outline-danger show_confirm" type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                                    </button>

                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>