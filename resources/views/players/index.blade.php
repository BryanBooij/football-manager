<!DOCTYPE html>
<html>
<head>
    <title>Players</title>
</head>
<body>
<h1>Players</h1>

<h3>Filter by Country</h3>
<ul>
    @foreach($countries as $country)
        <li><a href="{{ url('/players/country/'.$country->id) }}">{{ $country->name }}</a></li>
    @endforeach
</ul>

<hr>

<h3>Player List</h3>
<ul>
    @foreach($players as $player)
        <li>{{ $player->name }} ({{ $player->country->name ?? 'No country' }})</li>
    @endforeach
</ul>
</body>
</html>
