{{-- <!DOCTYPE html>
<html>
<head>
    <title>{{ $book['title'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        img { margin: 20px 0; max-width: 200px; }
    </style>
</head>
<body>

    <h1>{{ $book['title'] }}</h1>

    @if(isset($book['covers'][0]))
        <img src="https://covers.openlibrary.org/b/id/{{ $book['covers'][0] }}-L.jpg" alt="Book Cover">
    @endif

    <p><strong>Author:</strong> {{ $authorName }}</p>
    <p><strong>Subtitle:</strong> {{ $book['subtitle'] ?? 'N/A' }}</p>
    <p><strong>Publish Date:</strong> {{ $book['publish_date'] ?? 'N/A' }}</p>
    <p><strong>Number of Pages:</strong> {{ $book['number_of_pages'] ?? 'N/A' }}</p>

    <br>
    <a href="https://openlibrary.org/books/{{ $olid }}" target="_blank">
        📖 View on Open Library
    </a>

</body>
</html> --}}
<!DOCTYPE html>
<html>
<head>
    <title>{{ $book['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        img {
            margin: 20px 0;
            max-width: 200px;
        }
        iframe {
            margin-top: 30px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>{{ $book['title'] }}</h1>
    @if(isset($book['covers'][0]))
        <img src="https://covers.openlibrary.org/b/id/{{ $book['covers'][0] }}-L.jpg" alt="Book Cover">
    @endif
    <p><strong>Author:</strong> {{ $authorName }}</p>
    <p><strong>Subtitle:</strong> {{ $book['subtitle'] ?? 'N/A' }}</p>
    <p><strong>Publish Date:</strong> {{ $book['publish_date'] ?? 'N/A' }}</p>
    <p><strong>Number of Pages:</strong> {{ $book['number_of_pages'] ?? 'N/A' }}</p>
    <br>
    <a href="https://openlibrary.org/books/{{ $olid }}" target="_blank">
        📖 View on Open Library
    </a>
    @if($archiveId)
        <h2>📘 Read Book:</h2>
        <iframe
            src="https://archive.org/stream/{{ $archiveId }}"
            width="100%" height="600" allowfullscreen>
        </iframe>
    @else
        <p><em>❌ This book is not available for online reading.</em></p>
    @endif
</body>
</html>
