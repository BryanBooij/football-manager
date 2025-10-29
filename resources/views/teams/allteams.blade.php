<x-app-layout>

<h1>Alle teams</h1>
    @foreach($teams as $team)
        <div class="team">
            <h2 class="font-semibold">{{ $team->name }}</h2>
            <ul>
                @foreach($team->players as $player)
                    <li>{{ $player->name }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endforeach

</x-app-layout>
