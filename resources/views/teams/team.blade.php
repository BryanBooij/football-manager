<x-app-layout>
    <div class="flex flex-col items-center bg-gray-50 text-center">
        @if($team)
            <h1 class="text-3xl font-semibold mb-6">{{ $team->name }}</h1><br>

            @if($team->players->count())
                <ul>
                    @foreach($team->players as $player)
                        <li class="mb-2">
                            {{ $player->name }}

                            <!-- delete speler from database -->
                            <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    Delete
                                </button>
                            </form>
                        </li>

                    @endforeach
                </ul>
            @else
                <p>Theres no players in the team</p>
            @endif
            <a href="/players/country/1"
               class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-6 rounded-lg shadow">
                Voeg speler toe
            </a>
        @else
            <p>You haven't made a team yet</p>
        @endif
    </div>
</x-app-layout>

