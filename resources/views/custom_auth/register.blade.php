<x-guest-layout>
    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mt-4">
            <label class="text-white">Naam:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mt-4">
            <label class="text-white">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mt-4">
            <label class="text-white">Wachtwoord:</label>
            <input type="password" name="password" required>
        </div>

        <div class="mt-4">
            <label class="text-white">Wachtwoord bevestigen:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div class="mt-4">
            <input type="hidden" name="role" value="1">
        </div>

        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
    </form>
</x-guest-layout>
