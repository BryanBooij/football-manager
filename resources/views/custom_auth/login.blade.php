<x-guest-layout>
    <form method="POST" action="{{ route('custom.login') }}">
        @csrf
        <div class="mt-4">
            <label class="text-white">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mt-4">
            <label class="text-white">Password:</label>
            <input class="text-white" type="password" name="password" required>
        </div>
        <a
            href="{{ route('custom.register') }}"
            class="inline-block px-5 py-1.5 ms-3 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
            Register
        </a>
        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>>
    </form>
</x-guest-layout>

