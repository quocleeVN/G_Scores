<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Scores - Tra cứu điểm thi</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <x-sidebar />
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <x-header />
            <main class="flex-1 relative overflow-y-auto focus:outline-none p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>