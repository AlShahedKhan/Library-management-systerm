<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;

// class BookController extends Controller
// {
//     public function show($olid)
//     {
//         // Get book info
//         $bookUrl = "https://openlibrary.org/books/$olid.json";
//         $response = Http::get($bookUrl);

//         if (!$response->successful()) {
//             return abort(404, 'Book not found');
//         }

//         $book = $response->json();

//         // Get author info
//         $authorName = 'Unknown';
//         if (isset($book['authors'][0]['key'])) {
//             $authorKey = $book['authors'][0]['key'];
//             $authorResponse = Http::get("https://openlibrary.org$authorKey.json");

//             if ($authorResponse->successful()) {
//                 $authorData = $authorResponse->json();
//                 $authorName = $authorData['name'] ?? 'Unknown';
//             }
//         }

//         return view('book', [
//             'book' => $book,
//             'olid' => $olid,
//             'authorName' => $authorName,
//         ]);
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function show($olid)
    {
        // Fetch book data
        $bookUrl = "https://openlibrary.org/books/$olid.json";
        $response = Http::get($bookUrl);

        if (!$response->successful()) {
            return abort(404, 'Book not found');
        }
        
        $book = $response->json();

        // Fetch author name
        $authorName = 'Unknown';
        if (isset($book['authors'][0]['key'])) {
            $authorKey = $book['authors'][0]['key'];
            $authorResponse = Http::get("https://openlibrary.org$authorKey.json");

            if ($authorResponse->successful()) {
                $authorData = $authorResponse->json();
                $authorName = $authorData['name'] ?? 'Unknown';
            }
        }
        // Check for Open Library Archive.org ID
        $archiveId = $book['ocaid'] ?? ($book['internet_archive_id'][0] ?? null);

        return view('book', [
            'book' => $book,
            'olid' => $olid,
            'authorName' => $authorName,
            'archiveId' => $archiveId,
        ]);
    }
}

