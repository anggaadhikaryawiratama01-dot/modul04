<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Book - Premium</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 tracking-tight">
                BOOK<span class="text-gray-800">STORE</span>
            </a>

            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium">Home</a>
                <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">Manage Books</a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg text-sm font-semibold transition duration-300">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="min-h-screen">
        @yield('content')
    </div>

    <footer class="bg-white border-t border-gray-200 py-8 mt-12">
        <div class="container mx-auto px-6 text-center text-gray-500 text-sm">
            &copy; 2026 CRUD Book Laravel. All rights reserved.
        </div>
    </footer>

</body>
</html>
