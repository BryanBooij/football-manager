<x-app-layout>
    <div class="container">
        @if($team)
            <h1>Mijn team: {{ $team->name }}</h1>

            @if($team->players->count())
                <ul>
                    @foreach($team->players as $player)
                        <li>{{ $player->name }} - {{ $player->position }}</li>
                    @endforeach
                </ul>
            @else
                <p>Er zijn nog geen spelers in dit team.</p>
            @endif
        @else
            <p>Je hebt nog geen team aangemaakt.</p>
        @endif
    </div>
</x-app-layout>
