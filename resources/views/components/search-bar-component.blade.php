@props(['right', 'top', 'height', 'width', 'areas', 'search_value'])

<style>
    .searchbar {
        width: {{ $width ?? '800px' }};
        position: absolute;
        right: {{ $right ?? '5%' }};
        top: {{ $top ?? '50%' }};
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
    <div style="width: inherit">
        <input name="search" class="form-control" list="area" value="{{ $search_value ?? '' }}"
            placeholder="Enter Your Location to Search Nearby Hospitals" />
        <datalist id="area">
            @foreach ($areas ?? [] as $area)
                <option value="{{ $area->area_name }}">{{ $area->area_name }}</option>
            @endforeach
        </datalist>
        <x-input-error :messages="$errors->get('search')" />
    </div>
    <button type="submit" class="btn btn-primary">Search</button>

</form>
