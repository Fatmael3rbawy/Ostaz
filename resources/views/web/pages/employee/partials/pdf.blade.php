<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
</head>
<body>
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr class="text-center">
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                        {{-- <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Avtar</th> --}}
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Email</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Role</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Last Login</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Joined Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr>
                            <td class="text-center">
                                <p class="text font-weight-bold mb-0">{{ $item->name }}</p>
                            </td>
                            {{-- <td class="text-center">
                                <img src="{{ asset($item->attachments()->where('key', 'avatar')->first()->file ?? '') }}"
                                    class="img-fluid border-radius-sm" height="100" width="100">
                            </td> --}}
                            <td class="text-center">
                                <p class="text font-weight-bold mb-0">{{ $item->email }}</p>
                            </td>
                            <td class="text-center">
                                <p class="text font-weight-bold mb-0">{{ $item->roles->first()->name ?? '' }}</p>
                            </td>
                            <td class="text-center">
                                <p class="text font-weight-bold mb-0">
                                    {{ $item->last_login_at }}</p>
                            </td>
                            <td class="text-center">
                                <p class="text font-weight-bold mb-0">{{ $item->created_at }}</p>
                            </td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

