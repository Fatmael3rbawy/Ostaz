<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center my-1">
            <thead>
                <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Main Category Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Image</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        <td class="text-center">
                            <a class="text font-weight-bold mb-0" href="/users?type=3&specialization={{$item->id}}&view=spec_instructor">{{ $item->name }}</a>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $item->mainSpecialization->name ?? ''}}</p>
                        </td>
                        <td class="text-center">
                            <img src="{{ asset($item->attachments()->where('key', 'category')->first()->file ?? '') }}"
                                class="img-fluid border-radius-sm" height="100" width="100">
                        </td>
                        <td class="align-middle text-center text-sm">
                            @can('sub_specializations_edit')
                                <a href="{{ route('sub-categories.edit', $item->id) }}" class="btn btn-outline-info"
                                    type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-pen"></i></span>
                                </a>
                            @endcan
                            @can('sub_specializations_delete')
                                <form style="display:inline" method="POST"
                                    action="{{ route('sub-categories.destroy', [$item->id]) }}">
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