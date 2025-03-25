<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="max-w-7xl mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-center mb-8">Our Book Collection</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($books as $book)
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <!-- Correct URL format for the link -->
                    <a href="{{ url('/book/' . str_replace('/works/', '', $book['key'])) }}">
                        @if(isset($book['cover_id']))
                            <img src="https://covers.openlibrary.org/b/id/{{ $book['cover_id'] }}-L.jpg" alt="Book Cover" class="w-full h-64 object-cover">
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">{{ $book['title'] }}</h2>
                            <p class="text-gray-600">{{ $book['author_name'][0] ?? 'Unknown Author' }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
