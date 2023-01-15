<div class="card">
    <div class="table-responsive">
        <table class="table align-instructors-center mb-0">
            <thead>
                <tr class="text-center">
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Email</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">WhatsApp</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Phone</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">F.B Acount</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Specialzation</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Cities</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2">Areas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($instructors as $instructor)
                    <tr>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $instructor->name }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $instructor->email }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $instructor->whatsapp ?? '' }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $instructor->phone ?? '' }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">{{ $instructor->facebook ?? '' }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text font-weight-bold mb-0">
                                @foreach ($instructor->specializations as $index => $specialization)
                                @if ($index == 0)
                                    - {{ $specialization->name }}
                                @else
                                    <br> - {{ $specialization->name }}
                                @endif
                                @endforeach
                            </p>
                        </td>
                        <td class="text-center">
                            @foreach ($instructor->areas as $index => $area)
                                @if ($index == 0)
                                    - {{ $area->city->name }}
                                @else
                                    <br> - {{ $area->city->name }}
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($instructor->areas as $index => $area)
                                @if ($index == 0)
                                   - {{ $area->area }}
                                @else
                                   <br> - {{ $area->area }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
