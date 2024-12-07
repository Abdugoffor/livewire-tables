<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="./img/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
        <div class="p-4 border-b">
            <h1 class="text-xl font-bold text-gray-700">Admin Panel</h1>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="/prostoys" wire:navigate class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">
                Простой
            </a>
            <a href="#" wire:navigate class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">
                Другие расходы
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
