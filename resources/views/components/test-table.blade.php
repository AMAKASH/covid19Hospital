@props(['entity' => [], 'show_view' => false])

<h4 class="mt-5">Tests</h4>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Test Name</th>
            <th scope="col">Hospital</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Blood Group</th>
            <th scope="col">Gender</th>
            <th scope="col">Weight</th>
            <th scope="col">Age</th>
            <th scope="col">Status</th>
            <th scope="col">Report</th>
            <th scope="col" class="col-md-2">Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entity->tests as $test)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $test->testName->name }} </td>
                <td><a href="{{ route('hospital.show', $test->hospital_id) }}">{{ $test->hospital->name }}</a>
                </td>
                <td>{{ $test->patient_name }}.
                    @if ($show_view)
                        <a href="{{ route('test.edit', $test->id) }}">View</a>
                </td>
        @endif
        <td>{{ $test->blood_group }}</td>
        <td>{{ $test->gender }}</td>
        <td>{{ $test->weight }}</td>
        <td>{{ $test->age() }}</td>
        <td>{{ $test->status }}</td>
        <td><a href="{{ route('test.download', $test->id) }}">Download</a></td>
        <td>
            <p>{{ $test->comments }}</p>
        </td>
        </tr>
        @endforeach
        @if (count($entity->tests) == 0)
            <tr>
                <td colspan='11'>
                    <h6 class="text-center">No test available yet</h6>
                </td>
            </tr>
        @endif
    </tbody>
</table>
