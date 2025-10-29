<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My team') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 py-2 px-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex flex-col items-center bg-gray-50 text-center">
        @if($team)
            <h1 class="text-3xl font-semibold mb-6">Team: {{ $team->name }}</h1><br>
            <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="mb-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-black font-semibold py-2 px-6 rounded-lg shadow">
                    Delete Team
                </button>
            </form>
            @if($team->players->count())
                <ul>
                    <p class="flex items-center justify-between py-2 px-4 border-b">Spelers: </p>
                    @foreach($team->players as $player)
                        <li class="flex items-center justify-between py-2 px-4 border-b">
                            <span class="text-left">{{ $player->name }}</span>

                            <!-- delete speler from database -->
                            <form action="{{ route('players.destroy', $player->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-black py-1 px-3 rounded">
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
                Add player
            </a>
        @else
            <p>You haven't made a team yet</p>
            <p>Create a team here</p>
            <form action="{{ route('teams.store') }}" method="POST" class="mt-4 flex flex-col items-center">
                @csrf
                <input type="text" name="name" placeholder="Team name"
                       class="border rounded-lg py-2 px-4 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-black font-semibold py-2 px-6 rounded-lg shadow">
                    Create Team
                </button>
            </form>
        @endif
    </div>
</x-app-layout>

