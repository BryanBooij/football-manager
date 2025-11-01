<x-app-layout>
{{-- non admin page --}}
    <div class="flex flex-col items-center bg-gray-50 text-center p-6">
        <h1 class="text-3xl font-semibold mb-4">Team name: {{ $team->name }}</h1>

        <a href="{{ route('all.teams') }}"
           class="mb-6 inline-block bg-gray-200 hover:bg-gray-300 text-black font-semibold py-2 px-6 rounded-lg shadow">
            ← Back to all teams
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
            <p class="text-gray-600">There are no players in the team yet.</p>
        @endif
    </div>
    {{-- Comment box --}}
    @if(auth()->check())
        @php
            $loginCount = auth()->user()->loginTracker->login_count ?? 0;
        @endphp

        @if($loginCount >= 5)
            <div class="mt-6 w-full flex justify-center">
                <form action="{{ route('comments.store', $team->id) }}" method="POST"
                      class="w-full max-w-[50vw] bg-white p-4 rounded-lg shadow flex flex-col items-center text-center">
                    @csrf
                    <div class="flex justify-center mt-6">
                        <textarea name="content" rows="3" placeholder="Write a comment..."
                        class="block max-w-[50vw] w-auto border rounded p-2 focus:outline-none focus:ring text-center"></textarea>
                    </div>

                    <button type="submit"
                            class="mt-2 bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded shadow">
                        Post comment
                    </button>
                </form>
            </div>
        @else
            <p class="text-gray-600 mt-4 flex flex-col items-center text-center">
                You must login at least 5 times to use the comment feature
                (now: {{ $loginCount }}).
            </p>
        @endif
    @endif

    {{-- Comments list --}}
    @if($team->comments->count())
        <div class="mt-6 w-full flex justify-center">
            <div class="w-full max-w-[80vw] flex flex-col items-center text-center">
                <h3 class="text-lg font-semibold mb-2">Reactions:</h3>
                @foreach($team->comments as $comment)
                    <div class="flex justify-center mt-4">
                        <div class="w-[30vw] max-w-[30vw] border rounded p-2 bg-white text-center">
                            <strong>From: {{ $comment->user->name }}</strong>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
