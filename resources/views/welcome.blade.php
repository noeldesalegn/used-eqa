<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Used-EQA — Buy & Sell in Dire Dawa</title>
        <meta name="description" content="Buy and sell used items in Dire Dawa. ድሬ ዳዋ ውስጥ ያገለገሉ ዕቃዎችን ይግዙ ወይም ይሽጡ">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <livewire:browse-listings />
    </body>
</html>
