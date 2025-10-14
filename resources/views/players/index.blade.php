<!DOCTYPE html>
<html>
<head>
    <title>Players</title>
</head>
<body>
<h1>Players</h1>

<h1>Spelers uit {{ $players->first()->country->name ?? 'Onbekend land' }}</h1>

<ul>
    @foreach($players as $player)
        <li>{{ $player->name }} ({{ $player->age }} jaar)</li>
    @endforeach
</ul>

</body>
</html>
