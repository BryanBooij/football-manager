<x-app-layout>
    <ul class="bg-white">
        @foreach($countries as $country)
            <li><a href="{{ url('/players/country/'.$country->id) }}">{{ $country->name }}</a></li>
        @endforeach
    </ul>

    <hr>

    <h3 class="bg-white">Player List</h3>
    <ul class="bg-white">
        @foreach($players as $player)
            <li>{{ $player->name }} ({{ $player->country->name ?? 'No country' }})</li>
        @endforeach
    </ul>
</x-app-layout>
