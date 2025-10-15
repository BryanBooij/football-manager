<x-app-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    <h1>test page</h1>
    @auth
        <h1>je bent ingelogd</h1>
    @endauth
    <form method="POST">
        @csrf
        <label for="name" >name:</label><br>
        <input type="text" id="name" name="name" value="{{old('name')}}"><br>
        <label for="name">Country:</label><br>
        <input type="text" id="country" name="country" value="{{old('country')}}">
        <input type="submit" value="Submit">
    </form>
</x-app-layout>
