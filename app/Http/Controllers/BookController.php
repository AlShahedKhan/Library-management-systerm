<?php

// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Http;

// class BookController extends Controller
// {
//     public function show($olid)
//     {
//         // Fetch book data
//         $bookUrl = "https://openlibrary.org/books/$olid.json";
//         $response = Http::get($bookUrl);

//         if (!$response->successful()) {
//             return abort(404, 'Book not found');
//         }

//         $book = $response->json();

//         // Fetch author name
//         $authorName = 'Unknown';
//         if (isset($book['authors'][0]['key'])) {
//             $authorKey = $book['authors'][0]['key'];
//             $authorResponse = Http::get("https://openlibrary.org$authorKey.json");

//             if ($authorResponse->successful()) {
//                 $authorData = $authorResponse->json();
//                 $authorName = $authorData['name'] ?? 'Unknown';
//             }
//         }
//         // Check for Open Library Archive.org ID
//         $archiveId = $book['ocaid'] ?? ($book['internet_archive_id'][0] ?? null);

//         return view('book', [
//             'book' => $book,
//             'olid' => $olid,
//             'authorName' => $authorName,
//             'archiveId' => $archiveId,
//         ]);
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    // Show list of books
    public function index()
    {
        // Fetch a list of books from Open Library (Example: Category "love")
        $response = Http::get('https://openlibrary.org/subjects/love.json?limit=100'); // Example category

        if ($response->successful()) {
            $books = $response->json()['works'];

            // Fix URLs by removing '/works/' from the key
            foreach ($books as &$book) {
                // Correct URL formation: Ensure it doesn't include '/works/'
                $book['url'] = 'https://openlibrary.org' . str_replace('/works/', '', $book['key']); // Remove '/works/'
            }
        } else {
            $books = [];
        }
        return view('books.index', ['books' => $books]);
    }





    // Show book details
    public function show($olid)
    {
        // Fetch book data from Open Library's works endpoint
        $bookUrl = "https://openlibrary.org/works/$olid.json";  // Using the correct endpoint for works
        $response = Http::get($bookUrl);

        if (!$response->successful()) {
            return abort(404, 'Book not found');
        }

        $book = $response->json();

        // Fetch author name (if available)
        $authorName = 'Unknown';
        if (isset($book['authors'][0]['key'])) {
            $authorKey = $book['authors'][0]['key'];
            $authorResponse = Http::get("https://openlibrary.org$authorKey.json");

            if ($authorResponse->successful()) {
                $authorData = $authorResponse->json();
                $authorName = $authorData['name'] ?? 'Unknown';
            }
        }

        // Check for Open Library Archive.org ID (for online reading)
        $archiveId = $book['ocaid'] ?? ($book['internet_archive_id'][0] ?? null);

        return view('books.show', [
            'book' => $book,
            'olid' => $olid,
            'authorName' => $authorName,
            'archiveId' => $archiveId,
        ]);
    }

}
