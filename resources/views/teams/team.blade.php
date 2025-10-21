<x-app-layout>
    <div class="text-center">
        @if($team)
            <h1>My team: {{ $team->name }}</h1>

            @if($team->players->count())
                <ul>
                    @foreach($team->players as $player)
                        <li>{{ $player->name }} - {{ $player->position }}</li>
                    @endforeach
                </ul>
            @else
                <p>Theres no players in the team</p>
            @endif
        @else
            <p>You haven't made a team yet</p>
        @endif
    </div>
</x-app-layout>
