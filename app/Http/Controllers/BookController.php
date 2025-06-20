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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class BookController extends Controller
{

    // public function index()
    // {
    //     // Fetch a list of books from Open Library (Example: Category "love")
    //     $response = Http::get('https://openlibrary.org/subjects/love.json?limit=100'); // Example category

    //     if ($response->successful()) {
    //         $books = $response->json()['works'];

    //         // Correct URL formation: Ensure it uses the OLID format
    //         foreach ($books as &$book) {
    //             // Get OLID from the 'key' (e.g., '/works/OLID' => 'OLID')
    //             $olid =  $book['lending_edition'];
    //             // $olid = str_replace('/works/', '', $book['key']);
    //             // Correct URL to open book details using the OLID
    //             $book['url'] = 'http://10.0.10.59:8003/book/' . $olid;
    //             // Log::info($book["authors"][0]["name"]);
    //             // dd($book);
    //         }

    //     } else {
    //         $books = [];
    //     }

    //     return view('books.index', ['books' => $books]);
    // }

    public function index()
{
    // Fetch a list of books from Open Library
    $response = Http::get('https://openlibrary.org/subjects/love.json?limit=100');

    if ($response->successful()) {
        $books = $response->json()['works'];

        foreach ($books as &$book) {
            $olid = $book['lending_edition'];
            $book['url'] = 'http://10.0.10.59:8003/book/' . $olid;
        }

        // Pagination logic
        $currentPage = request()->get('page', 1);
        $perPage = 10; // Number of books per page
        $booksCollection = new Collection($books);

        $booksPaginated = new LengthAwarePaginator(
            $booksCollection->forPage($currentPage, $perPage),
            $booksCollection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        
        );
    } else {
        $booksPaginated = new LengthAwarePaginator([], 0, 10);
    }

    return view('books.index', ['books' => $booksPaginated]);
}

    // public function show($olid)
    // {
    //     // Fetch book data from Open Library using the OLID
    //     $bookUrl = "https://openlibrary.org/books/$olid.json"; // Correct endpoint using OLID
    //     $response = Http::get($bookUrl);

    //     if (!$response->successful()) {
    //         return abort(404, 'Book not found');
    //     }

    //     $book = $response->json();

    //     // Fetch author name (if available)
    //     $authorName = 'Unknown';
    //     dd($book['authors'][0]['name']);
    //     if (isset($book['authors'][0]['key'])) {
    //         $authorKey = $book['authors'][0]['key'];
    //         $authorResponse = Http::get("https://openlibrary.org$authorKey.json");

    //         if ($authorResponse->successful()) {
    //             $authorData = $authorResponse->json();
    //             $authorName = $authorData['name'] ?? 'Unknown';
    //         }
    //     }

    //     // Check for Open Library Archive.org ID (for online reading)
    //     $archiveId = $book['ocaid'] ?? ($book['internet_archive_id'][0] ?? null);

    //     return view('books.show', [
    //         'book' => $book,
    //         'olid' => $olid,
    //         'authorName' => $authorName,
    //         'archiveId' => $archiveId,
    //     ]);
    // }
    public function show($olid)
{
    // Fetch book data from Open Library using the OLID
    $bookUrl = "https://openlibrary.org/books/$olid.json"; // Correct endpoint using OLID
    $response = Http::get($bookUrl);

    if (!$response->successful()) {
        return abort(404, 'Book not found');
    }

    $book = $response->json();

    // Fetch author name (if available)
    $authorName = 'Unknown';

    // Check if 'authors' exists and has data
    if (isset($book['authors']) && count($book['authors']) > 0) {
        // Get author name
        $authorName = $book['authors'][0]['name'] ?? 'Unknown';
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
