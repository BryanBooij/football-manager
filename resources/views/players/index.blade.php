<x-app-layout>
    <div class="bg-white p-4">
        <label for="country" class="block text-gray-700">Select country:</label>
        <select id="country" onchange="window.location.href=this.value" class="mt-2 block w-64 p-2 border rounded-md">
            <option value="">-- Choose a country --</option>
            @foreach($countries as $country)
                <option value="{{ url('/players/country/'.$country->id) }}"
                    {{ ($currentCountry && $currentCountry->id == $country->id) ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>

        <label for="search" class="block text-gray-700">Or manually select for player name:</label>
        <form action="{{url('player_search')}}" method="get">
            <input type="search" name="search">
            <input type="submit" class="btn-btn-success" value="Search">
        </form>

        <h3>Player List for:  {{ $currentCountry->name ?? 'All Countries' }}</h3>
    </div>

    <hr class="my-4">


    <ul class="bg-white p-2">
        @foreach($players as $player)
            <li>{{ $player->name }}</li>
        @endforeach
    </ul>
</x-app-layout>
