{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book['title'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="bg-white shadow-xl rounded-lg p-8">

            <h1 class="text-3xl font-bold mb-4">{{ $book['title'] }}</h1>

            @if(isset($book['covers'][0]))
                <img
                    src="https://covers.openlibrary.org/b/id/{{ $book['covers'][0] }}-L.jpg"
                    alt="Book Cover"
                    class="rounded-lg shadow-md mb-6 w-full max-w-xs mx-auto"
                >
            @endif

            <div class="space-y-2 text-lg">
                <p><span class="font-semibold">Author:</span> {{ $authorName }}</p>
                <p><span class="font-semibold">Subtitle:</span> {{ $book['subtitle'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Publish Date:</span> {{ $book['publish_date'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Number of Pages:</span> {{ $book['number_of_pages'] ?? 'N/A' }}</p>
            </div>

            <br>
            <a
                href="https://openlibrary.org{{ $book['key'] }}"
                target="_blank"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition"
            >
                📖 View on Open Library
            </a>

            @if($archiveId)
                <h2 class="text-2xl font-semibold mt-10 mb-4">📘 Read This Book:</h2>
                <iframe
                    src="https://archive.org/stream/{{ $archiveId }}"
                    class="w-full h-[600px] border rounded-lg shadow-md"
                    allowfullscreen>
                </iframe>
            @else
                <p class="mt-10 text-red-600 font-semibold">
                    ❌ This book is not available for online reading.
                </p>
            @endif

        </div>
    </div>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book['title'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="bg-white shadow-xl rounded-lg p-8">

            <h1 class="text-3xl font-bold mb-4">{{ $book['title'] }}</h1>

            @if(isset($book['covers'][0]))
                <img
                    src="https://covers.openlibrary.org/b/id/{{ $book['covers'][0] }}-L.jpg"
                    alt="Book Cover"
                    class="rounded-lg shadow-md mb-6 w-full max-w-xs mx-auto"
                >
            @endif

            <div class="space-y-2 text-lg">
                <p><span class="font-semibold">Author:</span> {{ $authorName }}</p>
                <p><span class="font-semibold">Subtitle:</span> {{ $book['subtitle'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Publish Date:</span> {{ $book['publish_date'] ?? 'N/A' }}</p>
                <p><span class="font-semibold">Number of Pages:</span> {{ $book['number_of_pages'] ?? 'N/A' }}</p>
            </div>

            <br>
            <a
                href="https://openlibrary.org{{ $book['key'] }}"
                target="_blank"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition"
            >
                📖 View on Open Library
            </a>

            @if($archiveId)
                <h2 class="text-2xl font-semibold mt-10 mb-4">📘 Read This Book:</h2>
                <iframe
                    src="https://archive.org/stream/{{ $archiveId }}"
                    class="w-full h-[600px] border rounded-lg shadow-md"
                    allowfullscreen>
                </iframe>
            @else
                <p class="mt-10 text-red-600 font-semibold">
                    ❌ This book is not available for online reading.
                </p>
            @endif

        </div>
    </div>

</body>
</html>


