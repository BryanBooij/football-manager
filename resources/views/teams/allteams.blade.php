<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All teams') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 justify-items-center mt-4">
        @foreach($teams as $team)
            <div class="bg-black border rounded-lg p-4 flex flex-col items-center text-center">
                <a href="{{ route('teams.show', $team->id) }}" class="mb-2">
                    {{ $team->name }}
                </a>

                <p class="mb-2">Amount of spelers: {{ $team->players->count() }}</p>
                @if(auth()->user() && auth()->user()->isAdmin())
                    <form action="{{ route('teams.toggleStatus', $team->id) }}"
                          method="POST"
                          class="toggle-form"
                          data-team-id="{{ $team->id }}">
                        @csrf
                        <button type="submit"
                                class="toggle-status inline-block px-3 py-1 rounded text-black {{ $team->active ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $team->active ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                    <div class="flex flex-col gap-2 w-full items-center">
                        <a href="{{ route('my.team', $team->id) }}"
                           class="text-black font-semibold py-1 px-3 text-center w-auto bg-black border rounded-lg">
                            Edit
                        </a>
                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete Team:  \'{{ $team->name }}\'?');"
                              class="w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-black font-semibold py-1 px-3 w-auto bg-black border rounded-lg">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <script>

        (function () {

            document.querySelectorAll('.toggle-form').forEach(form => {
                form.addEventListener('submit', async function (e) {

                    e.preventDefault();
                    e.stopImmediatePropagation();

                    const btn = form.querySelector('.toggle-status');
                    const csrfInput = form.querySelector('input[name="_token"]');
                    const token = csrfInput ? csrfInput.value : '{{ csrf_token() }}';
                    const action = form.action;


                    btn.disabled = true;
                    const originalText = btn.textContent;
                    btn.textContent = '...';

                    try {
                        const res = await fetch(action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        });


                        const text = await res.text();
                        let data;
                        try {
                            data = JSON.parse(text);
                        } catch (parseErr) {
                            console.error('Expected JSON:', text);
                            throw new Error('Not valid JSON response');
                        }

                        if (data.success) {

                            if (data.status) {
                                btn.textContent = 'Active';
                                btn.classList.remove('bg-red-500');
                                btn.classList.add('bg-green-500');
                            } else {
                                btn.textContent = 'Inactive';
                                btn.classList.remove('bg-green-500');
                                btn.classList.add('bg-red-500');
                            }
                        } else {
                            console.error('Toggle Failed', data);
                            btn.textContent = originalText;
                        }
                    } catch (err) {
                        console.error('Problem with toggle:', err);
                        btn.textContent = originalText;
                    } finally {
                        btn.disabled = false;
                    }
                }, {capture: true});
            });
        })();
    </script>
</x-app-layout>
