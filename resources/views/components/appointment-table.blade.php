@props(['entity' => [], 'show_view' => false])
<h4 class="mt-5">Appointments</h4>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Hospital</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Blood Group</th>
            <th scope="col">Gender</th>
            <th scope="col">Weight</th>
            <th scope="col">Age</th>
            <th scope="col">Status</th>
            <th scope="col" class="col-md-2">Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entity->appointments as $appointment)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $appointment->doctor->name }}</td>
                <td><a
                        href="{{ route('hospital.show', $appointment->hospital_id) }}">{{ $appointment->hospital->name }}</a>
                </td>
                <td>{{ $appointment->patient_name }}.
                    @if ($show_view)
                        <a href="{{ route('appointment.edit', $appointment->id) }}">View</a>
                    @endif
                </td>
                <td>{{ $appointment->blood_group }}</td>
                <td>{{ $appointment->gender }}</td>
                <td>{{ $appointment->weight }}</td>
                <td>{{ $appointment->age() }}</td>
                <td>{{ $appointment->status }}</td>
                <td>
                    <p>{{ $appointment->comments }}</p>
                </td>
            </tr>
        @endforeach
        @if (count($entity->appointments) == 0)
            <tr>
                <td colspan='11'>
                    <h6 class="text-center">No appointments available yet</h6>
                </td>
            </tr>
        @endif
    </tbody>
</table>
