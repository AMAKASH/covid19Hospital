@props(['height', 'width', 'areas', 'search_value'])

<style>
    .searchbar {
        width: {{ $width ?? '800px' }};
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .searchbar input {
        height: {{ $height ?? '50px' }};
    }

    .searchbar button {
        height: {{ $height ?? '50px' }};
    }
</style>
<form action="{{ route('hospital.search') }}" method="POST" class="searchbar form-control gap-2">
    @csrf
    <input name="search" class='form-control' list="area" value="{{ $search_value }}"
        placeholder="Enter Your Location to Search Nearby Hospitals" />
    <datalist id="area">
        @foreach ($areas ?? [] as $area)
            <option value="{{ $area->area_name }}">{{ $area->area_name }}</option>
        @endforeach
    </datalist>
    <button type="submit" class="btn btn-primary">Search</button>
</form>
