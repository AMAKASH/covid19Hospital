@props(['entity' => [], 'show_action' => false])

<h4 class="mt-5">News & Notices</h4>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="col-md-10">Notice</th>
            @if ($show_action)
                <th scope="col">Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($entity->notices()->orderBy('created_at', 'desc')->get() as $notice)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $notice->content }} </td>
                @if ($show_action)
                    <td><span class="btn btn-danger" onclick="deleteNotice({{ $notice->id }})">Delete</span></td>
                @endif
            </tr>
        @endforeach
        @if (count($entity->notices) == 0)
            <tr>
                <td colspan='11'>
                    <h6 class="text-center">No Notices available yet</h6>
                </td>
            </tr>
        @endif
    </tbody>
</table>
@if ($show_action)
    <h6 class="mt-5">Add New Notice</h6>

    <form action="{{ route('notice.create', $entity->id) }}" method="POST">
        @csrf

        <div class="d-flex flex-row">
            <div class="col-md-12">
                <div class="form-outline mb-4">
                    <input type="text" id="new_notice"
                        class="form-control form-control-lg {{ $errors->get('new_notice') ? 'is-invalid' : '' }}"
                        name="content" value="{{ old('new_notice') }}" />
                    <label class="form-label" for="new_notice">New Notice</label>
                </div>
                <x-input-error :messages="$errors->get('new_notice')" class="mb-2" autofocus />
            </div>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Add Notice</button>
        </div>
    </form>


    <script>
        function deleteNotice(id) {
            console.log(id);
            let url = "{{ route('hospital.notice.destroy', [$entity->id, 0]) }}";
            url = url.slice(0, url.length - 1) + id;
            console.log(url);
            var xhr = new XMLHttpRequest();
            xhr.open("DELETE", url);
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.send();
            location.reload();
        }
    </script>
@endif
