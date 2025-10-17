<x-app-layout>
{{--    @foreach ($teams as $team)--}}
{{--        <h2>{{ $team->name }}</h2>--}}
{{--        <a href="{{ route('teams.editPlayers', $team->id) }}">Spelers bewerken</a>--}}
{{--    @endforeach--}}

        <form action="{{ route('teams.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Teamnaam">
            <button type="submit">Team maken</button>
        </form>

        <form action="{{ route('teams.addPlayer', $team->id) }}" method="POST">
            @csrf
            <select name="player_id">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
            <button type="submit">Voeg toe aan team</button>
        </form>
</x-app-layout>
