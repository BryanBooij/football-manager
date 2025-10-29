<x-app-layout>

<h1 class="flex flex-col items-center bg-gray-50 text-center mb-4">Alle teams</h1><br>
    @foreach($teams as $team)
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 justify-items-center">
            <h2>
                <a href="{{ route('teams.show', $team->id) }}"
                   class="bg-white border rounded-lg p-4 flex flex-col items-center shadow w-full max-w-[140px]">
                    {{ $team->name }}
                </a>
                <p class="mb-4">Aantal spelers: {{ $team->players->count() }}</p>
            </h2>
        </div>
    @endforeach

</x-app-layout>
