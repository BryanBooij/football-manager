<x-app-layout>
    <div class="fixed top-5 right-5 z-50">
        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                class="bg-green-500 text-black px-4 py-2 rounded shadow-lg transition-all duration-500"
            >
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="bg-white p-4 max-w-2xl mx-auto flex flex-col items-center text-center">
        <label for="country" class="block text-gray-700">Select country:</label>
        <select id="country" onchange="window.location.href=this.value"
                class="mt-2 block w-64 p-2 border rounded-md">
            <option value="">-- Choose a country --</option>
            @foreach($countries as $country)
                <option value="{{ url('/players/country/'.$country->id) }}"
                    {{ ($currentCountry && $currentCountry->id == $country->id) ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>

        <label for="search" class="block text-gray-700 mt-4">Or manually select for player name:</label>
        <form action="{{url('player_search')}}" method="get" class="mt-2 w-full flex flex-col items-center">
            <input type="search" name="search" class="border p-2 rounded w-64 mb-2">
            <input type="submit" class="bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded w-32" value="Search">
        </form>

        @if (session('error'))
            <div class="block text-red-700 mt-2 text-center">
                {{ session('error') }}
            </div>
        @endif

        <h3 class="text-center mt-4">Player List for: {{ $currentCountry->name ?? 'All Countries' }}</h3>
    </div>

    <hr class="my-4">

    {{-- Spelerslijst in 30% breedte, gecentreerd --}}
    <ul class="bg-white p-2 mx-auto mt-4" style="width:30%;">
        @foreach($players as $player)
            <li class="flex justify-between items-center py-2 border-b">
                <span class="text-center w-1/2">{{ $player->name }}</span>

                <form action="{{ route('team.add-player', $player->id) }}" method="POST" class="w-1/2 flex justify-end">
                    @csrf
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-black px-3 py-1 rounded text-sm">
                        Add player
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>
