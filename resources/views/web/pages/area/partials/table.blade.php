    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr class="text-center">
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Country</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">City</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $item)
                        <tr>
                            <td class="text-center">{{ $item->city->country->name }}</td>
                            <td class="text-center">{{ $item->city->name }}</td>
                            <td class="text-center">
                                <p class="text font-weight-bold">{{ $item->area }}</p>
                            </td>
                            <td class="text-center">
                                @can('areas_edit')
                                    <a href="{{ route('area.edit', $item->id) }}" class="btn btn-outline-info"
                                        type="button">
                                        <span class="btn-inner--icon"><i class="fas fa-pen"></i></span>
                                    </a>
                                @endcan
                                @can('areas_delete')
                                    <form style="display:inline" method="POST"
                                        action="{{ route('area.destroy', [$item->id]) }}">
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
