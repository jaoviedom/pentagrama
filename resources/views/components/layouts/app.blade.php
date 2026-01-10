<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pentagrama - App Educativa' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50 min-h-screen">
    {{ $slot }}
    
    @livewire('game.reward-modal')
    @livewireScripts
</body>
</html>
