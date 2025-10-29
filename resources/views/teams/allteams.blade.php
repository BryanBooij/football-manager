<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All teams') }}
        </h2>
    </x-slot>


    @foreach($teams as $team)
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 justify-items-center mt-4">
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
