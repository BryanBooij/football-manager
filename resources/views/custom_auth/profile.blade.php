<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex flex-col items-center content-center mt-4">
        <form method="POST" action="{{ route('custom.profile.update') }}">
            @csrf
            <div>
                <label>Naam:</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div>
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div>
                <label>Nieuw wachtwoord (optioneel):</label>
                <input type="password" name="password">
            </div>

            <div>
                <label>Bevestig nieuw wachtwoord:</label>
                <input type="password" name="password_confirmation">
            </div>

            <button type="submit">Opslaan</button>
        </form>
        <form method="POST" action="{{ route('custom.profile.destroy') }}" onsubmit="function confirmDelete() {
        return confirm('Are you sure you want to delete your account?');
        }
        return confirmDelete()">
            @csrf
            @method('DELETE')
            <button type="submit" class="danger-btn">Delete my account</button>
        </form>
    </div>
</x-app-layout>
