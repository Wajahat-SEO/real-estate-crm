<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

                <!-- Error/Success Message Display -->
       <!-- @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <p>If you need assistance, please contact us at <a href="https://wa.me/923418898767" target="_blank">+923418898767 (WhatsApp)</a>.</p>
            </div>
        @endif -->

            <!-- Page Content -->
            <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
    
        <nav class="p-4 space-y-2 text-gray-700 dark:text-gray-300">

            <a class="block hover:text-blue-500" href="{{ route('dashboard.summary') }}">
                📊 Dashboard Summary
            </a>


            <!-- Block Menu -->
            <details class="group">
                <summary class="cursor-pointer hover:text-blue-500">Blocks</summary>
                <div class="ml-4 mt-2 space-y-1">
                    <a href="{{ route('blocks.index') }}" class="block hover:text-blue-500">View All</a>
                    <a href="{{ route('blocks.create') }}" class="block hover:text-blue-500">Add New</a>
                </div>
            </details>

            <a href="{{ route('customers.index') }}" class="block hover:text-blue-500">Customers</a>
            <a href="{{ route('plots.index') }}" class="block hover:text-blue-500">Plots</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="p-6">
        @yield('content')
        @stack('scripts')
    </main>
</div>

        </div>
    </body>
    <!-- Footer Section -->
<footer class="bg-dark text-white py-3">
    <div class="container text-center">
    <p>If you have any questions or need support, contact us:</p>
        <p>Wajahat Hussain</p>
        <p>Phone: <a href="tel:+923418898767" class="text-white">+923418898767</a></p>
        <p>WhatsApp: <a href="https://wa.me/+923418898767" class="text-white" target="_blank">Message me on WhatsApp</a></p>
       <p>Email: <a href="mailto:admin@wajahatwrites.com" class="text-white">admin@wajahatwrites.com</a></p>
              <p>Email: <a href="mailto:admin@wajahatwrites.com" class="text-white">admin@wajahatwrites.com</a></p>
        <p>Website: <a href="https://wajahatwrites.com" class="text-white">wajahatwrites.com</a></p>
        <p>Blog: <a href="https://seotechguru.co.uk" class="text-white">SEO & Tech Consultant</a></p>
        <p>Copyright &copy; 2025 Wajahat Hussain. All rights reserved.</p>
    </div>
</footer>
</html>
