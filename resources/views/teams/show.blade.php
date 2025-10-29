<x-app-layout>
    <div class="flex flex-col items-center bg-gray-50 text-center p-6">
        <h1 class="text-3xl font-semibold mb-4">{{ $team->name }}</h1>

        <a href="{{ route('all.teams') }}"
           class="mb-6 inline-block bg-gray-200 hover:bg-gray-300 text-black font-semibold py-2 px-6 rounded-lg shadow">
            ← Terug naar alle teams
        </a>

        @if($team->players->count())
            <ul class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 justify-items-center">
                @foreach($team->players as $player)
                    <li class="bg-white border rounded-lg p-4 flex flex-col items-center shadow w-full max-w-[140px]">
                        <span class="font-semibold text-gray-800">{{ $player->name }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Geen spelers in dit team.</p>
        @endif
    </div>
</x-app-layout>
